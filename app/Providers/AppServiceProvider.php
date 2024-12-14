<?php

namespace App\Providers;

use Illuminate\Database\Schema\Builder;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Регистрация любых сервисов приложения.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Инициализация любых сервисов приложения.
     *
     * @return void
     */
    public function boot()
    {
        Builder::defaultStringLength(191);
    }
}
