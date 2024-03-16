<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        '/areas',
        '/areas/hide/*',
        '/branches',
        '/branches/*',
        '/branches/hide/*',
        '/logout',
        '/login',
        '/password',
        '/password/*',
        '/sign-up',
        '/refresh',
        '/reset-password/*',
        '/tokens/create',
        '/consume',
        '/users',
        '/users/*',
    ];
}
