<?php

namespace App\Http\Controllers;

use App\Models\User;
use Rats\Zkteco\Lib\ZKTeco;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class AttendanceController extends Controller
{

    public function getAtt()
    {
        $zk = new ZKTeco('172.16.15.184', 4370);
        $zk->connect();
        $zk->disableDevice();
        $users = $zk->getUser();

        $u = [];

        foreach ($users as $user) {

            $u[] = [
                'user' => $user['name'] . ' - ' . $user['userid']
            ];
        }

        return view('hrauoffsa.test', compact('u'));
    }

    public function attendances(Request $request)
    {
        $this->setAttendances();

        $userIdCard = $request->input('search');
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        $query = DB::table('attendances')->join('users', 'users.idCard', '=', 'attendances.userId')
            ->select('attendances.id', 'users.firstNameKh', 'users.lastNameKh', 'userId', 'date', 'checkIn', 'checkOut', 'total');
        $today = Carbon::today();

        if ($userIdCard) {
            $query->where('userId', $userIdCard);
        }

        if ($fromDate && $toDate) {
            $query->whereBetween('date', [$fromDate, $toDate]);
        } else {
            $query->whereDate('date', Carbon::parse($today)->format('Y-m-d'));
        }

        $attendances = $query->orderBy('id', 'desc')->get();

        return view('admin.attendance.index', compact('attendances'));
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
