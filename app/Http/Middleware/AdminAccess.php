<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // only role 1 and 2 can access this route
        if (auth()->user()->role == 1 || auth()->user()->role == 2) {
            return $next($request);
        } else {
            return redirect()->route('user.home');
        }
    }
}
