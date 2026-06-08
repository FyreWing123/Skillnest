<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SkillNest</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#F6FAFF]">

<div class="min-h-screen flex">

    {{-- SIDEBAR --}}
    <aside class="w-72 bg-white border-r border-[#E2E8F0] p-6 shrink-0">
        <a href="{{ route('home') }}" class="flex items-center gap-3 mb-10">
            <img src="{{ asset('images/skillnestlogo.png') }}" alt="SkillNest" class="h-10">
            <span class="text-xl font-bold text-[#0F172A]">SkillNest</span>
        </a>
        <nav class="space-y-2">
            <a href="{{ route('dashboard.mahasiswa') }}"
               class="block rounded-xl bg-[#EAF2FF] px-4 py-3 font-semibold text-[#1846A3]">Dashboard</a>
            <a href="{{ route('profile.mahasiswa') }}"
               class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Profil Saya</a>
            <a href="{{ route('portfolio.mahasiswa') }}"
               class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Portfolio</a>
            <a href="{{ route('layanan.saya') }}"
               class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Layanan Saya</a>
            <a href="{{ route('chat') }}"
               class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Pesan</a>
        </nav>
    </aside>

    {{-- CONTENT --}}
    <main class="flex-1 p-10 overflow-y-auto">

        {{-- HEADER --}}
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-bold text-[#0F172A]">
                    Halo, {{ auth()->user()->nickname ?? auth()->user()->name }} 👋
                </h1>
                <p class="mt-2 text-slate-500">
                    Selamat datang kembali di dashboard SkillNest.
                </p>
            </div>
            <a href="{{ route('layanan.create') }}"
               class="rounded-2xl bg-linear-to-r from-[#2563EB] to-[#1149C7] px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-500/20 hover:opacity-90 transition">
                + Tambah Layanan
            </a>
        </div>

        {{-- STATS --}}
        <div class="mt-10 grid gap-6 md:grid-cols-2 xl:grid-cols-4">
            <div class="rounded-4xl bg-white p-6 shadow-sm border border-[#DCE7FB]">
                <p class="text-slate-500 text-sm">Total Layanan</p>
                <h2 class="mt-3 text-4xl font-bold text-[#1846A3]">{{ $totalLayanan }}</h2>
            </div>
            <div class="rounded-4xl bg-white p-6 shadow-sm border border-[#DCE7FB]">
                <p class="text-slate-500 text-sm">Portfolio</p>
                <h2 class="mt-3 text-4xl font-bold text-[#1846A3]">{{ $totalPortfolio }}</h2>
            </div>
            <div class="rounded-4xl bg-white p-6 shadow-sm border border-[#DCE7FB]">
                <p class="text-slate-500 text-sm">Menunggu Verifikasi</p>
                <h2 class="mt-3 text-4xl font-bold text-yellow-500">{{ $pesananMenunggu->count() }}</h2>
            </div>
            <div class="rounded-4xl bg-white p-6 shadow-sm border border-[#DCE7FB]">
                <p class="text-slate-500 text-sm">Sedang On-going</p>
                <h2 class="mt-3 text-4xl font-bold text-purple-600">{{ $pesananOnGoing->count() }}</h2>
            </div>
        </div>

        {{-- QUICK ACTION --}}
        <div class="mt-8 grid gap-6 lg:grid-cols-3">
            <a href="{{ route('layanan.create') }}"
               class="rounded-4xl bg-[#1846A3] p-8 text-white shadow-sm transition hover:scale-[1.02]">
                <h3 class="text-2xl font-bold">+ Tambah Layanan</h3>
                <p class="mt-3 text-white/80">Buat layanan baru dan tampilkan di marketplace.</p>
            </a>
            <a href="{{ route('portfolio.mahasiswa') }}"
               class="rounded-4xl bg-white p-8 shadow-sm border border-[#DCE7FB] transition hover:shadow-md">
                <h3 class="text-2xl font-bold text-[#0F172A]">Portfolio Saya</h3>
                <p class="mt-3 text-slate-500">Kelola hasil pekerjaan dan project yang pernah dibuat.</p>
            </a>
            <a href="{{ route('profile.mahasiswa') }}"
               class="rounded-4xl bg-white p-8 shadow-sm border border-[#DCE7FB] transition hover:shadow-md">
                <h3 class="text-2xl font-bold text-[#0F172A]">Edit Profil</h3>
                <p class="mt-3 text-slate-500">Perbarui informasi akun, skill, dan bio profesional.</p>
            </a>
        </div>

        {{-- LAYANAN AKTIF + PESANAN MENUNGGU (2 kolom) --}}
        <div class="mt-8 grid gap-6 lg:grid-cols-2">

            {{-- LAYANAN AKTIF --}}
            <div class="rounded-4xl bg-white p-8 shadow-sm border border-[#DCE7FB]">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-[#0F172A]">Layanan Aktif</h2>
                    <a href="{{ route('layanan.saya') }}" class="text-sm font-semibold text-[#2563EB]">Lihat Semua</a>
                </div>

                @if($layanansAktif->isEmpty())
                    <p class="text-sm text-slate-400 text-center py-8">Belum ada layanan aktif.</p>
                @else
                    <div class="space-y-1">
                        @foreach($layanansAktif as $l)
                        <div class="flex items-center justify-between {{ !$loop->last ? 'border-b border-[#F1F5F9]' : '' }} py-3.5">
                            <div class="min-w-0 pr-4">
                                <p class="font-semibold text-[#0F172A] truncate">{{ $l->nama }}</p>
                                <div class="flex items-center gap-2 mt-0.5">
                                    <p class="text-sm text-slate-500">{{ $l->kategori }}</p>
                                    <span class="h-1 w-1 rounded-full bg-slate-300"></span>
                                    <span class="text-xs font-semibold {{ $l->isOpen() ? 'text-emerald-600' : 'text-red-500' }}">
                                        {{ $l->isOpen() ? 'Open' : 'Closed' }}
                                    </span>
                                </div>
                            </div>
                            <span class="font-bold text-[#1846A3] shrink-0">{{ $l->formatHarga() }}</span>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- MENUNGGU VERIFIKASI --}}
            <div class="rounded-4xl bg-white p-8 shadow-sm border border-[#DCE7FB]">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-[#0F172A]">Menunggu Verifikasi</h2>
                    @if($pesananMenunggu->count() > 0)
                        <span class="rounded-lg bg-yellow-100 px-2.5 py-1 text-xs font-bold text-yellow-700">
                            {{ $pesananMenunggu->count() }} baru
                        </span>
                    @endif
                </div>

                @if($pesananMenunggu->isEmpty())
                    <div class="flex flex-col items-center justify-center py-8 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-slate-200 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        <p class="text-sm text-slate-400">Tidak ada pesanan yang menunggu.</p>
                    </div>
                @else
                    <div class="space-y-3">
                        @foreach($pesananMenunggu->take(4) as $p)
                        <div class="flex items-center gap-3 rounded-xl bg-yellow-50 border border-yellow-100 p-3.5">
                            <div class="h-9 w-9 rounded-full bg-linear-to-br from-yellow-400 to-orange-400 flex items-center justify-center text-white font-bold text-sm shrink-0">
                                {{ strtoupper(substr($p->user->name, 0, 1)) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-sm text-[#0F172A] truncate">{{ $p->user->name }}</p>
                                <p class="text-xs text-slate-500 truncate">{{ $p->layanan->nama }}</p>
                            </div>
                            <a href="{{ route('layanan.pesanan', $p->layanan_id) }}"
                               class="text-xs font-bold text-yellow-700 shrink-0 hover:underline">Tinjau</a>
                        </div>
                        @endforeach
                        @if($pesananMenunggu->count() > 4)
                            <p class="text-center text-xs text-slate-400 pt-1">+{{ $pesananMenunggu->count() - 4 }} lainnya</p>
                        @endif
                    </div>
                @endif
            </div>

        </div>

        {{-- ON-GOING PESANAN --}}
        <div class="mt-6 rounded-4xl bg-white p-8 shadow-sm border border-[#DCE7FB]">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-[#0F172A]">Sedang On-going</h2>
                @if($pesananOnGoing->count() > 0)
                    <span class="rounded-lg bg-purple-100 px-2.5 py-1 text-xs font-bold text-purple-700">
                        {{ $pesananOnGoing->count() }} aktif
                    </span>
                @endif
            </div>

            @if($pesananOnGoing->isEmpty())
                <div class="flex flex-col items-center justify-center py-8 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-slate-200 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-sm text-slate-400">Tidak ada pekerjaan yang sedang berjalan.</p>
                </div>
            @else
                <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                    @foreach($pesananOnGoing as $p)
                    <div class="rounded-2xl border border-purple-100 bg-purple-50 p-4 flex flex-col gap-3">
                        <div class="flex items-center gap-3">
                            <div class="h-10 w-10 rounded-full bg-linear-to-br from-[#2563EB] to-[#1149C7] flex items-center justify-center text-white font-bold shrink-0">
                                {{ strtoupper(substr($p->user->name, 0, 1)) }}
                            </div>
                            <div class="min-w-0">
                                <p class="font-bold text-sm text-[#0F172A] truncate">{{ $p->user->name }}</p>
                                <p class="text-xs text-slate-500">{{ $p->user->email }}</p>
                            </div>
                        </div>
                        <div class="rounded-xl bg-white border border-purple-100 px-3 py-2.5">
                            <p class="text-xs text-slate-500">Layanan</p>
                            <p class="text-sm font-semibold text-[#0F172A] truncate">{{ $p->layanan->nama }}</p>
                            <p class="text-xs text-slate-400 mt-0.5">{{ $p->layanan->kategori }} &bull; {{ $p->layanan->formatHarga() }}</p>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-slate-400">{{ $p->created_at->format('d M Y') }}</span>
                            <a href="{{ route('layanan.pesanan', $p->layanan_id) }}"
                               class="text-xs font-bold text-purple-700 hover:underline">Kelola &rarr;</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- PORTFOLIO TERBARU --}}
        <div class="mt-6 rounded-4xl bg-white p-8 shadow-sm border border-[#DCE7FB]">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-[#0F172A]">Portfolio Terbaru</h2>
                <a href="{{ route('portfolio.mahasiswa') }}" class="text-sm font-semibold text-[#2563EB]">Lihat Semua</a>
            </div>

            @if($portfolioTerbaru->isEmpty())
                <div class="flex flex-col items-center justify-center py-10 text-center">
                    <p class="text-sm text-slate-400">Belum ada portfolio. <a href="{{ route('portfolio.create') }}" class="text-[#2563EB] font-semibold hover:underline">Tambah sekarang</a></p>
                </div>
            @else
                <div class="grid gap-6 md:grid-cols-3">
                    @foreach($portfolioTerbaru as $porto)
                    <a href="{{ route('portfolio.mahasiswa') }}" class="group block rounded-2xl overflow-hidden border border-[#DCE7FB] bg-[#F6FAFF] hover:shadow-md transition">
                        @if($porto->foto)
                            <img src="{{ asset('storage/' . $porto->foto) }}"
                                 class="w-full h-40 object-cover group-hover:scale-105 transition duration-300"
                                 alt="{{ $porto->judul }}">
                        @else
                            <div class="w-full h-40 bg-linear-to-br from-[#2563EB] to-[#1149C7] flex items-center justify-center">
                                <span class="text-white font-bold text-sm text-center px-4">{{ $porto->judul }}</span>
                            </div>
                        @endif
                        <div class="p-4">
                            <p class="font-semibold text-sm text-[#0F172A] truncate">{{ $porto->judul }}</p>
                            <p class="text-xs text-slate-400 mt-1 line-clamp-2">{{ $porto->deskripsi }}</p>
                        </div>
                    </a>
                    @endforeach
                </div>
            @endif
        </div>

    </main>

</div>

</body>
</html>
