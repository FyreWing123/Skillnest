<?php

namespace App\Http\Controllers;

use App\Models\Favorit;
use App\Models\Layanan;
use App\Models\Pesanan;
use App\Models\Portfolio;

class DashboardController extends Controller
{
    public function mahasiswa()
    {
        $userId = auth()->id();

        $totalLayanan   = Layanan::where('user_id', $userId)->count();
        $totalPortfolio = Portfolio::where('user_id', $userId)->count();

        $layanansAktif = Layanan::where('user_id', $userId)
            ->where('status', 'aktif')
            ->latest()
            ->get();

        $layananIds = Layanan::where('user_id', $userId)->pluck('id');

        $pesananMenunggu = Pesanan::whereIn('layanan_id', $layananIds)
            ->where('status', 'menunggu_verifikasi')
            ->with(['layanan', 'user'])
            ->latest()
            ->get();

        $pesananOnGoing = Pesanan::whereIn('layanan_id', $layananIds)
            ->where('status', 'on_going')
            ->with(['layanan', 'user'])
            ->latest()
            ->get();

        $portfolioTerbaru = Portfolio::where('user_id', $userId)
            ->latest()
            ->take(3)
            ->get();

        return view('dashboard-mahasiswa', compact(
            'totalLayanan',
            'totalPortfolio',
            'layanansAktif',
            'pesananMenunggu',
            'pesananOnGoing',
            'portfolioTerbaru',
        ));
    }

    public function umkm()
    {
        $userId = auth()->id();

        $activeStatuses = ['menunggu_verifikasi', 'diterima', 'on_going'];

        $totalPesanan    = Pesanan::where('user_id', $userId)->count();
        $pesananAktif    = Pesanan::where('user_id', $userId)->whereIn('status', $activeStatuses)->count();
        $pesananSelesai  = Pesanan::where('user_id', $userId)->where('status', 'selesai')->count();
        $totalFavorit    = Favorit::where('user_id', $userId)->count();

        $pesananAktifList = Pesanan::where('user_id', $userId)
            ->whereIn('status', $activeStatuses)
            ->with(['layanan', 'layanan.user'])
            ->latest()
            ->take(5)
            ->get();

        $favoritList = Favorit::where('user_id', $userId)
            ->with(['mahasiswa', 'mahasiswa.layanans'])
            ->latest()
            ->take(3)
            ->get();

        return view('dashboard-umkm', compact(
            'totalPesanan',
            'pesananAktif',
            'pesananSelesai',
            'totalFavorit',
            'pesananAktifList',
            'favoritList',
        ));
    }
}
