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
    $clientIpAddress = $request->ip();
    $agent = new Agent();
    // Get device information
    $device = $agent->device();
    $browser = $agent->browser();
    $platform = $agent->platform();
    $a = $agent->isMobile();
    $b = $agent->isTablet();
    $c = $agent->is('Windows');

    dd($c);
});

Route::get('/h', function () {
    $date = Carbon::now();
    $at = new Controller();
    dd($at->getDaysExcludingWeekend($date->format('Y'), $date->format('m')));
});

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
    Route::get('/attendaces/export/excel', [AttendanceController::class, 'export']);
});
