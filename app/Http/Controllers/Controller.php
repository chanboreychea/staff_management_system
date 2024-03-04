<?php

namespace App\Http\Controllers;

use DateTime;
use DatePeriod;
use DateInterval;
use App\Models\User;
use App\Models\Attendance;
use Rats\Zkteco\Lib\ZKTeco;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function setAttendances($ip, $port)
    {
        $zk = new ZKTeco($ip, $port);
        $zk->connect();
        $zk->disableDevice();
        $attendances = $zk->getAttendance();

        $attendanceModel = Attendance::all()->last();

        $checkIn = Carbon::now()->subMonths(3)->format('Y-m-d 00:00:00');
        if ($attendanceModel != null) {
            $checkIn = Carbon::parse($attendanceModel->date . '' . $attendanceModel->checkIn);
        }

        $attendanceInsert = [];
        foreach ($attendances as $attendance) {

            if ($attendance['timestamp'] > $checkIn) {

                $attendanceInsert[] = [
                    'userId' => $attendance['id'],
                    'date' =>  Carbon::parse($attendance['timestamp'])->format('Y-m-d'),
                    'checkIn' => Carbon::parse($attendance['timestamp'])->format('H:i:s'),
                    'checkOut' => Carbon::parse($attendance['timestamp'])->format('H:i:s'),
                ];
            }
        }

        foreach ($attendanceInsert as $record) {

            $checkAttendance = Attendance::where('userId', $record['userId'])
                ->Where('date', $record['date'])->first();


            if (is_null($checkAttendance)) {

                if ($record['checkIn'] <= Carbon::parse('12:00:00')->format('H:i:s')) {
                    Attendance::create([
                        'userId' => $record['userId'],
                        'date' => $record['date'],
                        'checkIn' => $record['checkIn'],
                    ]);
                } elseif ($record['checkIn'] >= Carbon::parse('13:00:00')->format('H:i:s')) {
                    Attendance::create([
                        'userId' => $record['userId'],
                        'date' => $record['date'],
                        'checkOut' => $record['checkOut'],
                    ]);
                } else {
                    Attendance::create([
                        'userId' => $record['userId'],
                        'date' => $record['date'],
                        'checkIn' => null,
                        'checkOut' => null,
                    ]);
                }
            } else {

                if (is_null($checkAttendance->checkOut)) {

                    if ($record['checkOut'] >= Carbon::parse('13:00:00')->format('H:i:s')) {

                        if ($checkAttendance->checkIn != null) {
                            $date1 = Carbon::parse($checkAttendance->checkIn);
                            $date2 = Carbon::parse($record['checkOut']);
                            $total = $date1->diff($date2);
                            $totals = Carbon::parse($total->h . ':' . $total->i . ':' . $total->s)->format('H:i:s');
                        } else {
                            $totals = null;
                        }
                        Attendance::where('userId', $record['userId'])
                            ->where('date', $record['date'])
                            ->update([
                                'checkOut' => $record['checkOut'],
                                'total' => $totals
                            ]);
                    }
                }

                if (is_null($checkAttendance->checkIn)) {

                    if ($record['checkIn'] <= Carbon::parse('12:00:00')->format('H:i:s')) {

                        if ($checkAttendance->checkOut == null) {
                            $totals = null;
                        } else {
                            $date1 = Carbon::parse($record['checkIn']);
                            $date2 = Carbon::parse($checkAttendance->checkOut);
                            $total = $date1->diff($date2);
                            $totals = Carbon::parse($total->h . ':' . $total->i . ':' . $total->s)->format('H:i:s');
                        }
                        Attendance::where('userId', $record['userId'])
                            ->where('date', $record['date'])
                            ->update([
                                'checkIn' => $record['checkIn'],
                                'total' => $totals
                            ]);
                    }
                }
            }
        }
    }

    public function getDayKhmer($day)
    {
        if ($day == 'Mon') {
            $day = 'ច័ន្ទ';
        } elseif ($day == 'Tue') {
            $day = 'អង្គារ';
        } elseif ($day == 'Wed') {
            $day = 'ពុធ';
        } elseif ($day == 'Thu') {
            $day = 'ព្រហស្បតិ៍';
        } elseif ($day == 'Fri') {
            $day = 'សុក្រ';
        } elseif ($day == 'Sat') {
            $day = 'សៅរ៍';
        } elseif ($day == 'Sun') {
            $day = 'អាទិត្យ';
        }

        return $day;
    }

    public function getMonthKhmer($month)
    {
        if ($month == 'Jan') {
            $month = 'មករា';
        } elseif ($month == 'Feb') {
            $month = 'កុម្ភៈ';
        } elseif ($month == 'Mar') {
            $month = 'មីនា';
        } elseif ($month == 'Apr') {
            $month = 'មេសា';
        } elseif ($month == 'May') {
            $month = 'ឧសភា';
        } elseif ($month == 'Jun') {
            $month = 'មិថុនា';
        } elseif ($month == 'Jul') {
            $month = 'កក្កដា';
        } elseif ($month == 'Aug') {
            $month = 'សីហា';
        } elseif ($month == 'Set') {
            $month = 'កញ្ញា';
        } elseif ($month == 'Oct') {
            $month = 'តុលា';
        } elseif ($month == 'Nov') {
            $month = 'វិច្ឆិការ';
        } else {
            $month = 'ធ្នូរ';
        }

        return $month;
    }

    public function getDatesByPeriodName($period, $currentDate)
    {
        $dates = ["", ""];

        if ($period == 'today') {
            $dates = [$currentDate->format('Y-m-d'), $currentDate->format('Y-m-d')];
        } elseif ($period == 'sat_sun_of_week') {
            // $currentDateTime = new DateTime();
            $currentDateTime = Carbon::parse($currentDate);
            $currentDateTime->modify('last Sunday');
            $saturday = clone $currentDateTime;
            $saturday->modify('last Saturday');
            $sunday = clone $currentDateTime;
            $dates = [$saturday->format('Y-m-d'), $sunday->format('Y-m-d')];
        } elseif ($period == 'yesterday') {

            $yesterday = $currentDate->sub(new DateInterval('P1D'));
            $currentDateTime = new DateTime();

            $dates = [$yesterday->format('Y-m-d'), $currentDateTime->format('Y-m-d')];
        } elseif ($period == 'this_week') {

            $startDate = date('Y-m-d', strtotime('Monday this week'));
            $endDate = date('Y-m-d', strtotime('Sunday this week'));
            $dates = [$startDate, $endDate];
        } elseif ($period == 'last_week') {

            $startDate = date('Y-m-d', strtotime('Monday last week'));
            $endDate = date('Y-m-d', strtotime('Sunday last week'));
            $dates = [$startDate, $endDate];
        } elseif ($period == 'last_month') {

            $year = date('Y');

            if ($currentDate->format('M') == 'Jan') {
                $year = $currentDate->subYears(1)->format('Y');
            }

            $month = $currentDate->subMonths(1)->format('M');
            $endOfMonth = new DateTime("last day of $month $year");
            $endDate = $endOfMonth->format('Y-m-d');

            $startOfMonth = new DateTime("first day of $month $year");
            $startDate = $startOfMonth->format('Y-m-d');

            $dates = [$startDate, $endDate];
        } elseif ($period == 'this_month') {

            $year = date('Y');
            $month = $currentDate->format('M');

            $startOfMonth = new DateTime("first day of $month $year");
            $startDate = $startOfMonth->format('Y-m-d');

            $endOfMonth = new DateTime("last day of $month $year");
            $endDate = $endOfMonth->format('Y-m-d');

            $dates = [$startDate, $endDate];
        } elseif ($period == 'last_30_days') {

            $endDate = $currentDate->format('Y-m-d');
            $startDate = $currentDate->subDays(30)->format('Y-m-d');
            $dates = [$startDate, $endDate];
        } elseif ($period == 'this_year') {

            $year = date('Y');
            $endOfYear = new DateTime("last day of December $year");
            $endDate = $endOfYear->format('Y-m-d');

            $startOfYear = new DateTime("first day of January $year");
            $startDate = $startOfYear->format('Y-m-d');

            $dates = [$startDate, $endDate];
        } elseif ($period == 'last_year') {

            $year = $currentDate->subYears(1)->format('Y');
            $endOfYear = new DateTime("last day of December $year");
            $endDate = $endOfYear->format('Y-m-d');

            $startOfYear = new DateTime("first day of January $year");
            $startDate = $startOfYear->format('Y-m-d');

            $dates = [$startDate, $endDate];
        }
        return $dates;
    }

    public function getFromDateToDate($startDate, $endDate)
    {
        $date = [];
        $date1 = Carbon::parse($startDate);
        $date2 = Carbon::parse($endDate);
        $dateResult = $date1->diff($date2);
        for ($i = 0; $i < $dateResult->d + 1; $i++) {
            $periodDate = Carbon::parse($startDate)->addDays($i)->format('Y-m-d');
            $date[] = [
                'datePeriod' => $periodDate
            ];
        }
        return $date;
    }

    public function businessDaysBetweenDates($startDate, $endDate)
    {
        $startDate = new DateTime($startDate);
        $endDate = new DateTime($endDate);
        $interval = new DateInterval('P1D'); // 1 day interval
        $period = new DatePeriod($startDate, $interval, $endDate->modify('+1 day'));

        $businessDays = 0;
        foreach ($period as $date) {
            if ($date->format('N') < 6) { // 1-5 are Monday to Friday
                $businessDays++;
            }
        }
        return $businessDays;
    }

    public function getDaysExcludingWeekend($year, $month)
    {
        // Get the number of days in the given month
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        $count = 0;

        // Iterate over each day in the month
        for ($day = 1; $day <= $daysInMonth; $day++) {
            // Create a DateTime object for the current day
            $date = new DateTime("$year-$month-$day");

            // Get the day of the week (0 = Sunday, 6 = Saturday)
            $dayOfWeek = (int)$date->format('w');

            // Check if the day is not Sunday (0) or Saturday (6)
            if ($dayOfWeek !== 0 && $dayOfWeek !== 6) {
                $count++;
            }
        }

        return $count;
    }

    public function checkIn($date)
    {
        $checkIn = ['', ''];
        $morningStart = Carbon::parse($date)->format('Y-m-d 06:30:00');
        $morningEnd = Carbon::parse($date)->format('Y-m-d 09:00:00');
        $checkIn = [$morningStart, $morningEnd];
        return $checkIn;
    }

    public function checkOut($date)
    {
        $checkOut = ['', ''];
        $eveningStart = Carbon::parse($date)->format('Y-m-d 16:00:00');
        $eveningEnd = Carbon::parse($date)->format('Y-m-d 17:30:00');
        $checkOut = [$eveningStart, $eveningEnd];
        return $checkOut;
    }

    public function calendar()
    {
        $month = date('F');
        $year = date('Y');
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
        $firstDay = date('N', strtotime('first day of ' . $month . ' ' . $year));

        $calendar = [];
        $week = [];

        for ($i = 1; $i < $firstDay; $i++) {
            $week[] = '';
        }

        for ($i = 1; $i <= $daysInMonth; $i++) {
            $week[] = $i;
            if (count($week) === 7) {
                $calendar[] = $week;
                $week = [];
            }
        }

        if (count($week) > 0) {
            $calendar[] = $week;
        }

        return view('calendar', compact('month', 'year', 'calendar'));
    }

    // public function setPeriodAttendances($userId, $period)
    // {
    //     $periodAttendance = ['', '', '', ''];

    //     $user = User::all()->where('id', $userId)->first();
    //     $morning = $this->checkIn($period);
    //     $evening = $this->checkOut($period);

    //     $attendanceFirst = DB::table('attendances')->select('id', 'userId', 'timeScan')
    //         ->where('userId', $user->idCard)
    //         ->whereBetween('timeScan', [$morning[0], $morning[1]])->orderBy('id', 'asc')->first();

    //     $attendanceLast = DB::table('attendances')->select('id', 'userId', 'timeScan')
    //         ->where('userId', $user->idCard)
    //         ->whereBetween('timeScan', [$evening[0], $evening[1]])->orderBy('id', 'desc')->first();

    //     if ($attendanceFirst == null) {
    //         $firstScanNull = Carbon::parse($period)->format('Y-m-d 13:00:00');
    //         $date1 = Carbon::parse($firstScanNull);
    //     } else {
    //         $date1 = Carbon::parse($attendanceFirst->timeScan);
    //     }

    //     if ($attendanceLast == null) {
    //         $lastScanNull = Carbon::parse($period)->format('Y-m-d 12:00:00');
    //         $date2 = Carbon::parse($lastScanNull);
    //     } else {
    //         $date2 = Carbon::parse($attendanceLast->timeScan);
    //     }

    //     $difference = $date1->diff($date2);


    //     if ($attendanceFirst) {
    //         $morningY = date('h:i:s a', strtotime($attendanceFirst->timeScan));
    //     } else {
    //         $morningY = 'ពុំមានការស្កេន';
    //     }

    //     if ($attendanceLast) {
    //         $eveningY = date('h:i:s a', strtotime($attendanceLast->timeScan));
    //     } else {
    //         $eveningY = 'ពុំមានការស្កេន';
    //     }



    //     $total = $difference->h . 'ម៉ោង ' . $difference->i . 'នាទី ' . $difference->s . 'វិនាទី';
    //     if ($attendanceFirst == null && $attendanceLast == null) {
    //         $difference = '';
    //         $total = ' 0ម៉ោង 0នាទី 0វិនាទី';
    //     }
    //     $d = Carbon::parse($period)->format('D');
    //     $dd = Carbon::parse($period)->format('d');
    //     $y = Carbon::now()->format("Y");
    //     $dayY = $this->getDayKhmer($d);
    //     $monthY = $this->getMonthKhmer(Carbon::parse($period)->format('M'));

    //     $peroid = "ថ្ងៃ" . $dayY . ' ទី​​' . $dd . ' ខែ' . $monthY . ' ឆ្នាំ' . $y;


    //     $periodAttendance = [$morningY, $eveningY, $total, $peroid];

    //     return $periodAttendance;
    // }
}
