<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya - SkillNest</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#F6FAFF]">
<div class="min-h-screen flex">

    {{-- SIDEBAR --}}
    <aside class="w-72 bg-white border-r border-[#E2E8F0] p-6 shrink-0">
        <a href="{{ route('home') }}" class="flex items-center gap-3 mb-10">
            <img src="{{ asset('images/skillnestlogo.png') }}" class="h-10" alt="SkillNest">
            <span class="text-xl font-bold text-[#0F172A]">SkillNest</span>
        </a>
        <nav class="space-y-2">
            <a href="{{ route('dashboard.umkm') }}" class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Dashboard</a>
            <a href="{{ route('profile.umkm') }}" class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Profil UMKM</a>
            <a href="{{ route('cari.mahasiswa') }}" class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Cari Mahasiswa</a>
            <a href="{{ route('pesanan.umkm') }}" class="block rounded-xl bg-[#EAF2FF] px-4 py-3 font-semibold text-[#1846A3]">Pesanan Saya</a>
            <a href="{{ route('favorit.umkm') }}" class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Favorit</a>
            <a href="{{ route('chat') }}" class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Pesan</a>
        </nav>
    </aside>

    {{-- CONTENT --}}
    <main class="flex-1 p-10 overflow-y-auto">

        <div class="flex items-center justify-between mb-2">
            <h1 class="text-4xl font-bold text-[#0F172A]">Pesanan Saya</h1>
            <span class="rounded-xl bg-[#EAF2FF] px-4 py-2 text-sm font-semibold text-[#1846A3]">
                {{ $counts['all'] }} total pesanan
            </span>
        </div>
        <p class="text-slate-500 mb-8">Pantau semua pesanan layanan yang telah kamu buat.</p>

        {{-- FLASH --}}
        @if(session('success'))
            <div class="mb-6 rounded-2xl bg-green-50 border border-green-200 px-5 py-4 text-sm text-green-700 font-medium">
                ✓ {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-6 rounded-2xl bg-red-50 border border-red-200 px-5 py-4 text-sm text-red-700 font-medium">
                {{ session('error') }}
            </div>
        @endif

        {{-- STATS --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <div class="rounded-2xl bg-yellow-50 border border-yellow-100 p-4">
                <p class="text-xs text-yellow-600 font-semibold">Menunggu</p>
                <p class="text-3xl font-bold text-yellow-700 mt-1">{{ $counts['menunggu_verifikasi'] }}</p>
            </div>
            <div class="rounded-2xl bg-purple-50 border border-purple-100 p-4">
                <p class="text-xs text-purple-600 font-semibold">On-going</p>
                <p class="text-3xl font-bold text-purple-700 mt-1">{{ $counts['on_going'] }}</p>
            </div>
            <div class="rounded-2xl bg-green-50 border border-green-100 p-4">
                <p class="text-xs text-green-600 font-semibold">Selesai</p>
                <p class="text-3xl font-bold text-green-700 mt-1">{{ $counts['selesai'] }}</p>
            </div>
            <div class="rounded-2xl bg-slate-50 border border-slate-100 p-4">
                <p class="text-xs text-slate-500 font-semibold">Total</p>
                <p class="text-3xl font-bold text-slate-700 mt-1">{{ $counts['all'] }}</p>
            </div>
        </div>

        {{-- FILTER TABS --}}
        <div class="flex flex-wrap gap-2 mb-6">
            <a href="{{ route('pesanan.umkm') }}"
               class="rounded-xl px-5 py-2 text-sm font-semibold transition
                      {{ !$filterStatus ? 'bg-[#1846A3] text-white' : 'border border-[#D9E5F7] bg-white text-slate-600 hover:bg-[#EAF2FF]' }}">
                Semua
            </a>
            <a href="{{ route('pesanan.umkm', ['status' => 'menunggu_verifikasi']) }}"
               class="rounded-xl px-5 py-2 text-sm font-semibold transition
                      {{ $filterStatus === 'menunggu_verifikasi' ? 'bg-yellow-500 text-white' : 'border border-[#D9E5F7] bg-white text-slate-600 hover:bg-[#EAF2FF]' }}">
                Menunggu
            </a>
            <a href="{{ route('pesanan.umkm', ['status' => 'on_going']) }}"
               class="rounded-xl px-5 py-2 text-sm font-semibold transition
                      {{ $filterStatus === 'on_going' ? 'bg-purple-600 text-white' : 'border border-[#D9E5F7] bg-white text-slate-600 hover:bg-[#EAF2FF]' }}">
                On-going
            </a>
            <a href="{{ route('pesanan.umkm', ['status' => 'selesai']) }}"
               class="rounded-xl px-5 py-2 text-sm font-semibold transition
                      {{ $filterStatus === 'selesai' ? 'bg-green-600 text-white' : 'border border-[#D9E5F7] bg-white text-slate-600 hover:bg-[#EAF2FF]' }}">
                Selesai
            </a>
        </div>

        {{-- LIST --}}
        @if($pesanans->isEmpty())
            <div class="flex flex-col items-center justify-center rounded-4xl bg-white border border-[#DCE7FB] py-20 text-center shadow-sm">
                <svg class="h-14 w-14 text-slate-200 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                <p class="text-slate-400 font-medium">Belum ada pesanan.</p>
                <p class="text-slate-400 text-sm mt-1">
                    <a href="{{ route('cari.mahasiswa') }}" class="text-[#2563EB] font-semibold hover:underline">Cari mahasiswa</a>
                    dan pesan layanan mereka.
                </p>
            </div>
        @else
            <div class="space-y-4">
                @foreach($pesanans as $p)
                @php
                    $mahasiswa = $p->layanan->user;
                    $mInit  = strtoupper(substr($mahasiswa->nickname ?? $mahasiswa->name, 0, 2));
                    $mName  = explode(' ', trim($mahasiswa->nickname ?? $mahasiswa->name))[0];
                    $isFav  = in_array($mahasiswa->id, $favoritIds);
                @endphp
                <div class="rounded-4xl bg-white border border-[#DCE7FB] p-6 shadow-sm hover:shadow-md transition">
                    <div class="flex flex-col md:flex-row md:items-center gap-5">

                        {{-- Mahasiswa info --}}
                        <div class="flex items-center gap-4 flex-1 min-w-0">
                            <div class="h-12 w-12 rounded-full bg-[#EAF2FF] flex items-center justify-center text-[#1846A3] font-bold text-sm shrink-0">
                                {{ $mInit }}
                            </div>
                            <div class="min-w-0">
                                <p class="font-bold text-[#0F172A]">{{ $mName }}</p>
                                <p class="text-sm font-semibold text-slate-600 truncate">{{ $p->layanan->nama }}</p>
                                <p class="text-xs text-slate-400 mt-0.5">{{ $p->layanan->kategori }} &bull; {{ $p->layanan->formatHarga() }}</p>
                                @if($p->pesan)
                                    <p class="mt-1.5 text-xs text-slate-500 italic line-clamp-1">"{{ $p->pesan }}"</p>
                                @endif
                            </div>
                        </div>

                        {{-- Date, status, action --}}
                        <div class="flex flex-col items-start md:items-end gap-2 shrink-0">
                            <p class="text-xs text-slate-400">{{ $p->created_at->format('d M Y, H:i') }}</p>
                            <span class="rounded-lg px-3 py-1 text-xs font-bold {{ $p->statusColor() }}">
                                {{ $p->statusLabel() }}
                            </span>
                            <div class="flex gap-2 mt-1 items-center">
                                <a href="{{ route('mahasiswa.profil', $mahasiswa->id) }}"
                                   class="rounded-lg border border-[#D9E5F7] px-3 py-1.5 text-xs font-semibold text-slate-600 hover:bg-slate-50 transition">
                                    Lihat Profil
                                </a>
                                <a href="{{ route('chat.start', $mahasiswa->id) }}"
                                   class="rounded-lg bg-[#1846A3] px-3 py-1.5 text-xs font-semibold text-white hover:bg-[#2563EB] transition">
                                    Chat
                                </a>
                                @if($p->status === 'selesai')
                                <button onclick="toggleFavorit(this, {{ $mahasiswa->id }})"
                                        data-fav="{{ $isFav ? '1' : '0' }}"
                                        title="{{ $isFav ? 'Hapus dari Favorit' : 'Tambah ke Favorit' }}"
                                        class="flex items-center justify-center h-8 w-8 rounded-lg border border-[#D9E5F7] hover:bg-red-50 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 pointer-events-none"
                                         viewBox="0 0 24 24"
                                         fill="{{ $isFav ? '#EF4444' : 'none' }}"
                                         stroke="{{ $isFav ? '#EF4444' : '#94A3B8' }}"
                                         stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                    </svg>
                                </button>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
                @endforeach
            </div>
        @endif

    </main>
</div>

<script>
const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

async function toggleFavorit(btn, mahasiswaId) {
    const res = await fetch(`/favorit/${mahasiswaId}`, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
    });
    const data = await res.json();
    const svg = btn.querySelector('svg');
    if (data.favorited) {
        svg.setAttribute('fill', '#EF4444');
        svg.setAttribute('stroke', '#EF4444');
        btn.setAttribute('data-fav', '1');
        btn.title = 'Hapus dari Favorit';
    } else {
        svg.setAttribute('fill', 'none');
        svg.setAttribute('stroke', '#94A3B8');
        btn.setAttribute('data-fav', '0');
        btn.title = 'Tambah ke Favorit';
    }
}
</script>

</body>
</html>
