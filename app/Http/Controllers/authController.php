<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class authController extends Controller
{
    public function login(Request $request)
    {
        $this->setAttendances();
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ], [
            'username.required' => 'Please input the username',
            'password.required' => 'Please input the password'
        ]);

        $username = $request->input('username');
        $password = $request->input('password');

        if ($username == 'admin' && $password == 123) {
            session(['is_logged_in' => true, 'user_id' => 987]);
            // return Redirect::route('admin');
            return redirect('/users');
        }
        return Redirect::route('login');
    }

    public function logout(Request $request)
    {
        if ($request->session()->has('is_logged_in')) {

            $request->session()->flush();
            // $request->session()->pull('is_logged_in');
            // $request->session()->pull('user_id');
        }
        return Redirect::route('login');
    }
}
