<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

class Auth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (session('admin_id') != "B0r3y!19") {
            return Redirect::route('login');
        }
        // if($request->test=="abc"){
        //     return redirect('/user/user_information/12');
        // }
        // if (!session('is_logged_in')) {s
        //     return redirect()->route('login');
        // }
        return $next($request);
    }
}
