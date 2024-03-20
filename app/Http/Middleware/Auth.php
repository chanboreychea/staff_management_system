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

        if ($request->session()->has('is_admin_logged_in') == false) {

            if ($request->session()->has('admin_attendance') == true) {

                return $next($request);
            }
            if ($request->session()->has('admin_booking') == true) {

                return $next($request);
            }

            return redirect()->route('login');
        }

        return $next($request);
    }
}
