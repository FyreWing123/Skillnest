<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::where('user_id', auth()->id())
            ->latest()
            ->get();

        $total = $portfolios->count();

        return view('portfolio-mahasiswa', compact('portfolios', 'total'));
    }

    public function create()
    {
        return view('tambah-portfolio');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'judul.required'     => 'Judul portfolio wajib diisi.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'foto.image'         => 'File harus berupa gambar.',
            'foto.max'           => 'Ukuran foto maksimal 2MB.',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('portfolios', 'public');
        }

        Portfolio::create([
            'user_id'   => auth()->id(),
            'judul'     => $request->judul,
            'deskripsi' => $request->deskripsi,
            'foto'      => $fotoPath,
        ]);

        return redirect()->route('portfolio.mahasiswa')
            ->with('success', 'Portfolio berhasil ditambahkan!');
    }

    public function edit(Portfolio $portfolio)
    {
        if ($portfolio->user_id !== auth()->id()) {
            abort(403);
        }

        return view('edit-portfolio', compact('portfolio'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        if ($portfolio->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'judul.required'     => 'Judul portfolio wajib diisi.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'foto.image'         => 'File harus berupa gambar.',
            'foto.max'           => 'Ukuran foto maksimal 2MB.',
        ]);

        if ($request->hasFile('foto')) {
            if ($portfolio->foto) {
                Storage::disk('public')->delete($portfolio->foto);
            }
            $portfolio->foto = $request->file('foto')->store('portfolios', 'public');
        }

        $portfolio->judul     = $request->judul;
        $portfolio->deskripsi = $request->deskripsi;
        $portfolio->save();

        return redirect()->route('portfolio.mahasiswa')
            ->with('success', 'Portfolio berhasil diperbarui!');
    }

    public function destroy(Portfolio $portfolio)
    {
        if ($portfolio->user_id !== auth()->id()) {
            abort(403);
        }

        if ($portfolio->foto) {
            Storage::disk('public')->delete($portfolio->foto);
        }

        $portfolio->delete();

        return redirect()->route('portfolio.mahasiswa')
            ->with('success', 'Portfolio berhasil dihapus.');
    }
}
