<?php

// use Jenssegers\Agent\Agent;
// use Illuminate\Http\Request;
// use Illuminate\Support\Carbon;
// use App\Http\Controllers\Controller;
// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\authController;
// use App\Http\Controllers\RoleController;
// use App\Http\Controllers\UserController;
// use Illuminate\Support\Facades\Redirect;
// use App\Http\Controllers\OfficeController;
// use App\Http\Controllers\BookingController;
// use App\Http\Controllers\AttendanceController;
// use App\Http\Controllers\DepartmentController;

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
use App\Http\Controllers\AuthUserController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\Frontend\UserProfileController;

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
    if (session('is_user_logged_in')) {
        return redirect('/homepage');
    }
    return view('userLogin');
})->name('user-login');

Route::post('/login', [AuthUserController::class, 'login']);
Route::get('/logout', [AuthUserController::class, 'logout']);

Route::middleware(['authUser'])->group(function () {

    Route::get('/c', [BookingController::class, 'calendar']);
    Route::get('/rooms/{day}', [BookingController::class, 'showRoomAndTime']);
    Route::post('/booking', [BookingController::class, 'bookingRoom']);
    Route::get('/homepage', [HomeController::class, 'index']);
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('index');
    Route::get('/user/profile', [UserProfileController::class, 'index'])->name('index');
    Route::get('/user/profile/userInfo/{id}', [UserProfileController::class, 'updateUserInfo']);
});

//admins

Route::get('/admins', function () {
    return view('adminLogin');
})->name('login');

Route::post('/admins/login', [authController::class, 'login']);
Route::get('/admins/logout', [authController::class, 'logout']);

Route::middleware(['authAdmin'])->group(function () {

    Route::resource('/users', UserController::class);
    Route::resource('/roles', RoleController::class);
    Route::resource('/departments', DepartmentController::class);
    Route::resource('/offices', OfficeController::class);


    Route::get('/getAttendances', [AttendanceController::class, 'getAtt']);
    Route::post('/attendances', [AttendanceController::class, 'addUserAttendance']);
    Route::get('/attendances', [AttendanceController::class, 'attendances'])->name('user-attendances');
    Route::get('/attendances/{userId}', [AttendanceController::class, 'showAttendanceByUserId']);
    Route::patch('/attendances/{attendanceId}', [AttendanceController::class, 'updateAttendanceById']);
    Route::get('/attendaces/export/excel', [AttendanceController::class, 'exportUserAttendanceExcel']);
    Route::post('/attendances/import/excel', [AttendanceController::class, 'importUserAttendanceExcel']);

    // ------------------------get add to insert------------------------------

    Route::post('/user/add_user_infromation', [UserController::class, 'add_user_infromation'])->name('add_user_infromation');

    Route::post('/user/add_user_working_histories', [UserController::class, 'add_user_working_histories'])->name('add_user_working_histories');

    Route::post('/user/add_modal_certificate_of_appreciateion', [UserController::class, 'add_modal_certificate_of_appreciateion'])->name('add_modal_certificate_of_appreciateion');

    Route::post('/user/add_eduction_level', [UserController::class, 'add_eduction_level'])->name('add_eduction_level');

    Route::post('/user/add_ability_language', [UserController::class, 'add_ability_language'])->name('add_ability_language');

    Route::post('/user/add_user_family', [UserController::class, 'add_user_family'])->name('add_user_family');
    // /    ----------------user ajax and return-------------------
    Route::get('/user/user_form_information/{id}', [UserController::class, 'user_form_information']);

    Route::get('/user/additional_current_job/{id}', [UserController::class, 'additional_current_job']);

    Route::get('/user/user_work_history/{id}', [UserController::class, 'user_work_history']);

    Route::get('/user/modal_certificate_of_appreciateion/{id}', [UserController::class, 'modal_certificate_of_appreciateion'])->name('modal_certificate_of_appreciateion');

    Route::get('/user/education_level/{id}', [UserController::class, 'education_level'])->name('education_level');

    Route::get('/user/ability_language/{id}', [UserController::class, 'ability_language'])->name('ability_language');

    Route::get('/user/user_family/{id}', [UserController::class, 'user_family'])->name('user_family');

    Route::get('/user/generate_pdf/{id}', [UserController::class, 'generate_pdf']);

    Route::get('/user/detail/{id}', [UserController::class, 'detail']);
});


//test
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
