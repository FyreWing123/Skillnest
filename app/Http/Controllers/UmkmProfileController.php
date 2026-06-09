<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UmkmProfileController extends Controller
{
    public function index()
    {
        return view('profile-umkm', ['user' => auth()->user()]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'nama_usaha'      => 'required|string|max:255',
            'kategori_usaha'  => 'required|string',
            'no_whatsapp'     => 'nullable|string|max:20',
            'alamat_usaha'    => 'nullable|string|max:500',
            'deskripsi_usaha' => 'nullable|string|max:1000',
        ], [
            'name.required'           => 'Nama pemilik wajib diisi.',
            'nama_usaha.required'     => 'Nama usaha wajib diisi.',
            'kategori_usaha.required' => 'Kategori usaha wajib dipilih.',
        ]);

        auth()->user()->update($validated);

        return redirect()->route('profile.umkm')
            ->with('success', 'Profil usaha berhasil disimpan!');
    }
}
