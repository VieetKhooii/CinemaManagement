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
        '/admin/*',
        '/areas',
        '/areas/hide/*',
        '/branches',
        '/branches/*',
        '/branches/hide/*',
        '/categories',
        '/combos',
        '/logout',
        '/login',
        '/movies',
        '/password',
        '/password/*',
        '/sign-up',
        '/refresh',
        '/reset-password/*',
        '/roles',
        '/rooms',
        '/showtimes',
        '/tokens/create',
        '/transactions',
        '/users',
        '/users/*',
        '/vouchers'
    ];
}
