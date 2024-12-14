<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class EncryptCookies extends Middleware
{
    /**
     * Имена cookie, которые не должны быть зашифрованы.
     *
     * @var array
     */
    protected $except = [
        //
    ];
}
