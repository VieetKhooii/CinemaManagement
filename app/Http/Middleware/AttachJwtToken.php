<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\RedirectResponse;
use \Illuminate\Support\Facades\Cookie;

class AttachJwtToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $token = Cookie::get('jwt');
        if ($token) {
            $request->headers->set('Authorization', 'Bearer ' . $token);
        }
        else {
            return new RedirectResponse('/login');
        }
        return $next($request);
    }
}
