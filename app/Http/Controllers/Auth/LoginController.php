<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Контроллер входа
    |--------------------------------------------------------------------------
    |
    | Этот контроллер отвечает за аутентификацию пользователей в приложении и
    | перенаправление их на главный экран. Контроллер использует трейт
    | для удобного предоставления своей функциональности вашим приложениям.
    |
    */

    use AuthenticatesUsers;

    /**
     * Определяет, куда перенаправить пользователей после входа.
     *
     * @return string
     */
    public function redirectTo()
    {
        $role_id = Auth::user()->role->id;

        switch ($role_id) {
            case '1': // Администратор
                return '/admin-home';
            case '2': // Роль 2 (уточните, куда перенаправить)
                return ''; // Добавьте путь перенаправления
            case '3': // Обычный пользователь
                return '/user-home';
            default: // По умолчанию перенаправление на страницу входа
                return '/login';
        }
    }

    /**
     * Создать новый экземпляр контроллера.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
