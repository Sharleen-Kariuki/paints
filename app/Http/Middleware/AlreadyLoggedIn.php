<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;


class AlreadyLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       $restrictedRoutes = [
        url('/'),
        url('/registration'),
        url('/forgot-password'),
        // handle token-based reset routes dynamically:
        // we use `str_contains` for /reset-password/*
    ];

    if (Session::has('loginId')) {
        if (in_array($request->url(), $restrictedRoutes) || str_contains($request->url(), '/reset-password')) {
            return redirect('dashboard');
        }
    }
    return $next($request);
    }
}




