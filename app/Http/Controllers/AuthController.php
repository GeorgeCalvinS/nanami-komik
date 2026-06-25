<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email_user' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('web')->attempt([
            'email_user' => $request->email_user,
            'password' => $request->password,
        ])) {
            $request->session()->regenerate();

            $role = Auth::user()->role_user;

            if ($role == 1) {
                return redirect()->intended('/admin/dashboard');
            }

            return redirect()->intended('/browse');
        }

        return back()->withErrors([
            'email_user' => 'Email atau password salah.',
        ])->onlyInput('email_user');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}