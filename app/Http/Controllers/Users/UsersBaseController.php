<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request; // Запрос
use App\Http\Controllers\Controller; // Контроллер

class UsersBaseController extends Controller
{
    public function __construct() // Конструктор
    {
        $this->middleware('auth'); // Промежуточное ПО для аутентификации
        $this->middleware('user'); // Промежуточное ПО для проверки пользователя
    }

    public function index() // Индекс
    {
        return view('public.users.profile'); // Возврат представления профиля пользователя
    }

}
