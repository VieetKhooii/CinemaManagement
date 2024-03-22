<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\RedirectResponse;

class AttachJwtToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->cookie('jwt');
        // $response = $next($request);
        // Check if the token exists
        if ($token) {
            // Attach the token to the Authorization header
            $request->headers->set('Authorization', 'Bearer ' . $token);
        }
        else {
            // Handle the case where the token is missing or invalid
            return new RedirectResponse('/login');
        }
        
        // Pass the request to the next middleware or controller
        return $next($request);
    }
}
