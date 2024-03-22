<?php

namespace App\Http\Controllers;

use view;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AttendanceExportMuiltpleSheets;

class AttendanceController extends Controller
{

    public function addUserAttendance(Request $request)
    {
        $uid = $request->input('uid');
        $date = $request->input('date');

        if ($request->input('mission')) {
            $mission = $request->input('mission');
        } else {
            $mission = null;
        }

        if ($request->input('leave')) {
            $leave = $request->input('leave');
        } else {
            $leave = null;
        }

        if ($request->input('checkIn')) {
            $checkIn = $request->input('checkIn');
        } else {
            $checkIn = null;
        }
        if ($request->input('checkOut')) {
            $checkOut = $request->input('checkOut');
        } else {
            $checkOut = null;
        }

        if ($request->input('checkIn') && $request->input('checkOut')) {
            $date2 = Carbon::parse($checkOut);
            $date1 = Carbon::parse($checkIn);
            $result = $date1->diff($date2);
            $totals = Carbon::parse($result->h . ':' . $result->i . ':' . $result->s)->format('H:i:s');
        } else {
            $totals = null;
        }

        $users = [];

        if ($uid) {
            foreach ($uid as $user) {
                $model = Attendance::where('userId', $user)
                    ->where('date', $date)
                    ->first();
                if (!$model) {
                    $users[] = [
                        'userId' => $user,
                        'date' => $date,
                        'leave' => $leave,
                        'checkIn' => $checkIn,
                        'checkOut' => $checkOut,
                        'total' => $totals,
                        'mission' => $mission,
                        'created_at' => Carbon::now()
                    ];
                }
            }
        }
        // dd($users);
        if ($users) {
            Attendance::insert($users);
            return redirect('/attendances')->with('message', 'Insert Successfully');
        }

        return redirect('/attendances')->with('message', 'None');
    }

    public function importUserAttendanceExcel(Request $request)
    {

        $request->validate([
            'attendanceExcel' => ['required', 'file', 'mimes:xlsx,csv', 'max:2048'],
        ], [
            'attendanceExcel.required' => 'សូមបញ្ចូលទិន្នន័យ',
            'attendanceExcel.file' => 'សូមបញ្ចូលប្រភេទជា File',
            'attendanceExcel.mimes' => 'សូមបញ្ចូលជាប្រភេទ Excel ឬ CSV',
            'attendanceExcel.max' => 'អាចបញ្ចូលទំហំបានត្រឹម 2Mb',
        ]);

        $file = $request->input('attendanceExcel');

        return redirect()->back()->with('message', 'Import Successfully');
    }

    public function getAtt(Request $request)
    {
        $ip = $request->input('ip');
        $port = $request->input('port');

        DB::beginTransaction();
        try {

            $this->setAttendances($ip, $port);
            DB::commit();
            return redirect('/attendances')->with('message', 'Attendances Import Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('/attendances')->with('message', 'Please try again!!');
        }
    }

    public function exportUserAttendanceExcel(Request $request)
    {

        $dayExcludeWeekend = [];
        if ($request->input('holidayDate')) {
            $holidayDate = explode(", ", $request->input('holidayDate'));

            foreach ($holidayDate as $day) {
                if (!$this->isWeekend($day)) {
                    $dayExcludeWeekend[] = [
                        'day' => $day
                    ];
                };
            }
        }

        $amountDayOfHoliday = 0;
        if ($dayExcludeWeekend) {
            $amountDayOfHoliday = count($dayExcludeWeekend);
        }

        $previousUrl = URL::previous();
        $parsedUrl = parse_url($previousUrl);

        if (isset($parsedUrl['query'])) {
            parse_str($parsedUrl['query'], $queryParams);
        } else {
            return $this->setDefaultExportUserAttendances($request, $amountDayOfHoliday);
        }

        $fromDate = $queryParams['fromDate'];
        $toDate = $queryParams['toDate'];

        $query = Attendance::select(
            'userId',
            'date',
            'leave',
            'checkIn',
            'lateIn',
            'checkOut',
            'lateOut',
            'mission',
            'total',
        );

        $queryUser = User::join('roles', 'roles.id', '=', 'users.roleId')
            ->leftjoin('departments', 'departments.id', '=', 'users.departmentId')
            ->select(
                'users.id',
                'idCard',
                'firstNameKh',
                'lastNameKh',
                'gender',
                'phoneNumber',
                'dateOfBirth',
                'roles.roleNameKh as roleNameKh',
                'departments.departmentNameKh as departmentNameKh'
            );


        if (isset($queryParams['uid'])) {
            $query->whereIn('userId', $queryParams['uid']);
            $queryUser->whereIn('idCard', $queryParams['uid']);
        }

        if ($fromDate && $toDate) {
            $query->whereBetween('date', [$fromDate, $toDate]);
            $amountDays =  $this->businessDaysBetweenDates($fromDate, $toDate);
        } else {
            $date = Carbon::now();
            $firstDayOfMonth = $date->format('Y-m-01');
            $today = $date->format('Y-m-d');
            $amountDays = $this->businessDaysBetweenDates($firstDayOfMonth, $today);
            $query->whereBetween('date', [Carbon::parse($firstDayOfMonth)->format('Y-m-d'), Carbon::parse($today)->format('Y-m-d')]);
        }

        $attendances = $query->get();
        $users = $queryUser->get();

        $morningStop = Carbon::parse('09:00:00')->format('H:i:s');
        $eveningStart = Carbon::parse('16:00:00')->format('H:i:s');
        $eveningStop = Carbon::parse('17:30:00')->format('H:i:s');

        $amountDays -= $amountDayOfHoliday;
        $export = [];
        foreach ($users as $user) {
            $leave = 0;
            $work = 0;
            $absent = 0;
            $lateIn = 0;
            $lateOut = 0;
            $mission = 0;
            foreach ($attendances as $item) {

                if ($user->idCard == $item->userId) {

                    if ($item->leave) {
                        $leave++;
                    }
                    if ($item->lateIn) {
                        $lateIn++;
                    }
                    if ($item->lateOut) {
                        $lateOut++;
                    }
                    if ($item->mission) {
                        $mission++;
                    }

                    if ($item->checkIn) {

                        if ($item->checkIn <= $morningStop && $item->checkOut >= $eveningStart && $item->checkOut <= $eveningStop) {
                            $work++;
                        } elseif ($item->checkIn <= $morningStop && $item->lateOut) {
                            $work++;
                        } elseif ($item->lateIn && $item->checkOut >= $eveningStart && $item->checkOut <= $eveningStop) {
                            $work++;
                        } elseif ($item->lateIn && $item->lateOut) {
                            $work++;
                        } else {
                            $absent++;
                        }
                    }
                }
            }

            $export[] = [
                'name' => $user->lastNameKh . ' ' . $user->firstNameKh,
                'gender' => $user->gender,
                'dateOfBirth' => $user->dateOfBirth,
                'roleNameKh' => $user->roleNameKh,
                'departmentNameKh' => $user->departmentNameKh,
                'phoneNumber' => $user->phoneNumber,
                'work' => $work + $mission,
                'leave' => $leave,
                'absent' => $amountDays - ($work + $mission + $leave),
                'lateIn' => $lateIn,
                'lateOut' => $lateOut,
                'mission' => $mission
            ];
        }

        return Excel::download(new AttendanceExportMuiltpleSheets($export), 'attendances.xlsx');
    }

    public function setDefaultExportUserAttendances(Request $request, int $amountDayOfHoliday)
    {

        $date = Carbon::now();
        $firstDayOfMonth = $date->format('Y-m-01');
        $today = $date->format('Y-m-d');
        $amountDays = $this->businessDaysBetweenDates($firstDayOfMonth, $today);

        $query = Attendance::select(
            'userId',
            'date',
            'leave',
            'checkIn',
            'lateIn',
            'checkOut',
            'lateOut',
            'mission',
            'total',
        );

        $queryUser = User::join('roles', 'roles.id', '=', 'users.roleId')
            ->leftjoin('departments', 'departments.id', '=', 'users.departmentId')
            ->select(
                'users.id',
                'idCard',
                'firstNameKh',
                'lastNameKh',
                'gender',
                'phoneNumber',
                'dateOfBirth',
                'roles.roleNameKh as roleNameKh',
                'departments.departmentNameKh as departmentNameKh'
            );

        $query->whereBetween('date', [Carbon::parse($firstDayOfMonth)->format('Y-m-d'), Carbon::parse($today)->format('Y-m-d')]);
        $attendances = $query->get();
        $users = $queryUser->get();

        $morningStop = Carbon::parse('09:00:00')->format('H:i:s');
        $eveningStart = Carbon::parse('16:00:00')->format('H:i:s');
        $eveningStop = Carbon::parse('17:30:00')->format('H:i:s');

        $amountDays -= $amountDayOfHoliday;
        $export = [];
        foreach ($users as $user) {
            $leave = 0;
            $work = 0;
            $absent = 0;
            $lateIn = 0;
            $lateOut = 0;
            $mission = 0;
            foreach ($attendances as $item) {

                if ($user->idCard == $item->userId) {

                    if ($item->leave) {
                        $leave++;
                    }
                    if ($item->lateIn) {
                        $lateIn++;
                    }
                    if ($item->lateOut) {
                        $lateOut++;
                    }
                    if ($item->mission) {
                        $mission++;
                    }

                    if ($item->checkIn) {

                        if ($item->checkIn <= $morningStop && $item->checkOut >= $eveningStart && $item->checkOut <= $eveningStop) {
                            $work++;
                        } elseif ($item->checkIn <= $morningStop && $item->lateOut) {
                            $work++;
                        } elseif ($item->lateIn && $item->checkOut >= $eveningStart && $item->checkOut <= $eveningStop) {
                            $work++;
                        } elseif ($item->lateIn && $item->lateOut) {
                            $work++;
                        } else {
                            $absent++;
                        }
                    }
                }
            }

            $export[] = [
                'name' => $user->lastNameKh . ' ' . $user->firstNameKh,
                'gender' => $user->gender,
                'dateOfBirth' => $user->dateOfBirth,
                'roleNameKh' => $user->roleNameKh,
                'departmentNameKh' => $user->departmentNameKh,
                'phoneNumber' => $user->phoneNumber,
                'work' => $work + $mission,
                'leave' => $leave,
                'absent' => $amountDays - ($work + $mission + $leave),
                'lateIn' => $lateIn,
                'lateOut' => $lateOut,
                'mission' => $mission
            ];
        }

        return Excel::download(new AttendanceExportMuiltpleSheets($export), 'attendances.xlsx');
    }

    public function attendances(Request $request)
    {

        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');
        $uid = $request->input('uid');

        $today = Carbon::today();
        $departments = Department::all();
        $users = User::all();

        $query = DB::table('attendances')
            ->rightJoin('users', 'users.idCard', '=', 'attendances.userId')
            ->select(
                'users.id',
                'attendances.id',
                'users.idCard',
                'users.lastNameKh',
                'users.firstNameKh',
                'userId',
                'date',
                'leave',
                'checkIn',
                'checkOut',
                'lateIn',
                'lateOut',
                'mission',
                'total'
            );

        if ($uid) {
            $query->whereIn('users.idCard', $uid);
        }

        if ($fromDate && $toDate) {
            $query->whereBetween('date', [$fromDate, $toDate]);
        } else {
            $date = Carbon::now();
            $firstDayOfMonth = $date->format('Y-m-01');
            $today = $date->format('Y-m-d');
            $amountDays = $this->businessDaysBetweenDates($firstDayOfMonth, $today);
            $query->whereBetween('date', [Carbon::parse($firstDayOfMonth)->format('Y-m-d'), Carbon::parse($today)->format('Y-m-d')]);
        }

        $attendances = $query->orderBy('date', 'desc')->orderBy('checkIn', 'desc')->get();

        return view('admin.attendance.index', compact('attendances', 'users', 'departments'));
    }

    public function updateAttendanceById(Request $request, string $attendanceId)
    {
        $attendance = Attendance::findOrFail($attendanceId);

        if ($request->input('lateIn')) {
            if (is_null($attendance->checkIn)) {
                if ($attendance->checkOut) {
                    $date2 = Carbon::parse($attendance->checkOut);
                    $date1 = Carbon::parse($request->input('lateIn'));
                    $result = $date1->diff($date2);
                    $totals = Carbon::parse($result->h . ':' . $result->i . ':' . $result->s)->format('H:i:s');
                    $attendance->checkIn = Carbon::parse($request->input('lateIn'))->format('H:i:s');
                    $attendance->lateIn = Carbon::parse($request->input('lateIn'))->format('H:i:s');
                    $attendance->total = $totals;
                } else {
                    $attendance->checkIn = Carbon::parse($request->input('lateIn'))->format('H:i:s');
                    $attendance->lateIn = Carbon::parse($request->input('lateIn'))->format('H:i:s');
                }
            } else {
                if ($attendance->checkIn >= Carbon::parse('09:00:00')->format('H:i:s'))
                    $attendance->lateIn = $attendance->checkIn;
            }
        }

        if ($request->input('lateOut')) {
            $lateOut = Carbon::parse($request->input('lateOut'))->format('H:i:s');
            if (is_null($attendance->checkOut)) {

                if ($attendance->checkIn) {
                    $date1 = Carbon::parse($attendance->checkIn);
                    $date2 = Carbon::parse($request->input('lateOut'));
                    $result = $date1->diff($date2);
                    $totals = Carbon::parse($result->h . ':' . $result->i . ':' . $result->s)->format('H:i:s');

                    $attendance->checkOut = $lateOut;
                    if ($lateOut >= Carbon::parse('17:30:00')->format('H:i:s')) {
                        $attendance->lateOut = $lateOut;
                    }
                    $attendance->total = $totals;
                } else {
                    $attendance->checkOut = $lateOut;
                    $attendance->lateOut = $lateOut;
                }
            } else {
                if ($attendance->checkOut <= Carbon::parse('16:00:00')->format('H:i:s') || $attendance->checkOut >= Carbon::parse('17:30:00')->format('H:i:s'))
                    $attendance->lateOut = $attendance->checkOut;
            }
        }

        if ($request->input('checkIn')) {
            if ($attendance->checkOut) {
                $date2 = Carbon::parse($attendance->checkOut);
                $date1 = Carbon::parse($request->input('checkIn'));
                $result = $date1->diff($date2);
                $totals = Carbon::parse($result->h . ':' . $result->i . ':' . $result->s)->format('H:i:s');
                $attendance->checkIn = Carbon::parse($request->input('checkIn'))->format('H:i:s');
                $attendance->total = $totals;
            } else {
                $attendance->checkIn = $request->input('checkIn');
            }
        }

        if ($request->input('checkOut')) {
            if ($attendance->checkIn) {
                $date2 = Carbon::parse($request->input('checkOut'));
                $date1 = Carbon::parse($attendance->checkIn);
                $result = $date1->diff($date2);
                $totals = Carbon::parse($result->h . ':' . $result->i . ':' . $result->s)->format('H:i:s');
                $attendance->checkOut = Carbon::parse($request->input('checkOut'))->format('H:i:s');
                $attendance->total = $totals;
            } else {
                $attendance->checkOut = $request->input('checkOut');
            }
        }

        $attendance->save();
        return redirect()->back();
    }


}
