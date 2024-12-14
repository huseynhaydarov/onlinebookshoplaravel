<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Обработка входящего запроса.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check())
        {
            if(Auth::user()->isAdmin())
            {
                return $next($request);
            }
        }
        /*return redirect('/login')->with('alert_message', 'Вы не авторизованы!!');*/
        return abort(403, "Несанкционированный доступ! У вас нет прав для доступа");
    }
}
