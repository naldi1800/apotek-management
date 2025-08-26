<?php

namespace App\Http\Middleware;

use Closure;
// use Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmployeeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (empty(Auth::guard('employee')->check())) {
            return redirect()->route('login')->with('error', 'You must login as employee!');
        }

        $employee = Auth::guard('employee')->user();

        // Cek status employee
        if ($employee->status == -1) {
            Auth::guard('employee')->logout();
            return redirect()->route('login')->with('error', 'Your account has been suspended.');
        }

        return $next($request);
    }
}
