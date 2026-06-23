<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request, Pesanan $pesanan)
    {
        if (auth()->user()->role !== 'umkm') {
            abort(403);
        }

        if ($pesanan->user_id !== auth()->id()) {
            abort(403);
        }

        if ($pesanan->status !== 'selesai') {
            return back()->with('error', 'Rating hanya bisa diberikan untuk pesanan yang sudah selesai.');
        }

        if ($pesanan->rating()->exists()) {
            return back()->with('error', 'Kamu sudah memberikan rating untuk pesanan ini.');
        }

        $request->validate([
            'stars'  => 'required|integer|min:1|max:5',
            'ulasan' => 'nullable|string|max:500',
        ]);

        Rating::create([
            'pesanan_id'   => $pesanan->id,
            'umkm_id'      => auth()->id(),
            'mahasiswa_id' => $pesanan->layanan->user_id,
            'stars'        => $request->stars,
            'ulasan'       => $request->ulasan,
        ]);

        return back()->with('success', 'Terima kasih! Rating berhasil dikirim.');
    }
}
