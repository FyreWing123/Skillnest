<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        ]);

        $skills = [];
        if (!empty($validated['skills'])) {
            $skills = array_values(array_filter(array_map('trim', explode(',', $validated['skills']))));
        }

        auth()->user()->update([
            'name'        => $validated['name'],
            'nickname'    => $validated['nickname'] ?? null,
            'universitas' => $validated['universitas'] ?? null,
            'jurusan'     => $validated['jurusan'] ?? null,
            'semester'    => $validated['semester'] ?? null,
            'bio'         => $validated['bio'] ?? null,
            'skills'      => empty($skills) ? null : json_encode($skills),
        ]);

        return redirect()->route('profile.mahasiswa')->with('success', 'Profil berhasil disimpan!');
    }
}
