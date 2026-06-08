<?php

namespace App\Http\Controllers;

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
}
