<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'photo'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'name.required'           => 'Nama pemilik wajib diisi.',
            'nama_usaha.required'     => 'Nama usaha wajib diisi.',
            'kategori_usaha.required' => 'Kategori usaha wajib dipilih.',
        ]);

        $data = collect($validated)->except('photo')->toArray();

        if ($request->hasFile('photo')) {
            if (auth()->user()->photo) {
                Storage::disk('public')->delete(auth()->user()->photo);
            }
            $data['photo'] = $request->file('photo')->store('avatars', 'public');
        }

        auth()->user()->update($data);

        return redirect()->route('profile.umkm')
            ->with('success', 'Profil usaha berhasil disimpan!');
    }
}
