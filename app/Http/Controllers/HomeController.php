<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeLoginRequest;
use App\Models\Employee;
use App\Models\Inventory;
use App\Models\Medicine;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class HomeController extends Controller
{
    public function index()
    {
        $medicine = Medicine::all()->count();
        $transaction = Transaction::all()->count();
        $inventory = Inventory::where('type', 'masuk')->sum('quantity');
        $inventory_keluar = Inventory::where('type', 'keluar')->sum('quantity');
        return view('home', compact('medicine', 'transaction', 'inventory', 'inventory_keluar'));
    }

    public function home_employee()
    {
        $em = Employee::find(Auth::guard('employee')->id());
        if($em->status == -1) return;
        $check = $em->status == 0;
        if ($check) {
            $em->update(['status' => 1]);
        }


        $transaction_today = Transaction::whereDate('tanggal_transaksi', now()->toDateString())->count();
        $transaction_1week = Transaction::whereDate('tanggal_transaksi', '>=', now()->subWeek()->toDateString())->count();
        $transaction_1month = Transaction::whereDate('tanggal_transaksi', '>=', now()->subMonth()->toDateString())->count();


        return view('home-employee', compact(['transaction_today', 'transaction_1week', 'transaction_1month']));
    }

    public function loginEmployee(EmployeeLoginRequest $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $employee = Employee::where('email', $credentials['email'])->first();

        if ($employee && $employee->status == -1) {
            throw ValidationException::withMessages([
                'email' => 'Your account has been suspended. Please contact administrator.',
            ]);
        }

        $request->authenticate();
        $request->session()->regenerate();


        return redirect()->intended(route('basket', absolute: false));

        // dd($request->all());

        // dd( $request->role);

        // $credentials = $request->only('email', 'password');

        // if (Auth::guard('employee')->attempt($credentials)) {
        //     $request->session()->regenerate();
        //     return redirect()->intended(route('basket'));
        // }

        // return back()->withErrors([
        //     'email' => 'The provided credentials do not match our records.',
        // ]);

        // $credentials = $request->only('email', 'password');
        // $credentials['password'] = Hash::make($credentials['password']);
        // $check = Employee::where('email', $credentials['email'])->first();

        // // dd($check && Hash::check($request->password, $check->password));
        // if ($check && Hash::check($request->password, $check->password)) {
        //     // Authentication successful
        //     // You can set session or return response here
        //     return redirect()->route('basket')->with('success', 'Login successful!');
        // } else {
        //     // Authentication failed
        //     return back()->withErrors(['email' => 'Invalid credentials.']);
        // }
    }
}
