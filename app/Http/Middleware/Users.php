<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Users
{
    /**
     * Обрабатывает входящий запрос.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check())
        {
            if (Auth::user()->isUser())
            {
                return $next($request);
            }
        }
        /*return redirect('/login')->with('alert_message', "Вы не вошли в систему!");*/
        return abort(403, "Несанкционированный доступ! У вас нет прав для доступа к этому ресурсу");
    }
}
