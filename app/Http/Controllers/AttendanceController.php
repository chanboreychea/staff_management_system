<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Attendance;
use App\Models\Department;
use Rats\Zkteco\Lib\ZKTeco;
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

        if ($request->input('getAtt')) {

            $this->setAttendances($ip, $port);
            return redirect('/attendances')->with('message', 'Attendances Import Successfully');
        } else {

            $zk = new ZKTeco('172.16.15.184', 4370);
            $zk->connect();
            $zk->disableDevice();
            if ($zk->connect()) {
                return 'Connection Success';
            }
            return 'Connection Failed';

            // $users = $zk->getUser();
            // $att = $zk->getAttendance();
            // $a = [];
            // foreach ($att as $i) {
            //     if ($i['timestamp'] > Carbon::parse('2024-02-05 00:00:00')) {
            //         $a[] = [
            //             'attendance' => $i['id'] . ' - ' . $i['timestamp']
            //         ];
            //     }
            // }

            // $u = [];
            // foreach ($users as $i) {
            //     $u[] = [
            //         'user' => $i['userid'] . ' - ' . $i['name']
            //     ];
            // }
            // return view('hrauoffsa.test', compact('u', 'a'))->with('successMsg', 'Property is updated .');
            // dd('test' . ' - ' . $ip . ' - ' . $port);
        }
    }

    public function exportUserAttendanceExcel(Request $request)
    {
        $previousUrl = URL::previous();
        $parsedUrl = parse_url($previousUrl);

        if (isset($parsedUrl['query'])) {
            parse_str($parsedUrl['query'], $queryParams);
        } else {
            return $this->userAttendancesByDepartmentAndRole($request);
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
            'total',
            'mission'
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
            $thisMonth = $this->getDatesByPeriodName('this_month', $date);
            $amountDays =  $this->getDaysExcludingWeekend($date->format('Y'), $date->format('m'));
            $query->whereBetween('date', [Carbon::parse($thisMonth[0])->format('Y-m-d'), Carbon::parse($thisMonth[1])->format('Y-m-d')]);
        }

        $attendances = $query->get();
        $users = $queryUser->get();
        // dd($attendances);
        $morningStop = Carbon::parse('09:00:00')->format('H:i:s');
        $eveningStart = Carbon::parse('16:00:00')->format('H:i:s');
        $eveningStop = Carbon::parse('17:30:00')->format('H:i:s');

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
                    //work
                    if ($item->checkIn != null && $item->checkOut >= $eveningStart && $item->checkOut <= $eveningStop) {
                        $work++;
                        // dd(1);
                    } elseif ($item->checkIn <= $morningStop && $item->lateOut) {
                        $work++;
                    } elseif ($item->lateIn && $item->checkOut >= $eveningStart && $item->checkOut <= $eveningStop) {
                        $work++;
                        // dd(3);
                    } elseif ($item->lateIn && $item->lateOut) {
                        $work++;
                        // dd(4);
                    } else {
                        $absent++;
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
                'work' => $work,
                'leave' => $leave,
                'absent' => $amountDays - ($work + $mission + $leave),
                'lateIn' => $lateIn,
                'lateOut' => $lateOut,
                'mission' => $mission
            ];
        }

        return Excel::download(new AttendanceExportMuiltpleSheets($export), 'attendances.xlsx');
    }

    public function userAttendancesByDepartmentAndRole(Request $request)
    {
        //get attendances by department
        $date = Carbon::now();
        $thisMonth = $this->getDatesByPeriodName('this_month', $date);
        $amountDays =  $this->getDaysExcludingWeekend($date->format('Y'), $date->format('m'));

        $query = Attendance::select(
            'userId',
            'date',
            'leave',
            'checkIn',
            'lateIn',
            'checkOut',
            'lateOut',
            'total',
            'mission'
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

        $query->whereBetween('date', [Carbon::parse($thisMonth[0])->format('Y-m-d'), Carbon::parse($thisMonth[1])->format('Y-m-d')]);
        $attendances = $query->get();
        $users = $queryUser->get();

        $morningStop = Carbon::parse('09:00:00')->format('H:i:s');
        $eveningStart = Carbon::parse('16:00:00')->format('H:i:s');
        $eveningStop = Carbon::parse('17:30:00')->format('H:i:s');

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

                    //work
                    if ($item->checkIn != null && $item->checkOut >= $eveningStart && $item->checkOut <= $eveningStop) {
                        $work++;
                        // dd(1);
                    } elseif ($item->checkIn <= $morningStop && $item->lateOut) {
                        $work++;
                    } elseif ($item->lateIn && $item->checkOut >= $eveningStart && $item->checkOut <= $eveningStop) {
                        $work++;
                        // dd(3);
                    } elseif ($item->lateIn && $item->lateOut) {
                        $work++;
                        // dd(4);
                    } else {
                        $absent++;
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
                'work' => $work,
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
                'total'
            );

        if ($uid) {
            $query->whereIn('users.idCard', $uid);
        }

        if ($fromDate && $toDate) {
            $query->whereBetween('date', [$fromDate, $toDate]);
        } else {
            $thisMonth = $this->getDatesByPeriodName('this_month', Carbon::now());
            $query->whereBetween('date', [Carbon::parse($thisMonth[0])->format('Y-m-d'), Carbon::parse($thisMonth[1])->format('Y-m-d')]);
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

    public function showAttendanceByUserId(Request $request, string $userId)
    {

        $date = Carbon::today();
        $user = User::all()->where('id', $userId)->first();

        //today
        $morning = $this->checkIn($date);
        $evening = $this->checkOut($date);



        $d = Carbon::now()->format('D');
        $dd = Carbon::now()->format('d');
        $m = Carbon::now()->format('M');
        $y = Carbon::now()->format("Y");
        $day = $this->getDayKhmer($d);
        $month = $this->getMonthKhmer($m);

        $today = "ថ្ងៃ " . $day . ' ទី​​ ' . $dd . ' ខែ ' . $month . ' ឆ្នាំ ' . $y;

        //last week
        $lastWeek = $this->getDatesByPeriodName('last_week', $date);
        $fromToDate = $this->getFromDateToDate($lastWeek[0], $lastWeek[1]);


        //last month
        $lastMonth = $this->getDatesByPeriodName('last_month', clone $date);
        $fromToDate = $this->getFromDateToDate($lastMonth[0], $lastMonth[1]);


        return view('admin.attendance.show', compact('user'));
    }
}
