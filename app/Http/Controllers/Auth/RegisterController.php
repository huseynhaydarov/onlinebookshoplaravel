<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Контроллер регистрации
    |--------------------------------------------------------------------------
    |
    | Этот контроллер обрабатывает регистрацию новых пользователей, а также
    | их валидацию и создание. По умолчанию этот контроллер использует трейт для
    | предоставления этой функциональности без необходимости дополнительного кода.
    |
    */

    use RegistersUsers;

    /**
     * Куда перенаправить пользователей после регистрации.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Создать новый экземпляр контроллера.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Получить валидатор для входящего запроса на регистрацию.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Создать новый экземпляр пользователя после успешной регистрации.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /*
     * Переопределите функцию регистрации.
     * Сделайте пользовательскую регистрацию и
     * остановите автоматический вход после регистрации.
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        /*$this->guard()->login($user);*/ // Запрещен автоматический вход после регистрации.

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath())
                ->with('success_message', 'Вы зарегистрированы, теперь вы можете войти.');
    }
}
