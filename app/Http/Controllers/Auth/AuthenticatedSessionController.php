<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    // public function create(): View
    // {
    //     // Auth::loginUsingId(1);
    //     return view('auth.login');
    // }

    public function create()
    {
        // Auth::loginUsingId(1);
        // return redirect()->route('home');
        return view('auth.login');
    }


    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {

        $request->authenticate();
        $request->session()->regenerate();

        // Check if user is admin
        if (Auth::user()->getTable() === 'users') {
            return redirect()->intended(route('home', absolute: false));
        }

        // If not admin, logout and redirect back
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('error', 'Please login as employee using the employee login form.');

        // $request->authenticate();

        // $request->session()->regenerate();

        // return redirect()->intended(route('home', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        if (Auth::guard('employee')->check()) {
            // Update employee status to 0 (offline) on logout
            \App\Models\Employee::where('id', Auth::guard('employee')->id())->update([
                'status' => 0,
            ]);
        }


        Auth::guard('web')->logout();
        Auth::guard('employee')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
