<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Обработка входящего запроса.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if (Auth::user()->role->name == 'Admin') {
                return redirect('/admin-home');
            } elseif (Auth::user()->role->name == 'User') {
                return redirect('/user-home');
            } else {
                return redirect('/');
            }
        }

        return $next($request);
    }
}
