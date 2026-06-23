<?php

namespace App\Http\Controllers;

use App\Models\Favorit;
use App\Models\Layanan;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    /** UMKM memesan sebuah layanan */
    public function store(Request $request, Layanan $layanan)
    {
        if (auth()->user()->role !== 'umkm') {
            abort(403);
        }

        if ($layanan->user_id === auth()->id()) {
            abort(403);
        }

        if ($layanan->ketersediaan !== 'open') {
            return back()->with('error', 'Layanan ini sedang tidak menerima pesanan baru.');
        }

        $request->validate(['pesan' => 'nullable|string|max:500']);

        // Cegah duplikat pesanan aktif
        $existing = Pesanan::where('layanan_id', $layanan->id)
            ->where('user_id', auth()->id())
            ->whereNotIn('status', ['selesai', 'ditolak'])
            ->first();

        if ($existing) {
            return back()->with('error', 'Kamu sudah memiliki pesanan aktif untuk layanan ini.');
        }

        Pesanan::create([
            'layanan_id' => $layanan->id,
            'user_id'    => auth()->id(),
            'pesan'      => $request->pesan,
            'status'     => 'menunggu_verifikasi',
        ]);

        return redirect()->route('pesanan.umkm')
            ->with('success', 'Terima kasih telah memesan jasa! Mohon ditunggu untuk verifikasinya.');
    }

    /** Mahasiswa: lihat semua pesanan masuk dari semua layanans */
    public function mahasiswaPesanan(Request $request)
    {
        $myId        = auth()->id();
        $filterStatus = $request->input('status');

        $layananIds = Layanan::where('user_id', $myId)->pluck('id');

        $query = Pesanan::whereIn('layanan_id', $layananIds)
            ->with(['layanan', 'user'])
            ->latest();

        if ($filterStatus) {
            $query->where('status', $filterStatus);
        }

        $pesanans = $query->get();

        $counts = [
            'all'                 => Pesanan::whereIn('layanan_id', $layananIds)->count(),
            'menunggu_verifikasi' => Pesanan::whereIn('layanan_id', $layananIds)->where('status', 'menunggu_verifikasi')->count(),
            'on_going'            => Pesanan::whereIn('layanan_id', $layananIds)->where('status', 'on_going')->count(),
            'selesai'             => Pesanan::whereIn('layanan_id', $layananIds)->where('status', 'selesai')->count(),
            'ditolak'             => Pesanan::whereIn('layanan_id', $layananIds)->where('status', 'ditolak')->count(),
        ];

        return view('pesanan-saya', compact('pesanans', 'filterStatus', 'counts'));
    }

    /** UMKM: lihat semua pesanan yang sudah dibuat */
    public function umkmPesanan(Request $request)
    {
        $filterStatus = $request->input('status');

        $query = Pesanan::where('user_id', auth()->id())
            ->with(['layanan.user', 'rating'])
            ->latest();

        if ($filterStatus) {
            $query->where('status', $filterStatus);
        }

        $pesanans = $query->get();

        $myId = auth()->id();
        $counts = [
            'all'                 => Pesanan::where('user_id', $myId)->count(),
            'menunggu_verifikasi' => Pesanan::where('user_id', $myId)->where('status', 'menunggu_verifikasi')->count(),
            'on_going'            => Pesanan::where('user_id', $myId)->where('status', 'on_going')->count(),
            'selesai'             => Pesanan::where('user_id', $myId)->where('status', 'selesai')->count(),
        ];

        $favoritIds = Favorit::where('user_id', auth()->id())->pluck('mahasiswa_id')->toArray();

        return view('pesanan-umkm', compact('pesanans', 'filterStatus', 'counts', 'favoritIds'));
    }

    /** Mahasiswa: update status pesanan (terima, on_going, selesai, tolak) */
    public function updateStatus(Request $request, Pesanan $pesanan)
    {
        if ($pesanan->layanan->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:menunggu_verifikasi,diterima,on_going,selesai,ditolak',
        ]);

        $newStatus = $request->status;

        // Tidak bisa tolak jika sudah on_going atau selesai
        if ($newStatus === 'ditolak' && in_array($pesanan->status, ['on_going', 'selesai'])) {
            return back()->with('error', 'Pesanan yang sedang on-going atau telah selesai tidak dapat ditolak.');
        }

        $pesanan->status = $newStatus;
        $pesanan->save();

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }
}
