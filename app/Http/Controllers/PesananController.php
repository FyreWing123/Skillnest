<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function updateStatus(Request $request, Pesanan $pesanan)
    {
        // Hanya pemilik layanan yang boleh update status
        if ($pesanan->layanan->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:menunggu_verifikasi,diterima,on_going,selesai',
        ]);

        $pesanan->status = $request->status;
        $pesanan->save();

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }
}
