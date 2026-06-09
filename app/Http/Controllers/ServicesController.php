<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index(Request $request)
    {
        $q        = $request->input('q');
        $kategori = $request->input('kategori');

        $query = User::where('role', 'mahasiswa')
            ->whereHas('layanans', fn($lq) => $lq->where('status', 'aktif'))
            ->with(['layanans' => fn($lq) => $lq->where('status', 'aktif')->orderBy('harga')]);

        if ($q) {
            $query->where(function ($sub) use ($q) {
                $sub->where('name',     'like', "%{$q}%")
                    ->orWhere('nickname', 'like', "%{$q}%")
                    ->orWhere('skills',   'like', "%{$q}%")
                    ->orWhere('jurusan',  'like', "%{$q}%");
            });
        }

        if ($kategori) {
            $query->where('skills', 'like', "%{$kategori}%");
        }

        $mahasiswas = $query->latest()->paginate(12)->withQueryString();

        return view('services', compact('mahasiswas', 'q', 'kategori'));
    }
}
