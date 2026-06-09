<?php

namespace App\Http\Controllers;

use App\Models\User;

class MahasiswaController extends Controller
{
    public function show(User $user)
    {
        if ($user->role !== 'mahasiswa') {
            abort(404);
        }

        $layanans   = $user->layanans()->where('status', 'aktif')->orderBy('harga')->get();
        $portfolios = $user->portfolios()->latest()->take(6)->get();

        return view('profil-mahasiswa', compact('user', 'layanans', 'portfolios'));
    }
}
