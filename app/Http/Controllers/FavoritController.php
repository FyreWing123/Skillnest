<?php

namespace App\Http\Controllers;

use App\Models\Favorit;
use App\Models\User;

class FavoritController extends Controller
{
    /** AJAX toggle: tambah/hapus favorit */
    public function toggle(User $mahasiswa)
    {
        if ($mahasiswa->role !== 'mahasiswa') abort(404);

        $existing = Favorit::where('user_id', auth()->id())
            ->where('mahasiswa_id', $mahasiswa->id)
            ->first();

        if ($existing) {
            $existing->delete();
            $favorited = false;
        } else {
            Favorit::create([
                'user_id'      => auth()->id(),
                'mahasiswa_id' => $mahasiswa->id,
            ]);
            $favorited = true;
        }

        return response()->json(['favorited' => $favorited]);
    }

    /** Halaman daftar favorit UMKM */
    public function index()
    {
        $favorits = Favorit::where('user_id', auth()->id())
            ->with(['mahasiswa' => function ($q) {
                $q->with(['layanans' => fn($lq) => $lq->where('status', 'aktif')->orderBy('harga')]);
            }])
            ->latest()
            ->get();

        return view('favorit-umkm', compact('favorits'));
    }
}
