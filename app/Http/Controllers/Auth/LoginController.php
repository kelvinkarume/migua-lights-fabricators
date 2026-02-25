<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // SHOW LOGIN FORM
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // LOGIN LOGIC
    public function login(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt([
            'phone' => $request->phone,
            'password' => $request->password
        ])) {

            $request->session()->regenerate();

            // Redirect based on role
            if (Auth::user()->role === 'production_manager') {
                return redirect()->route('production.dashboard');
            }

            if (Auth::user()->role === 'sales_manager') {
                return redirect()->route('sales.index');
            }

            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            // Normal user
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'phone' => 'Invalid login credentials.',
        ]);
    }
}
