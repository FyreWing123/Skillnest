<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile-mahasiswa');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'nickname'    => 'nullable|string|max:50',
            'universitas' => 'nullable|string|max:255',
            'jurusan'     => 'nullable|string|max:255',
            'semester'    => 'nullable|string|max:10',
            'bio'         => 'nullable|string|max:1000',
            'skills'      => 'nullable|string',
            'photo'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $skills = [];
        if (!empty($validated['skills'])) {
            $skills = array_values(array_filter(array_map('trim', explode(',', $validated['skills']))));
        }

        $data = [
            'name'        => $validated['name'],
            'nickname'    => $validated['nickname'] ?? null,
            'universitas' => $validated['universitas'] ?? null,
            'jurusan'     => $validated['jurusan'] ?? null,
            'semester'    => $validated['semester'] ?? null,
            'bio'         => $validated['bio'] ?? null,
            'skills'      => empty($skills) ? null : json_encode($skills),
        ];

        if ($request->hasFile('photo')) {
            if (auth()->user()->photo) {
                Storage::disk('public')->delete(auth()->user()->photo);
            }
            $data['photo'] = $request->file('photo')->store('avatars', 'public');
        }

        auth()->user()->update($data);

        return redirect()->route('profile.mahasiswa')->with('success', 'Profil berhasil disimpan!');
    }
}
