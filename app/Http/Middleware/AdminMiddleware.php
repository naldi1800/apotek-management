<?php

namespace App\Http\Middleware;
// use Auth;

use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd( Auth::user()->getTable());
        if (!Auth::guard('web')->check()) {
            return redirect()->route('login')->with('error', 'You must login as admin!');
        }

        return $next($request);
    }
}
