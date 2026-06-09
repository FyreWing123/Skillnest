<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('daftar');
    }

    public function store(Request $request)
    {
        $isMahasiswa = $request->input('role') === 'mahasiswa';

        $rules = [
            'role'     => 'required|in:mahasiswa,umkm',
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ];

        if ($isMahasiswa) {
            $rules['nickname'] = 'required|string|max:50';
        } else {
            $rules['nama_usaha']     = 'required|string|max:255';
            $rules['kategori_usaha'] = 'required|string';
            $rules['no_whatsapp']    = 'required|string|max:20';
        }

        $validated = $request->validate($rules, [
            'name.required'          => 'Nama lengkap wajib diisi.',
            'nickname.required'      => 'Nama panggilan wajib diisi.',
            'email.required'         => 'Email wajib diisi.',
            'email.unique'           => 'Email sudah terdaftar.',
            'password.required'      => 'Password wajib diisi.',
            'password.min'           => 'Password minimal 8 karakter.',
            'password.confirmed'     => 'Konfirmasi password tidak cocok.',
            'nama_usaha.required'    => 'Nama usaha wajib diisi.',
            'kategori_usaha.required'=> 'Kategori usaha wajib dipilih.',
            'no_whatsapp.required'   => 'No. WhatsApp wajib diisi.',
        ]);

        $data = [
            'role'     => $validated['role'],
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
        ];

        if ($isMahasiswa) {
            $data['nickname'] = $validated['nickname'];
        } else {
            $data['nama_usaha']     = $validated['nama_usaha'];
            $data['kategori_usaha'] = $validated['kategori_usaha'];
            $data['no_whatsapp']    = $validated['no_whatsapp'];
        }

        User::create($data);

        return redirect()->route('login')
            ->with('success', 'Akun berhasil dibuat! Silakan masuk.');
    }
}
