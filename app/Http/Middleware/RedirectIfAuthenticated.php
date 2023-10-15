<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard('web')->check()) {
                return redirect(RouteServiceProvider::HOME);
            }

            if (Auth::guard('student')->check()) {
                return redirect(RouteServiceProvider::STUDENT);
            }

            if (Auth::guard('teacher')->check()) {
                return redirect(RouteServiceProvider::TEACHER);
            }

            if (Auth::guard('parent')->check()) {
                return redirect(RouteServiceProvider::PARENT);
            }
        }
        return $next($request);
    }
}
