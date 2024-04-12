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
        '/categories',
        '/categories/*',
        '/combos',
        '/combos/*',
        '/logout',
        '/login',
        '/movies',
        '/movies/*',
        '/password',
        '/password/*',
        '/sign-up',
        '/refresh',
        '/reset-password/*',
        '/reservations',
        '/reservations/*',
        '/roles',
        '/roles/*',
        '/rooms',
        '/rooms/*',
        '/seats',
        '/seats/*',
        '/seatTypes',
        '/seatTypes/*',
        '/showtimes',
        '/showtimes/*',
        '/tokens/create',
        '/transactions',
        '/transactions/*',
        '/users',
        '/users/*',
        '/vouchers',
        '/vouchers/*',
    ];
}
