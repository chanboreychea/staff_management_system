<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AuthUserController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'userid' => 'required',
            'password' => 'required'
        ], [
            'userid.required' => 'Please input the user ID',
            'password.required' => 'Please input the password'
        ]);

        $userid = $request->input('userid');
        $password = $request->input('password');

        $user = User::where('idCard', $userid)->first();

        if ($user) {

            if (Hash::check($password, $user->password)) {
                session(['is_user_logged_in' => true, 'user_id' => 986]);
                return redirect('/c');
            }
        }

        return Redirect::route('user-login');
    }

    public function logout(Request $request)
    {
        if ($request->session()->has('is_user_logged_in')) {

            // $request->session()->flush();
            $request->session()->pull('is_user_logged_in');
            $request->session()->pull('user_id');
        }
        return Redirect::route('user-login');
    }
}
