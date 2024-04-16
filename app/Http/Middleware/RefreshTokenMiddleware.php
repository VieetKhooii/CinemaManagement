<?php

namespace App\Http\Middleware;

use Closure;
use \Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\Cookie;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RefreshTokenMiddleware
{
    
// $token = null;
// $key = null;
// foreach ($_COOKIE as $name => $value) {
//     if (strpos($name, 'jwt') !== false) {
//         $token = $value;
//         $key = $name;
//         break;
//     }
// }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
     public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        $cookie = Cookie::get('jwt');
        $cookie_role = Cookie::get('jwt_role');
        try {
            $newToken = Auth::refresh($cookie);
            $newToken_role = $cookie_role;
            Cookie::queue('jwt', $newToken, config('jwt.ttl'));
            Cookie::queue('jwt_role', $newToken_role, config('jwt.ttl'));
        }
        catch (\Exception $exception){
            echo($exception->getMessage());
        }
        return $response;
    }

        

}
