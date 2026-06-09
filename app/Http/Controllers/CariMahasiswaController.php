<?php

namespace App\Http\Controllers;

use App\Models\Favorit;
use App\Models\User;
use Illuminate\Http\Request;

class CariMahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $q       = $request->input('q');
        $kategori = $request->input('kategori');

        $query = User::where('role', 'mahasiswa')
            ->with(['layanans' => fn($lq) => $lq->where('status', 'aktif')->orderBy('harga')]);

        if ($q) {
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('nickname', 'like', "%{$q}%")
                    ->orWhere('skills', 'like', "%{$q}%")
                    ->orWhere('jurusan', 'like', "%{$q}%");
            });
        }

        if ($kategori) {
            $query->where('skills', 'like', "%{$kategori}%");
        }

        $mahasiswas  = $query->latest()->get();
        $favoritIds  = Favorit::where('user_id', auth()->id())->pluck('mahasiswa_id')->toArray();

        return view('cari-mahasiswa', compact('mahasiswas', 'q', 'kategori', 'favoritIds'));
    }
}
