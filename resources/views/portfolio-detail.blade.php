<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $portfolio->judul }} - SkillNest</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#F6FAFF]">
<div class="min-h-screen flex">

    {{-- SIDEBAR (role-aware) --}}
    <aside class="w-72 bg-white border-r border-[#E2E8F0] p-6 shrink-0">
        <a href="{{ route('home') }}" class="flex items-center gap-3 mb-10">
            <img src="{{ asset('images/skillnestlogo.png') }}" class="h-10" alt="SkillNest">
            <span class="text-xl font-bold text-[#0F172A]">SkillNest</span>
        </a>
        @if(auth()->user()->role === 'umkm')
        <nav class="space-y-2">
            <a href="{{ route('dashboard.umkm') }}" class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Dashboard</a>
            <a href="{{ route('profile.umkm') }}" class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Profil UMKM</a>
            <a href="{{ route('cari.mahasiswa') }}" class="block rounded-xl bg-[#EAF2FF] px-4 py-3 font-semibold text-[#1846A3]">Cari Mahasiswa</a>
            <a href="{{ route('pesanan.umkm') }}" class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Pesanan Saya</a>
            <a href="{{ route('favorit.umkm') }}" class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Favorit</a>
            <a href="{{ route('chat') }}" class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Pesan</a>
        </nav>
        @else
        <nav class="space-y-2">
            <a href="{{ route('dashboard.mahasiswa') }}" class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Dashboard</a>
            <a href="{{ route('profile.mahasiswa') }}" class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Profil Saya</a>
            <a href="{{ route('portfolio.mahasiswa') }}" class="block rounded-xl bg-[#EAF2FF] px-4 py-3 font-semibold text-[#1846A3]">Portfolio</a>
            <a href="{{ route('layanan.saya') }}" class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Layanan Saya</a>
            <a href="{{ route('pesanan.saya') }}" class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Kelola Pesanan</a>
            <a href="{{ route('chat') }}" class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Pesan</a>
        </nav>
        @endif
    </aside>

    {{-- CONTENT --}}
    <main class="flex-1 overflow-y-auto">

        {{-- HERO IMAGE --}}
        @if($portfolio->foto)
            <div class="w-full h-80 bg-slate-100 overflow-hidden">
                <img src="{{ asset('storage/' . $portfolio->foto) }}"
                     alt="{{ $portfolio->judul }}"
                     class="w-full h-full object-cover">
            </div>
        @else
            <div class="w-full h-80 bg-linear-to-br from-[#2563EB] to-[#1149C7] flex items-center justify-center">
                <span class="text-white text-3xl font-bold text-center px-8">{{ $portfolio->judul }}</span>
            </div>
        @endif

        @php
            $owner     = $portfolio->user;
            $firstName = explode(' ', trim($owner->nickname ?? $owner->name))[0];
            $initials  = strtoupper(substr($firstName, 0, 2));
        @endphp

        <div class="p-10 max-w-4xl">

            {{-- BACK --}}
            <div class="mb-6">
                <a href="{{ route('mahasiswa.profil', $portfolio->user_id) }}"
                   class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 hover:text-[#1846A3] transition">
                    &#8592; Kembali ke Profil {{ $firstName }}
                </a>
            </div>

            {{-- MAIN CARD --}}
            <div class="rounded-4xl bg-white border border-[#DCE7FB] p-8 shadow-sm">

                {{-- Author --}}
                <div class="flex items-center justify-between flex-wrap gap-4 mb-6 pb-6 border-b border-[#F1F5F9]">
                    <div class="flex items-center gap-3">
                        <div class="h-11 w-11 rounded-full bg-[#EAF2FF] flex items-center justify-center text-[#1846A3] font-bold shrink-0">
                            {{ $initials }}
                        </div>
                        <div>
                            <p class="font-bold text-[#0F172A]">{{ $firstName }}</p>
                            @if($owner->jurusan)
                                <p class="text-xs text-slate-400">{{ $owner->jurusan }}
                                    @if($owner->universitas) &bull; {{ $owner->universitas }} @endif
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('mahasiswa.profil', $owner->id) }}"
                           class="rounded-xl border border-[#1846A3] px-4 py-2 text-sm font-semibold text-[#1846A3] hover:bg-[#EAF2FF] transition">
                            Lihat Profil
                        </a>
                        @if(auth()->user()->role === 'umkm')
                        <a href="{{ route('chat.start', $owner->id) }}"
                           class="rounded-xl bg-[#1846A3] px-4 py-2 text-sm font-semibold text-white hover:bg-[#2563EB] transition">
                            Hubungi
                        </a>
                        @endif
                        @if(auth()->id() === $owner->id)
                        <a href="{{ route('portfolio.edit', $portfolio->id) }}"
                           class="rounded-xl border border-[#D9E5F7] px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-50 transition">
                            Edit
                        </a>
                        @endif
                    </div>
                </div>

                {{-- Title & Date --}}
                <div class="mb-2 flex items-start justify-between gap-4 flex-wrap">
                    <h1 class="text-3xl font-bold text-[#0F172A]">{{ $portfolio->judul }}</h1>
                    <span class="text-xs text-slate-400 mt-1 shrink-0">
                        {{ $portfolio->created_at->format('d M Y') }}
                    </span>
                </div>

                {{-- Description --}}
                <div class="mt-4 text-slate-600 leading-7 whitespace-pre-line text-sm">
                    {{ $portfolio->deskripsi }}
                </div>

            </div>

            {{-- OTHER PORTFOLIOS --}}
            @if($otherPortfolios->isNotEmpty())
            <div class="mt-10">
                <h2 class="text-xl font-bold text-[#0F172A] mb-5">Portfolio Lainnya dari {{ $firstName }}</h2>
                <div class="grid gap-5 md:grid-cols-3">
                    @foreach($otherPortfolios as $other)
                    <a href="{{ route('portfolio.show', $other->id) }}"
                       class="group block rounded-4xl overflow-hidden bg-white border border-[#DCE7FB] shadow-sm hover:shadow-md transition">
                        @if($other->foto)
                            <div class="h-40 overflow-hidden">
                                <img src="{{ asset('storage/' . $other->foto) }}"
                                     alt="{{ $other->judul }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            </div>
                        @else
                            <div class="h-40 bg-linear-to-br from-[#2563EB] to-[#1149C7] flex items-center justify-center">
                                <span class="text-white text-sm font-bold text-center px-3">{{ $other->judul }}</span>
                            </div>
                        @endif
                        <div class="p-4">
                            <p class="font-bold text-sm text-[#0F172A] truncate">{{ $other->judul }}</p>
                            <p class="text-xs text-slate-400 mt-1 line-clamp-2">{{ $other->deskripsi }}</p>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

        </div>
    </main>
</div>
</body>
</html>
