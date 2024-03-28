<?php

namespace App\Http\Middleware;

use Closure;
use \Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\Cookie;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RefreshTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Refresh token expiration time
        $token = Cookie::get('jwt'); // Assuming your JWT token is stored in a cookie named 'jwt_token'
        if ($token) {
            $newToken = Auth::refresh($token);
            Cookie::queue('jwt', $newToken, config('jwt.ttl')); // Update token in cookie with new expiration time
        }

        return $response;
    }
}
