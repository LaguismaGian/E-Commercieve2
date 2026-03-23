<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if user is logged in and has admin role
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }
        
        // If not admin, redirect to home page with error
        return redirect('/')->with('error', 'You do not have admin access.');
    }
}