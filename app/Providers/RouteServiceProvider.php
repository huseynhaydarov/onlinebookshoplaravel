<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Этот пространственный именной пространство применяется к вашим маршрутам контроллеров.
     *
     * Кроме того, он установлен как корневое пространство имен генератора URL.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Определите привязку модели маршрута, фильтры шаблонов и т.д.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Определите маршруты для приложения.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Определите "веб" маршруты для приложения.
     *
     * Эти маршруты все получают состояние сессии, защиту CSRF и т.д.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Определите "api" маршруты для приложения.
     *
     * Эти маршруты обычно без состояния.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
