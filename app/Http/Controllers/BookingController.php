<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Booking;
use App\Models\RoomTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function calendar()
    {
        $date = Carbon::now();
        $dday = Carbon::parse($date)->format('d');
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

        return view('booking.calendar', compact('dday', 'calendar'));
    }

    public function showRoomAndTime(Request $request, string $day)
    {
        $date = Carbon::now()->format('Y-m');
        $date = Carbon::parse($date . '-' . $day)->format('Y-m-d');
        return view('booking.showRoomAndTime', compact('date', 'day'));
    }

    public function bookingRoom(Request $request)
    {
        $date = $request->input('date');
        $room = $request->input('room');
        $times = $request->input('times');
        $description = $request->input('description');
        $splittedTimeByComma = explode(", ", $times);

        DB::beginTransaction();
        try {

            $lastRecord = Booking::create([
                'userId' => 12,
                'date' => $date,
                'description' => $description,
                'isApprove' => 1
            ]);

            $booking = [];
            for ($i = 0; $i < count($splittedTimeByComma); $i++) {
                $booking[] = [
                    'bookingId' => $lastRecord->id,
                    'room' => $room,
                    'time' => $splittedTimeByComma[$i],
                    'created_at' => Carbon::now()
                ];
            }

            RoomTime::insert($booking);
            DB::commit();

            return redirect('/c')->with('message', 'Booking Successfully.');
        } catch (\Exception $e) {

            // If an exception occurs, rollback the transaction
            DB::rollback();
            return redirect('/c')->with('message', 'Please try agains!!');
            // Optionally, handle the exception
        }
    }
}
