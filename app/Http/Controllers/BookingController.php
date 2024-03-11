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

        $booking = DB::table('booking')->leftJoin('rooms_times', 'rooms_times.bookingId', '=', 'booking.id')
            ->join('users', 'users.id', '=', 'booking.userId')
            ->where('booking.date', '>=', Carbon::now()->format('Y-m-d'))
            ->select(
                'users.firstNameKh',
                'users.lastNameKh',
                'users.email',
                'users.phoneNumber',
                'date',
                'topicOfMeeting',
                'directedBy',
                'meetingLevel',
                'member',
                'description',
                'room',
                'time',
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

        $booking = DB::table('booking')->leftJoin('rooms_times', 'rooms_times.bookingId', '=', 'booking.id')
            ->join('users', 'users.id', '=', 'booking.userId')
            ->where('booking.date', $now->format('Y-m-d'))
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

        return view('booking.showRoomAndTime', compact('booking', 'now', 'date', 'day'));
    }

    public function bookingRoom(Request $request)
    {

        $request->validate([
            'topic' => 'bail|required|max:100',
            'directedBy' => 'bail|required|max:100',
            'member' => 'bail|required|min:2|max:50',
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
        $splittedTimeByComma = explode(", ", $times);

        DB::beginTransaction();
        try {

            $lastRecord = Booking::create([
                'userId' => 12,
                'date' => $date,
                'topicOfMeeting' => $topic,
                'directedBy' => $directedBy,
                'meetingLevel' => $meetingLevel,
                'member' => $member,
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

            $today = Carbon::now();

            $message = "សំណើសុំប្រើប្រាស់បន្ទប់ប្រជុំ" . PHP_EOL . "ដឹកនាំដោយ៖ $directedBy " . PHP_EOL . "ប្រធានបទស្តីពី៖ $topic" . PHP_EOL .
                "ចំនួនសមាជិកចូលរួម៖ $member រូប" . PHP_EOL . "ប្រភេទបន្ទប់ប្រជុំ៖ បន្ទប់ប្រជុំ $room" . PHP_EOL . "កម្រិតប្រជុំ៖ $meetingLevel" . PHP_EOL .
                "កាលបរិច្ឆេទកិច្ចប្រជុំ៖ $date " . PHP_EOL .
                "ម៉ោង៖ $times" . PHP_EOL . "កាលបរិច្ឆេទស្នើសុំ៖ $today" . PHP_EOL . "អ៊ីមែល: " . PHP_EOL . "ឈ្មោះមន្រ្តីស្នើសុំ៖ ";

            $this->sendMessage(1499573227, $message, "7016210108:AAFqqisOdt9lCixJ7Hg1y9HYJosomMam2fc");
            //hamm// $this->sendMessage(-1002100151991, $message, "6914906518:AAH3QI2RQRA2CVPIL67B9p6mFtQm3kZwyvU");

            DB::commit();
            return redirect('/c')->with('message', 'Booking Successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('/c')->with('message', 'Please try again!!');
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
