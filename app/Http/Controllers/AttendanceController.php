<?php

namespace App\Http\Controllers;

use App\Exports\AttendanceExport;
use App\Models\User;
use App\Models\Department;
use Rats\Zkteco\Lib\ZKTeco;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Maatwebsite\Excel\Facades\Excel;

class AttendanceController extends Controller
{

    public function getAtt(Request $request)
    {
        $ip = $request->input('ip');
        $port = $request->input('port');

        if ($request->input('getAtt')) {

            dd('get attendances' . ' - ' . $ip . ' - ' . $port);
        } else {

            return redirect('/attendances')->with('successMsg', 'Property is updated .');
            // dd('test' . ' - ' . $ip . ' - ' . $port);
        }
        // $zk = new ZKTeco('172.16.15.184', 4370);
        // $zk->connect();
        // $zk->disableDevice();
        // $users = $zk->getUser();
        // $u = [];
        // foreach ($users as $user) {
        //     $u[] = [
        //         'user' => $user['name'] . ' - ' . $user['userid']
        //     ];
        // }

        // return view('hrauoffsa.test', compact('u'));
    }

    public function export(Request $request)
    {
        $previousUrl = URL::previous();
        $parsedUrl = parse_url($previousUrl);

        if (isset($parsedUrl['query'])) {
            parse_str($parsedUrl['query'], $queryParams);
        } else {
            $query = DB::table('attendances')->join('users', 'users.idCard', '=', 'attendances.userId')
                ->select('users.id', 'attendances.id', 'users.lastNameKh', 'users.firstNameKh', 'userId', 'date', 'checkIn', 'checkOut', 'total');
            $attendances = $query->whereDate('date', Carbon::parse('2024-02-01'))->orderBy('attendances.id', 'desc')->get();
            return Excel::download(new AttendanceExport($attendances), 'attendances.xlsx');
        }

        $fromDate = $queryParams['fromDate'];
        $toDate = $queryParams['toDate'];

        $query = DB::table('attendances')->join('users', 'users.idCard', '=', 'attendances.userId')
            ->select('users.id', 'attendances.id', 'users.lastNameKh', 'users.firstNameKh', 'userId', 'date', 'checkIn', 'checkOut', 'total');

        if (isset($queryParams['uid'])) {
            $query->whereIn('users.idCard', $queryParams['uid']);
        }

        if ($fromDate && $toDate) {
            $query->whereBetween('date', [$fromDate, $toDate]);
        }

        $attendances = $query->orderBy('date', 'desc')->get();

        return Excel::download(new AttendanceExport($attendances), 'attendances.xlsx');
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
            ->join('users', 'users.idCard', '=', 'attendances.userId')
            ->select(
                'users.id',
                'attendances.id',
                'users.idCard',
                'users.lastNameKh',
                'users.firstNameKh',
                'userId',
                'date',
                'checkIn',
                'checkOut',
                'total'
            );

        if ($uid) {
            $query->whereIn('users.idCard', $uid);
        }

        if ($fromDate && $toDate) {
            $query->whereBetween('date', [$fromDate, $toDate]);
        } else {
            $thisWeek = $this->getDatesByPeriodName('this_month', Carbon::now());
            $query->whereBetween('date', [Carbon::parse($thisWeek[0])->format('Y-m-d'), Carbon::parse($thisWeek[1])->format('Y-m-d')]);
        }

        $attendances = $query->orderBy('date', 'desc')->get();

        return view('admin.attendance.index', compact('attendances', 'users', 'departments'));
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
