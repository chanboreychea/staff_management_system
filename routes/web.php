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

Route::get('/', function () {
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
    $date1 = Carbon::parse('2024-01-12 08:23:03');
    $date2 = Carbon::parse('2024-01-12 17:25:23');
    $difference = $date1->diff($date2);
    // dd($difference);
    return view('hrauoffsa.index', compact('difference'));
});

Route::get('/getAtt', [AttendanceController::class, 'getAtt']);


Route::post('/login', [authController::class, 'login']);
Route::get('/logout', [authController::class, 'logout']);

Route::middleware(['authm'])->group(function () {
    Route::resource('/users', UserController::class);
    Route::resource('/roles', RoleController::class);
    Route::resource('/departments', DepartmentController::class);
    Route::resource('/offices', OfficeController::class);

    Route::get('/attendances', [AttendanceController::class, 'attendances']);
    Route::get('/attendances/{userId}', [AttendanceController::class, 'showAttendanceByUserId']);
    Route::patch('/attendances/{attendanceId}',[AttendanceController::class, 'updateLateInAndLateOut']);
    Route::get('/attendaces/export/excel', [AttendanceController::class, 'export']);
    Route::get('/att', [AttendanceController::class, 'attendancesByDepartmentAndRole']);
});
