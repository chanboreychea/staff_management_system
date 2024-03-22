<?php

namespace App\Http\Controllers;

use App\Enum\Approve;
use Carbon\Carbon;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function index()
    {
        $booking = DB::table('booking')
            ->join('users', 'users.id', '=', 'booking.userId')
            ->where('booking.date', '>=', Carbon::now()->format('Y-m-d'))
            ->where('isApprove', Approve::PENDING)
            ->orderByDesc('date')
            ->select(
                'booking.id',
                'users.firstNameKh',
                'users.lastNameKh',
                'users.email',
                'users.phoneNumber',
                'date',
                'topicOfMeeting',
                'directedBy',
                'meetingLevel',
                'member',
                'room',
                'time',
                'description',
            )->get();

        return view('admin.booking.index', compact('booking'));
    }

    public function userDestroy(Request $request, string $bookingId)
    {
        $booking = Booking::find($bookingId);
        $booking->delete();
        return redirect('/calendar')->with('message', 'Update Successfully');
    }

    public function adminApprove(Request $request, string $bookingId)
    {
        $booking = Booking::find($bookingId);

        $request->validate([
            'description' => 'max:255'
        ]);

        if ($request->input('description')) {
            $booking->description = $request->input('description');
        }
        if ($request->input('approve')) {
            $booking->isApprove = Approve::APPROVE;
        }
        if ($request->input('reject')) {
            $booking->isApprove = Approve::REJECT;
        }

        $booking->save();

        return redirect('/booking')->with('message', 'Update Successfully');
    }

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

        $booking = DB::table('booking')
            ->join('users', 'users.id', '=', 'booking.userId')
            ->where('booking.date', '>=', Carbon::now()->format('Y-m-d'))
            ->where('isApprove', Approve::APPROVE)
            ->orderByDesc('date')
            ->select(
                'users.firstNameKh',
                'users.lastNameKh',
                'users.email',
                'users.phoneNumber',
                'booking.id',
                'date',
                'userId',
                'topicOfMeeting',
                'directedBy',
                'meetingLevel',
                'member',
                'description',
                'room',
                'time'
            )->get();

        return view('booking.calendar', compact('booking', 'dday', 'calendar'));
    }

    public function showRoomAndTime(Request $request, string $day)
    {
        $now = Carbon::now()->format('Y-m');
        $now = Carbon::parse($now . '-' . $day);
        $day = $this->getDayKhmer($now->format('D'));
        $month = $this->getMonthKhmer($now->format("M"));
        $date = "ថ្ងៃ $day ទី " . $now->format('d') . " ខែ $month ឆ្នាំ " . $now->format('Y');

        $booking = DB::table('booking')
            ->join('users', 'users.id', '=', 'booking.userId')
            ->where('date', $now->format('Y-m-d'))
            ->where('isApprove', Approve::APPROVE)
            ->where('userId', session('user_id'))
            ->select(
                'users.firstNameKh',
                'users.lastNameKh',
                'date',
                'topicOfMeeting',
                'directedBy',
                'meetingLevel',
                'member',
                'description',
                'room',
                'time',
            )->get();

        $verifyTimesBooking = DB::table('booking')
            ->where('date', $now->format('Y-m-d'))
            ->where('isApprove', Approve::APPROVE)
            ->select(
                'room',
                'time',
            )->get();

        return view('booking.showRoomAndTime', compact('verifyTimesBooking', 'booking', 'now', 'date', 'day'));
    }

    public function bookingRoom(Request $request)
    {

        $request->validate([
            'topic' => 'bail|required|max:100',
            'directedBy' => 'bail|required|max:100',
            'member' => 'bail|required|digits_between:1,2',
            'description' => 'max:255',
            'room' => 'required',
            'times' => 'required'
        ], [
            'topic.required' => 'សូមបញ្ចូលនូវឈ្មោះនាយកដ្ឋាន',
            'topic.max' => 'អក្សរអនុញ្ញាតត្រឹម​ ១០០​ តួរ',
            'directedBy.required' => 'សូមបញ្ចូលនូវឈ្មោះអ្នកដឹកនាំ',
            'directedBy.max' => 'អក្សរអនុញ្ញាតត្រឹម​ ១០០​ តួរ',
            'member.required' => 'សូមបញ្ចូលនូវចំនួនសមាជិក',
            'member.min' => 'អក្សរអនុញ្ញាតតិចបំផុតត្រឹម​ ២ តួរ',
            'member.max' => 'អក្សរអនុញ្ញាតត្រឹម​ ១០០​ តួរ',
            'description.max' => 'អក្សរអនុញ្ញាតត្រឹម​ ២៥៥​ តួរ'
        ]);

        $topic = $request->input('topic');
        $directedBy = $request->input('directedBy');
        $meetingLevel = $request->input('meetingLevel');
        $member = $request->input('member');
        $date = Carbon::parse($request->input('date'))->format("Y-m-d");
        $room = $request->input('room');
        $times = $request->input('times');
        $description = $request->input('description');

        $userId = session('user_id');

        DB::beginTransaction();
        try {

            Booking::create([
                'userId' => $userId,
                'date' => $date,
                'topicOfMeeting' => $topic,
                'directedBy' => $directedBy,
                'meetingLevel' => $meetingLevel,
                'member' => $member,
                'room' => $room,
                'time' => $times,
                'description' => $description,
                'isApprove' => Approve::PENDING
            ]);

            $today = Carbon::now();

            $user = User::find($userId);

            $message = "សំណើសុំប្រើប្រាស់បន្ទប់ប្រជុំ" . PHP_EOL . "ដឹកនាំដោយ៖ $directedBy " . PHP_EOL . "ប្រធានបទស្តីពី៖ $topic" . PHP_EOL .
                "ចំនួនសមាជិកចូលរួម៖ $member រូប" . PHP_EOL . "ប្រភេទបន្ទប់ប្រជុំ៖ បន្ទប់ប្រជុំ $room" . PHP_EOL . "កម្រិតប្រជុំ៖ $meetingLevel" . PHP_EOL .
                "កាលបរិច្ឆេទកិច្ចប្រជុំ៖ $date " . PHP_EOL .
                "ម៉ោង៖ $times" . PHP_EOL . "កាលបរិច្ឆេទស្នើសុំ៖ $today" . PHP_EOL . "អ៊ីមែល: $user->email" . PHP_EOL . "ឈ្មោះមន្រ្តីស្នើសុំ៖ $user->lastNameKh $user->firstNameKh";

            $this->sendMessage(1499573227, $message, "7016210108:AAFqqisOdt9lCixJ7Hg1y9HYJosomMam2fc");
            //hamm// $this->sendMessage(-1002100151991, $message, "6914906518:AAH3QI2RQRA2CVPIL67B9p6mFtQm3kZwyvU");

            DB::commit();
            return redirect('/calendar')->with('message', 'Booking Successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('/calendar')->with('message', 'Please try again!!');
        }
    }

    public function send(Request $request, string $message)
    {
        // return $this->sendMessage(1499573227, $message, "7016210108:AAFqqisOdt9lCixJ7Hg1y9HYJosomMam2fc");
        // return $this->sendMessage(2100151991, $message, "6914906518:AAH3QI2RQRA2CVPIL67B9p6mFtQm3kZwyvU");
    }

    public function sendMessage($chatId, $message, $token)
    {
        $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chatId;
        $url = $url . "&text=" . urlencode($message);
        $ch = curl_init();
        $opt_array = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false, // Disable SSL verification
        );
        curl_setopt_array($ch, $opt_array);
        $result = curl_exec($ch);

        if ($result === false) {
            $error = curl_error($ch);
            // Handle the error, e.g., log it or display an error message
            echo "cURL Error: " . $error;
        } else {
            // Request successful, you can process the result here
            echo "Message sent successfully!";
        }

        curl_close($ch);
    }
}
