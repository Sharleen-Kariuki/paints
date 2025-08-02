<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User; // Import your User model

class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Check if user is logged in
        if(!Session()->has('loginId')){
            return redirect('/')->with('fail','You have to login first');
        }

        // If no roles specified, just check authentication
        if(empty($roles)) {
            return $next($request);
        }

        // Get the logged-in user
        $userId = Session()->get('loginId');
        $user = User::find($userId);

        // Check if user exists and has the required role
        if(!$user || !in_array($user->role, $roles)) {
            return redirect('/')->with('fail', 'You do not have permission to access this page');
        }

        return $next($request);
    }
}