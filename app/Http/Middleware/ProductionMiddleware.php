<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductionMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // ROLE MUST MATCH YOUR USERS TABLE
        if (Auth::user()->role !== 'production_manager') {
            return redirect()->route('dashboard')
                ->with('error', 'You do not have access to Production pages.');
        }

        return $next($request);
    }
}
