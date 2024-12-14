<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Определяет, следует ли установить cookie XSRF-TOKEN в ответе.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * URI, которые должны быть исключены из проверки CSRF.
     *
     * @var array
     */
    protected $except = [
        //
    ];
}
