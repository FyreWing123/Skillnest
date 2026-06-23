<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard UMKM - SkillNest</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#F6FAFF]">
<div class="min-h-screen flex">

    {{-- SIDEBAR --}}
    <aside class="w-72 bg-white border-r border-[#E2E8F0] p-6">
        <a href="{{ route('home') }}" class="flex items-center gap-3 mb-10">
            <img src="{{ asset('images/skillnestlogo.png') }}" class="h-10" alt="SkillNest">
            <span class="text-xl font-bold text-[#0F172A]">SkillNest</span>
        </a>

        <nav class="space-y-2">
            <a href="{{ route('dashboard.umkm') }}"
                class="block rounded-xl bg-[#EAF2FF] px-4 py-3 font-semibold text-[#1846A3]">
                Dashboard
            </a>
            <a href="{{ route('profile.umkm') }}"
                class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">
                Profil UMKM
            </a>
            <a href="{{ route('cari.mahasiswa') }}"
                class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">
                Cari Mahasiswa
            </a>
            <a href="{{ route('pesanan.umkm') }}"
                class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">
                Pesanan Saya
            </a>
            <a href="{{ route('favorit.umkm') }}"
                class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">
                Favorit
            </a>
            <a href="{{ route('chat') }}"
                class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">
                Pesan
            </a>
        </nav>
    </aside>

    {{-- CONTENT --}}
    <main class="flex-1 p-10">

        {{-- HEADER --}}
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-bold text-[#0F172A]">Halo, {{ auth()->user()->nickname ?? auth()->user()->name }} 👋</h1>
                <p class="mt-3 text-slate-500">Selamat datang kembali di dashboard SkillNest.</p>
            </div>
            <a href="{{ route('cari.mahasiswa') }}"
                class="rounded-2xl bg-gradient-to-r from-[#2563EB] to-[#1149C7] px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-500/20">
                Cari Mahasiswa
            </a>
        </div>

        {{-- STATS --}}
        <div class="mt-10 grid gap-6 md:grid-cols-2 xl:grid-cols-4">
            <div class="rounded-[2rem] bg-white p-6 shadow-sm">
                <p class="text-slate-500 text-sm">Total Pesanan</p>
                <h2 class="mt-3 text-4xl font-bold text-[#1846A3]">{{ $totalPesanan }}</h2>
            </div>
            <div class="rounded-[2rem] bg-white p-6 shadow-sm">
                <p class="text-slate-500 text-sm">Pesanan Aktif</p>
                <h2 class="mt-3 text-4xl font-bold text-[#1846A3]">{{ $pesananAktif }}</h2>
            </div>
            <div class="rounded-[2rem] bg-white p-6 shadow-sm">
                <p class="text-slate-500 text-sm">Selesai</p>
                <h2 class="mt-3 text-4xl font-bold text-[#1846A3]">{{ $pesananSelesai }}</h2>
            </div>
            <div class="rounded-[2rem] bg-white p-6 shadow-sm">
                <p class="text-slate-500 text-sm">Mahasiswa Favorit</p>
                <h2 class="mt-3 text-4xl font-bold text-[#F59E0B]">★ {{ $totalFavorit }}</h2>
            </div>
        </div>

        {{-- QUICK ACTION --}}
        <div class="mt-10 grid gap-6 lg:grid-cols-3">
            <a href="{{ route('cari.mahasiswa') }}"
                class="rounded-[2rem] bg-[#1846A3] p-8 text-white shadow-sm transition hover:scale-[1.02]">
                <h3 class="text-2xl font-bold">Cari Mahasiswa</h3>
                <p class="mt-3 text-white/80">Temukan mahasiswa berbakat sesuai kebutuhan bisnismu.</p>
            </a>
            <a href="{{ route('pesanan.umkm') }}"
                class="rounded-[2rem] bg-white p-8 shadow-sm transition hover:shadow-md">
                <h3 class="text-2xl font-bold text-[#0F172A]">Kelola Pesanan</h3>
                <p class="mt-3 text-slate-500">Pantau status dan progress semua pesananmu.</p>
            </a>
            <a href="{{ route('profile.umkm') }}"
                class="rounded-[2rem] bg-white p-8 shadow-sm transition hover:shadow-md">
                <h3 class="text-2xl font-bold text-[#0F172A]">Edit Profil</h3>
                <p class="mt-3 text-slate-500">Perbarui informasi usaha dan kontak UMKM kamu.</p>
            </a>
        </div>

        {{-- PESANAN AKTIF --}}
        <div class="mt-10 rounded-[2rem] bg-white p-8 shadow-sm">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold text-[#0F172A]">Pesanan Aktif</h2>
                <a href="{{ route('pesanan.umkm') }}" class="text-sm font-semibold text-[#2563EB]">Lihat Semua</a>
            </div>

            @if($pesananAktifList->isEmpty())
                <p class="mt-6 text-sm text-slate-400 text-center py-8">Belum ada pesanan aktif.</p>
            @else
                <div class="mt-6 space-y-0">
                    @foreach($pesananAktifList as $p)
                    @php
                        $mhs      = $p->layanan->user ?? null;
                        $mName    = $mhs ? ($mhs->nickname ?? $mhs->name) : '—';
                        $initials = strtoupper(substr($mName, 0, 2));
                    @endphp
                    <div class="flex items-center justify-between {{ !$loop->last ? 'border-b' : '' }} py-4">
                        <div class="flex items-center gap-4">
                            @if($mhs && $mhs->photo)
                                <img src="{{ asset('storage/' . $mhs->photo) }}" alt="{{ $mName }}"
                                     class="h-10 w-10 rounded-full object-cover shrink-0">
                            @else
                                <div class="h-10 w-10 rounded-full bg-[#EAF2FF] flex items-center justify-center text-[#1846A3] font-bold text-sm shrink-0">
                                    {{ $initials }}
                                </div>
                            @endif
                            <div>
                                <p class="font-semibold text-[#0F172A]">{{ $mName }}</p>
                                <p class="text-sm text-slate-500">{{ $p->layanan->nama ?? '—' }}</p>
                            </div>
                        </div>
                        <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $p->statusColor() }}">
                            {{ $p->statusLabel() }}
                        </span>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- MAHASISWA FAVORIT --}}
        <div class="mt-10 rounded-[2rem] bg-white p-8 shadow-sm">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold text-[#0F172A]">Mahasiswa Favorit</h2>
                <a href="{{ route('favorit.umkm') }}" class="text-sm font-semibold text-[#2563EB]">Lihat Semua</a>
            </div>

            @if($favoritList->isEmpty())
                <p class="mt-6 text-sm text-slate-400 text-center py-8">Belum ada mahasiswa favorit.</p>
            @else
                <div class="mt-6 grid gap-4 md:grid-cols-3">
                    @foreach($favoritList as $fav)
                    @php
                        $m        = $fav->mahasiswa;
                        $fName    = explode(' ', trim($m->nickname ?? $m->name))[0];
                        $initials = strtoupper(substr($fName, 0, 2));
                        $skill    = $m->layanans->first()->kategori ?? ($m->jurusan ?? 'Mahasiswa');
                        $avg      = $m->avgRating();
                    @endphp
                    <div class="rounded-2xl border border-[#E2E8F0] p-5">
                        <div class="flex items-center gap-3">
                            @if($m->photo)
                                <img src="{{ asset('storage/' . $m->photo) }}" alt="{{ $fName }}"
                                     class="h-12 w-12 rounded-full object-cover shrink-0">
                            @else
                                <div class="h-12 w-12 rounded-full bg-[#EAF2FF] flex items-center justify-center text-[#1846A3] font-bold shrink-0">
                                    {{ $initials }}
                                </div>
                            @endif
                            <div class="min-w-0">
                                <p class="font-semibold text-[#0F172A] truncate">{{ $fName }}</p>
                                <p class="text-xs text-slate-500 truncate">{{ $skill }}</p>
                            </div>
                        </div>
                        <div class="mt-3 flex items-center justify-between">
                            @if($avg)
                                <span class="text-sm text-[#F59E0B] font-semibold">★ {{ number_format($avg, 1) }}</span>
                            @else
                                <span class="text-xs text-slate-400">Belum ada rating</span>
                            @endif
                            <a href="{{ route('mahasiswa.profil', $m->id) }}"
                               class="text-xs font-semibold text-[#2563EB]">Lihat Profil</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>

    </main>
</div>
</body>
</html>
