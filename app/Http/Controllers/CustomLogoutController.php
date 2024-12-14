<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomLogoutController extends Controller
{
    /**
     * Выйти из системы для авторизованного пользователя и перенаправить на главную страницу.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout() 
    {
        // Выйти из системы
        auth()->logout();

        // Перенаправить на главную страницу с сообщением о выходе
        return redirect('/')->with('logout_message', "Вы вышли из системы успешно.");
    }
}
