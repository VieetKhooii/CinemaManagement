<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use \Illuminate\Support\Facades\Cookie;

class PassLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $token = null;
        $cookie = Cookie::get('jwt_role');
        if ($cookie){
            $cookie_data = json_decode($cookie, true);
            $token = $cookie_data['role_id'];
        }
        if ($token) {
            switch ($token) {
                case '1':
                    return new RedirectResponse('/admin');
                    // break;
                case '3':
                    return new RedirectResponse('/dashboard');
                    // break;
                // Add more cases for other roles as needed
                default:
                    // return new RedirectResponse('/dashboard');
                    // break;
            }
        }
        return $next($request);
    }
}
