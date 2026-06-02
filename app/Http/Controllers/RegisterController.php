<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Tampilkan halaman register
     */
    public function index()
    {
        return view('daftar');
    }

    /**
     * Simpan user baru
     */
    public function store(Request $request)
    {
        // VALIDASI
        $validated = $request->validate([
            'role'     => 'required|in:mahasiswa,umkm',
            'name'     => 'required|string|max:255',
            'nickname' => 'required|string|max:50',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        // SIMPAN USER
        User::create([
            'role'     => $validated['role'],
            'name'     => $validated['name'],
            'nickname' => $validated['nickname'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // REDIRECT
        return redirect()
            ->route('login')
            ->with('success', 'Akun berhasil dibuat! Silakan masuk.');
    }
}