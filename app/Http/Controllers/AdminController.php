<?php

namespace App\Http\Controllers;

use App\Exports\LayanansExport;
use App\Exports\UsersExport;
use App\Models\Layanan;
use App\Models\Pesanan;
use App\Models\Rating;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_users'     => User::where('role', '!=', 'admin')->count(),
            'total_mahasiswa' => User::where('role', 'mahasiswa')->count(),
            'total_umkm'      => User::where('role', 'umkm')->count(),
            'total_layanan'   => Layanan::count(),
            'total_pesanan'   => Pesanan::count(),
            'total_selesai'   => Pesanan::where('status', 'selesai')->count(),
            'total_ratings'   => Rating::count(),
            'suspended'       => User::where('role', '!=', 'admin')->where('is_active', false)->count(),
        ];

        $recentUsers    = User::where('role', '!=', 'admin')->latest()->take(5)->get();
        $recentPesanans = Pesanan::with(['user', 'layanan.user'])->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentUsers', 'recentPesanans'));
    }

    public function users(Request $request)
    {
        $q    = $request->input('q', '');
        $role = $request->input('role', '');

        $query = User::where('role', '!=', 'admin')
            ->withCount(['layanans', 'pesanans'])
            ->latest();

        if ($q) {
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%")
                    ->orWhere('nama_usaha', 'like', "%{$q}%");
            });
        }

        if ($role) {
            $query->where('role', $role);
        }

        $users = $query->paginate(15)->withQueryString();

        return view('admin.users', compact('users', 'q', 'role'));
    }

    public function toggleUserStatus(User $user)
    {
        if ($user->role === 'admin') {
            return back()->with('error', 'Tidak dapat mengubah status akun admin.');
        }

        $user->is_active = !$user->is_active;
        $user->save();

        $status = $user->is_active ? 'diaktifkan' : 'disuspend';
        return back()->with('success', "Akun {$user->name} berhasil {$status}.");
    }

    public function layanans(Request $request)
    {
        $q         = $request->input('q', '');
        $kategori  = $request->input('kategori', '');
        $status    = $request->input('status', '');

        $query = Layanan::with('user')->withCount('pesanans')->latest();

        if ($q) {
            $query->where('nama', 'like', "%{$q}%");
        }
        if ($kategori) {
            $query->where('kategori', $kategori);
        }
        if ($status) {
            $query->where('ketersediaan', $status);
        }

        $layanans = $query->paginate(15)->withQueryString();

        return view('admin.layanans', compact('layanans', 'q', 'kategori', 'status'));
    }

    public function deleteLayanan(Layanan $layanan)
    {
        if ($layanan->thumbnail) {
            Storage::disk('public')->delete($layanan->thumbnail);
        }
        $layanan->delete();

        return back()->with('success', 'Layanan berhasil dihapus.');
    }

    public function pesanans(Request $request)
    {
        $q      = $request->input('q', '');
        $status = $request->input('status', '');

        $query = Pesanan::with(['user', 'layanan.user'])->latest();

        if ($status) {
            $query->where('status', $status);
        }
        if ($q) {
            $query->whereHas('user', fn($s) => $s->where('name', 'like', "%{$q}%")
                ->orWhere('nama_usaha', 'like', "%{$q}%"))
                ->orWhereHas('layanan', fn($s) => $s->where('nama', 'like', "%{$q}%"));
        }

        $counts = [
            'all'                 => Pesanan::count(),
            'menunggu_verifikasi' => Pesanan::where('status', 'menunggu_verifikasi')->count(),
            'on_going'            => Pesanan::where('status', 'on_going')->count(),
            'selesai'             => Pesanan::where('status', 'selesai')->count(),
            'ditolak'             => Pesanan::where('status', 'ditolak')->count(),
        ];

        $pesanans = $query->paginate(15)->withQueryString();

        return view('admin.pesanans', compact('pesanans', 'q', 'status', 'counts'));
    }

    public function showUser(User $user)
    {
        $layanans = collect();
        $pesanans = collect();

        if ($user->role === 'mahasiswa') {
            $layanans = $user->layanans()->withCount('pesanans')->latest()->get()->map(function ($l) {
                $pesananIds      = $l->pesanans()->pluck('id');
                $ratings         = Rating::whereIn('pesanan_id', $pesananIds)->get();
                $l->avg_rating   = $ratings->count() ? round($ratings->avg('stars'), 1) : null;
                $l->rating_count = $ratings->count();
                return $l;
            });
        } elseif ($user->role === 'umkm') {
            $pesanans = $user->pesanans()->with('layanan.user')->latest()->get();
        }

        return view('admin.user-detail', compact('user', 'layanans', 'pesanans'));
    }

    public function showLayanan(Layanan $layanan)
    {
        $layanan->load('user');
        $pesananIds     = $layanan->pesanans()->pluck('id');
        $ratings        = Rating::whereIn('pesanan_id', $pesananIds)->with('umkm')->latest()->get();
        $avgRating      = $ratings->count() ? round($ratings->avg('stars'), 1) : null;
        $ratingCount    = $ratings->count();
        $totalPesanan   = $layanan->pesanans()->count();
        $pesananSelesai = $layanan->pesanans()->where('status', 'selesai')->count();

        return view('admin.layanan-detail', compact(
            'layanan', 'ratings', 'avgRating', 'ratingCount', 'totalPesanan', 'pesananSelesai'
        ));
    }

    public function deleteRating(Rating $rating)
    {
        $rating->delete();
        return back()->with('success', 'Ulasan berhasil dihapus.');
    }

    public function exportUsers()
    {
        return (new UsersExport)->download();
    }

    public function exportLayanans()
    {
        return (new LayanansExport)->download();
    }

    public function exportLaporan()
    {
        $topLayanan = Layanan::with('user')->withCount('pesanans')
            ->having('pesanans_count', '>', 0)
            ->orderByDesc('pesanans_count')
            ->take(5)->get();

        $topMahasiswa = User::where('role', 'mahasiswa')
            ->with('ratingsReceived')->get()
            ->filter(fn($u) => $u->ratingCount() > 0)
            ->sortByDesc(fn($u) => $u->avgRating())
            ->take(5)->values();

        $topUmkm = User::where('role', 'umkm')
            ->withCount('pesanans')
            ->having('pesanans_count', '>', 0)
            ->orderByDesc('pesanans_count')
            ->take(5)->get();

        $monthlyStats = collect(range(1, 12))->map(function ($month) {
            return [
                'month' => $month,
                'label' => \Carbon\Carbon::create(null, $month)->translatedFormat('M'),
                'count' => Pesanan::whereYear('created_at', now()->year)
                    ->whereMonth('created_at', $month)->count(),
            ];
        });

        $pdf = Pdf::loadView('admin.laporan-pdf', compact(
            'topLayanan', 'topMahasiswa', 'topUmkm', 'monthlyStats'
        ))->setPaper('a4', 'portrait');

        return $pdf->download('skillnest-laporan-' . now()->format('Y-m-d') . '.pdf');
    }

    public function laporan()
    {
        // Top layanan by pesanan count
        $topLayanan = Layanan::withCount('pesanans')
            ->having('pesanans_count', '>', 0)
            ->orderByDesc('pesanans_count')
            ->take(5)
            ->get();

        // Top mahasiswa by avg rating (min 1 rating)
        $topMahasiswa = User::where('role', 'mahasiswa')
            ->with('ratingsReceived')
            ->get()
            ->filter(fn($u) => $u->ratingCount() > 0)
            ->sortByDesc(fn($u) => $u->avgRating())
            ->take(5)
            ->values();

        // Top UMKM by pesanan count
        $topUmkm = User::where('role', 'umkm')
            ->withCount('pesanans')
            ->having('pesanans_count', '>', 0)
            ->orderByDesc('pesanans_count')
            ->take(5)
            ->get();

        // Monthly pesanan stats (current year)
        $monthlyStats = collect(range(1, 12))->map(function ($month) {
            return [
                'month' => $month,
                'label' => \Carbon\Carbon::create(null, $month)->translatedFormat('M'),
                'count' => Pesanan::whereYear('created_at', now()->year)
                    ->whereMonth('created_at', $month)
                    ->count(),
            ];
        });

        $maxMonthly = $monthlyStats->max('count') ?: 1;

        return view('admin.laporan', compact('topLayanan', 'topMahasiswa', 'topUmkm', 'monthlyStats', 'maxMonthly'));
    }
}
