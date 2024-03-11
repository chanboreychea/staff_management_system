<?php

use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DepartmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

    //if cookie return to user
    if (session('user_id') == 987) {
        return Redirect::route('user-attendances');
    }

    return view('index');
})->name('login');

Route::get('/ip', function (Request $request) {
    // $clientIpAddress = $request->getClientIp();
    // $clientIpAddress = $request->ip();
    // $clientIpAddress = $_SERVER['REMOTE_ADDR'];
    // $client_ip = $_SERVER['REMOTE_ADDR'];
    $client_ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
    echo "Client IP Address: " . $client_ip;

    $agent = new Agent();
    // Get device information
    $device = $agent->device();
    $browser = $agent->browser();
    $platform = $agent->platform();
    $a = $agent->isMobile();
    $b = $agent->isTablet();
    $c = $agent->is('Windows');

    // $ipLong = ip2long($clientIpAddress);
    // $startLong = ip2long('172.16.0.0');
    // $endLong = ip2long('172.16.254.254');
    // // $startLong = ip2long('127.0.0.0');
    // // $endLong = ip2long('127.0.0.254');

    // if ($ipLong >= $startLong && $ipLong <= $endLong) {
    //     // dd($startLong.' - '.$ipLong.' - '.$endLong);
    //     dd($clientIpAddress);
    // } else {
    //     dd('khos');
    // }
});

Route::get('/h', function () {
    $date = Carbon::now();
    $at = new Controller();
    $daysInMonth = intval(date('t'));

    $month = $at->getDatesByPeriodName('this_month', $date);

    $startDay = Carbon::parse($month[0])->format('Y-m-d D');
    $endDay = Carbon::parse($month[1])->format('Y-m-d D');

    // dd($startDay . ' - ' . $endDay);
    return view('calendar', compact('daysInMonth',));
});

Route::get('/c', [BookingController::class, 'calendar']);
Route::get('/rooms/{day}', [BookingController::class, 'showRoomAndTime']);
Route::post('/booking', [BookingController::class, 'bookingRoom']);


Route::get('/getAtt', [AttendanceController::class, 'getAtt'])->name('attendance-connection');

Route::post('/login', [authController::class, 'login']);
Route::get('/logout', [authController::class, 'logout']);

Route::middleware(['authm'])->group(function () {
    Route::resource('/users', UserController::class);
    Route::resource('/roles', RoleController::class);
    Route::resource('/departments', DepartmentController::class);
    Route::resource('/offices', OfficeController::class);


    Route::post('/attendances', [AttendanceController::class, 'addUserAttendance']);
    Route::get('/attendances', [AttendanceController::class, 'attendances'])->name('user-attendances');
    Route::get('/attendances/{userId}', [AttendanceController::class, 'showAttendanceByUserId']);
    Route::patch('/attendances/{attendanceId}', [AttendanceController::class, 'updateAttendanceById']);
    Route::get('/attendaces/export/excel', [AttendanceController::class, 'exportUserAttendanceExcel']);
    Route::post('/attendances/import/excel', [AttendanceController::class, 'importUserAttendanceExcel']);
});
