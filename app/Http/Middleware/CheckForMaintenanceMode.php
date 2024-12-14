<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode as Middleware;

class CheckForMaintenanceMode extends Middleware
{
    /**
     * URI, которые должны быть доступны, когда режим обслуживания включен.
     *
     * @var array
     */
    protected $except = [
        //
    ];
}
