<?php

use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OfficeController;
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

// Route::get('/', function () {
//     return view('index');
// })->name('login');

// Route::get('/ip', function (Request $request) {
//     // $clientIpAddress = $request->getClientIp();
//     $clientIpAddress = $request->ip();
//     $agent = new Agent();
//     // Get device information
//     $device = $agent->device();
//     $browser = $agent->browser();
//     $platform = $agent->platform();
//     $a = $agent->isMobile();
//     $b = $agent->isTablet();
//     $c = $agent->is('Windows');

//     dd($c);
// });

// Route::get('/h', function () {
//     $date1 = Carbon::parse('2024-01-12 08:23:03');
//     $date2 = Carbon::parse('2024-01-12 17:25:23');
//     $difference = $date1->diff($date2);
//     // dd($difference);
//     return view('hrauoffsa.index', compact('difference'));
// });

// Route::get('/getAtt', [AttendanceController::class, 'getAtt']);


// Route::post('/login', [authController::class, 'login']);
// Route::get('/logout', [authController::class, 'logout']);

// Route::middleware(['authm'])->group(function () {
    Route::resource('/users', UserController::class);
    Route::resource('/roles', RoleController::class);
    Route::resource('/departments', DepartmentController::class);
    Route::resource('/offices', OfficeController::class);

    Route::get('/attendances', [AttendanceController::class, 'attendances']);
    Route::get('/attendances/{userId}', [AttendanceController::class, 'showAttendanceByUserId']);

    // Route::get('/user/user_information/{id}',[UserController::class,'user_information'])->name('user_information');
    // Route::post('/user/add_user_infromation',[UserController::class,'add_user_infromation'])->name('add_user_infromation');
    Route::post('/user/add_user_infromation', [UserController::class, 'add_user_infromation'])->name('add_user_infromation');

    // Route::get('/user/user_information',[UserController::class,'add_user_information'])->name('add_user_information');

    Route::get('/user/user_work_history',[UserController::class,'user_work_history']);
    Route::get('/user/user_medal_certificate_of_application',[UserController::class,'user_medal_certificate_of_application']);
    Route::get('/user/user_general_education_level_vacational_and_continuing_education',[UserController::class,'user_general_education_level_vacational_and_continuing_education']);
    Route::get('/user/user_foreign_language_ability',[UserController::class,'user_foreign_language_ability']);
    Route::get('/user/user_family_status',[UserController::class,'user_family_status']);
// });
