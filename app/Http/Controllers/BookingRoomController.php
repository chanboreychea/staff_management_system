<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingRoomController extends Controller
{
    public function calendar()
    {
        $date = Carbon::now();
        $month = Carbon::parse($date)->format('m');
        $year = Carbon::parse($date)->format('y');
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, date('Y'));
        $firstDay = date('N', strtotime('first day of' . $month . '' . $year));
        $calendar = [];
        $week = [];

        for ($i = 1; $i <= $firstDay; $i++) {
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

        $booking = [];

        for ($i = 0; $i < 5; $i++) {
            $booking[] = [
                'day' => $i
            ];
        }

        return view('calendar', compact('calendar'));
    }


    public function bookingRoom(Request $request)
    {
        dd($request->input('room1'));
        if ($request->input('startTime') < $request->input('endTime')) {

            // return redirect('/c')->with('message', 'You are booking successfully.');
        }
        return redirect('/c')->with('message', 'Please try again!!!');
    }
}
