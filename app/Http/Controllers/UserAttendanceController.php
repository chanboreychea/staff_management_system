<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class UserAttendanceController extends Controller
{
    public function showAttendanceByUserId(Request $request, string $userId)
    {

        $date = Carbon::today();
        $user = User::all()->where('id', $userId)->first();

        $query = Attendance::where('userId', $user->idCard);

        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        if ($fromDate && $toDate) {
            $query->whereBetween('date', [$fromDate, $toDate]);
        } else {
            $firstDayOfMonth = $date->format('Y-m-01');
            $yesterday = $date->subDay(1)->format('Y-m-d');
            $query->whereBetween('date', [Carbon::parse($firstDayOfMonth)->format('Y-m-d'), Carbon::parse($yesterday)->format('Y-m-d')]);
        }

        $attendances = $query->orderByDesc('date')->get();

        return view('attendance.showUserAttendance', compact('attendances'));
    }
}
