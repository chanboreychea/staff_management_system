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
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\Frontend\HomeController;

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

     // ------------------------get add to insert------------------------------  

     Route::post('/user/add_user_infromation', [UserController::class, 'add_user_infromation'])->name('add_user_infromation');

     Route::post('/user/add_user_working_histories', [UserController::class, 'add_user_working_histories'])->name('add_user_working_histories');
 
     Route::post('/user/add_modal_certificate_of_appreciateion', [UserController::class, 'add_modal_certificate_of_appreciateion'])->name('add_modal_certificate_of_appreciateion');
    
     Route::post('/user/add_eduction_level',[UserController::class,'add_eduction_level'])->name('add_eduction_level');
 
     Route::post('/user/add_ability_language',[UserController::class,'add_ability_language'])->name('add_ability_language');
     
     Route::post('/user/add_user_family',[UserController::class,'add_user_family'])->name('add_user_family');
    // /    ----------------user ajax and return-------------------
    Route::get('/user/user_form_information/{id}',[UserController::class,'user_form_information']);

    Route::get('/user/additional_current_job/{id}',[UserController::class,'additional_current_job']);

    Route::get('/user/user_work_history/{id}',[UserController::class,'user_work_history']);

    Route::get('/user/modal_certificate_of_appreciateion/{id}', [UserController::class, 'modal_certificate_of_appreciateion'])->name('modal_certificate_of_appreciateion');

    Route::get('/user/education_level/{id}',[UserController::class,'education_level'])->name('education_level');

    Route::get('/user/ability_language/{id}',[UserController::class,'ability_language'])->name('ability_language');

    Route::get('/user/user_family/{id}',[UserController::class,'user_family'])->name('user_family');

    Route::get('/user/generate_pdf/{id}',[UserController::class,'generate_pdf']);
    
    Route::get('/user/detail/{id}', [UserController::class, 'detail']);

   //    ----------------user ajax and return-------------------

    // Route::get('/user/user_medal_certificate_of_application',[UserController::class,'user_medal_certificate_of_application']);
    // Route::get('/user/user_general_education_level_vacational_and_continuing_education',[UserController::class,'user_general_education_level_vacational_and_continuing_education']);
    // Route::get('/user/user_foreign_language_ability',[UserController::class,'user_foreign_language_ability']);
    // Route::get('/user/user_family_status',[UserController::class,'user_family_status']);

    Route::get('/user/test', [UserController::class, 'test']);
});

Route::get('/homepage', [HomeController::class, 'index'])->name('home');
