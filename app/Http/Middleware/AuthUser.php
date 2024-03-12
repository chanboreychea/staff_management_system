<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

class AuthUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // if (session('user_id') != 986) {
        //     return Redirect::route('user-login');
        // }
        // if($request->test=="abc"){
        //     return redirect('/user/user_information/12');
        // }
        dd($request->input('userid'));
        if (!session('is_user_logged_in')) {

            return redirect()->route('user-login');
        }
        return $next($request);
    }
}
