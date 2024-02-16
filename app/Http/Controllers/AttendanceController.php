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

    public function getAtt(Request $request)
    {
        $ip = $request->input('ip');
        $port = $request->input('port');

        if ($request->input('getAtt')) {

            $this->setAttendances($ip, $port);
            return redirect('/attendances');
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

    public function export(Request $request)
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

        // $query = DB::table('attendances')->join('users', 'users.idCard', '=', 'attendances.userId')
        //     ->select('users.id', 'attendances.id', 'users.lastNameKh', 'users.firstNameKh', 'userId', 'date', 'checkIn', 'checkOut', 'total');

        // $query = Attendance::join('users', 'users.idCard', '=', 'attendances.userId')
        //     ->leftJoin('roles', 'roles.id', '=', 'users.roleId')
        //     ->leftjoin('departments', 'departments.id', '=', 'users.departmentId')
        //     ->groupBy('users.idCard')
        //     ->select(
        //         'users.lastNameKh',
        //         'users.firstNameKh',
        //         'users.gender',
        //         'users.dateOfBirth',
        //         'users.phoneNumber',
        //         'roles.roleNameKh',
        //         'departments.departmentNameKh',
        //         DB::raw(
        //             ' count(`leave`) as `leave`, count(total) as total, count(lateIn) as lateIn, count(lateOut) as lateOut, count(mission) as mission'
        //         )
        //     );

        $query = Attendance::select(
            'userId',
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
        } else {
            $thisMonth = $this->getDatesByPeriodName('this_month', Carbon::now());
            $query->whereBetween('date', [Carbon::parse($thisMonth[0])->format('Y-m-d'), Carbon::parse($thisMonth[1])->format('Y-m-d')]);
        }

        $attendances = $query->get();
        $users = $queryUser->get();

        $timeIn = Carbon::parse('09:00:00')->format('H:i:s');
        $timeOutFirst = Carbon::parse('16:00:00')->format('H:i:s');
        $timeOutSecond = Carbon::parse('17:30:00')->format('H:i:s');

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

                    if ($item->checkIn <= $timeIn && $item->checkOut >= $timeOutFirst && $item->checkOut <= $timeOutSecond) {
                        $work++;
                    } elseif ($item->checkIn > $timeIn && $item->lateIn) {
                        $work++;
                    } elseif ($item->checkOut < $timeOutFirst && $item->checkOut > $timeOutSecond && $item->lateOut) {
                        $work++;
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
                'absent' => $absent,
                'lateIn' => $lateIn,
                'lateOut' => $lateOut,
                'mission' => $mission
            ];
        }
        // dd($export);
        return Excel::download(new AttendanceExportMuiltpleSheets($export), 'attendances.xlsx');
    }

    public function userAttendancesByDepartmentAndRole(Request $request)
    {
        //get attendances by department
        $thisMonth = $this->getDatesByPeriodName('this_month', Carbon::now());

        $query = Attendance::select(
            'userId',
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

        $timeIn = Carbon::parse('09:00:00')->format('H:i:s');
        $timeOutFirst = Carbon::parse('16:00:00')->format('H:i:s');
        $timeOutSecond = Carbon::parse('17:30:00')->format('H:i:s');

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

                    if ($item->checkIn <= $timeIn && $item->checkOut >= $timeOutFirst && $item->checkOut <= $timeOutSecond) {
                        $work++;
                    } elseif ($item->checkIn > $timeIn && $item->lateIn) {
                        $work++;
                    } elseif ($item->checkOut < $timeOutFirst && $item->checkOut > $timeOutSecond && $item->lateOut) {
                        $work++;
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
                'absent' => $absent,
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

        $attendances = $query->orderBy('date', 'desc')->get();

        return view('admin.attendance.index', compact('attendances', 'users', 'departments'));
    }

    public function updateLateInAndLateOut(Request $request, string $attendanceId)
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
