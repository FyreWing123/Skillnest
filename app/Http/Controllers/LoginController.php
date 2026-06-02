<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // TAMPILKAN HALAMAN LOGIN
    public function index()
    {
        return view('masuk');
    }

    // PROSES LOGIN
    public function authenticate(Request $request)
    {
        // VALIDASI
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        // CEK LOGIN
        if (Auth::attempt($credentials, $request->remember)) {

            // regenerate session
            $request->session()->regenerate();

            return redirect()->route('home');
        }

        // kalau gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // LOGOUT
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/masuk');
    }
}