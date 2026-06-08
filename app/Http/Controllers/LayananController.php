<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LayananController extends Controller
{
    public function index()
    {
        $layanans = Layanan::where('user_id', auth()->id())->latest()->get();
        return view('layanan-saya', compact('layanans'));
    }

    public function create()
    {
        return view('tambah-layanan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'             => 'required|string|max:255',
            'kategori'         => 'required|string',
            'harga'            => 'required|numeric|min:0',
            'estimasi'         => 'required|string|max:50',
            'thumbnail'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'deskripsi_singkat'=> 'required|string|max:150',
            'deskripsi_detail' => 'required|string',
        ], [
            'nama.required'              => 'Nama layanan wajib diisi.',
            'kategori.required'          => 'Kategori wajib dipilih.',
            'harga.required'             => 'Harga wajib diisi.',
            'harga.numeric'              => 'Harga harus berupa angka.',
            'estimasi.required'          => 'Estimasi pengerjaan wajib diisi.',
            'deskripsi_singkat.required' => 'Deskripsi singkat wajib diisi.',
            'deskripsi_singkat.max'      => 'Deskripsi singkat maksimal 150 karakter.',
            'deskripsi_detail.required'  => 'Deskripsi detail wajib diisi.',
            'thumbnail.image'            => 'File harus berupa gambar.',
            'thumbnail.max'              => 'Ukuran thumbnail maksimal 2MB.',
        ]);

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('layanans', 'public');
        }

        Layanan::create([
            'user_id'          => auth()->id(),
            'nama'             => $request->nama,
            'kategori'         => $request->kategori,
            'harga'            => $request->harga,
            'estimasi'         => $request->estimasi,
            'thumbnail'        => $thumbnailPath,
            'deskripsi_singkat'=> $request->deskripsi_singkat,
            'deskripsi_detail' => $request->deskripsi_detail,
        ]);

        return redirect()->route('layanan.saya')
            ->with('success', 'Layanan berhasil ditambahkan!');
    }

    public function edit(Layanan $layanan)
    {
        if ($layanan->user_id !== auth()->id()) {
            abort(403);
        }
        return view('edit-layanan', compact('layanan'));
    }

    public function update(Request $request, Layanan $layanan)
    {
        if ($layanan->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'nama'             => 'required|string|max:255',
            'kategori'         => 'required|string',
            'harga'            => 'required|numeric|min:0',
            'estimasi'         => 'required|string|max:50',
            'thumbnail'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'deskripsi_singkat'=> 'required|string|max:150',
            'deskripsi_detail' => 'required|string',
        ]);

        if ($request->hasFile('thumbnail')) {
            if ($layanan->thumbnail) {
                Storage::disk('public')->delete($layanan->thumbnail);
            }
            $layanan->thumbnail = $request->file('thumbnail')->store('layanans', 'public');
        }

        $layanan->nama              = $request->nama;
        $layanan->kategori          = $request->kategori;
        $layanan->harga             = $request->harga;
        $layanan->estimasi          = $request->estimasi;
        $layanan->deskripsi_singkat = $request->deskripsi_singkat;
        $layanan->deskripsi_detail  = $request->deskripsi_detail;
        $layanan->save();

        return redirect()->route('layanan.saya')
            ->with('success', 'Layanan berhasil diperbarui!');
    }

    public function showPesanan(Layanan $layanan)
    {
        if ($layanan->user_id !== auth()->id()) {
            abort(403);
        }

        $pesanans = $layanan->pesanans()->with('user')->latest()->get();

        return view('pesanan-layanan', compact('layanan', 'pesanans'));
    }

    public function toggleKetersediaan(Layanan $layanan)
    {
        if ($layanan->user_id !== auth()->id()) {
            abort(403);
        }

        $layanan->ketersediaan = $layanan->ketersediaan === 'open' ? 'closed' : 'open';
        $layanan->save();

        return back()->with('success',
            'Status layanan diubah ke ' . strtoupper($layanan->ketersediaan) . '.');
    }

    public function destroy(Layanan $layanan)
    {
        if ($layanan->user_id !== auth()->id()) {
            abort(403);
        }

        if ($layanan->thumbnail) {
            Storage::disk('public')->delete($layanan->thumbnail);
        }

        $layanan->delete();

        return redirect()->route('layanan.saya')
            ->with('success', 'Layanan berhasil dihapus.');
    }
}
