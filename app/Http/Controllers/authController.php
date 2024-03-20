<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class authController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ], [
            'username.required' => 'Please input the username',
            'password.required' => 'Please input the password'
        ]);

        $username = $request->input('username');
        $password = $request->input('password');

        $user = User::where('idCard', $username)->first();

        if ($user) {
            if ($user->idCard == 53 && Hash::check($password, $user->password)) {
                // $request->session()->flush();
                session(['admin_attendance' => true, 'admin_attendance_id' =>   $user->idCard]);
                return redirect('/attendances');
            } else if ($user->idCard == 50 && Hash::check($password, $user->password)) {
                // $request->session()->flush();
                session(['admin_booking' => true, 'admin_booking_id' =>   $user->idCard]);
                return redirect('/booking');
            }
        }

        if ($username == 'admin.iauoffsa.gov.kh' && $password == "123") {
            session(['is_admin_logged_in' => true, 'admin_id' => "B0r3y!19"]);
            return redirect('/users');
        }
        //if attendance management


        //if booking management


        //else
        return Redirect::route('login');
    }

    public function logout(Request $request)
    {
        // $request->session()->flush(); use to delete all session
        if ($request->session()->has('is_admin_logged_in')) {
            $request->session()->pull('is_admin_logged_in');
            $request->session()->pull('admin_id');
        }
        if ($request->session()->has('admin_attendance')) {
            $request->session()->pull('admin_attendance');
            $request->session()->pull('admin_attendance_id');
        }
        if ($request->session()->has('admin_booking')) {
            $request->session()->pull('admin_booking');
            $request->session()->pull('admin_booking_id');
        }
        return Redirect::route('login');
    }
}
