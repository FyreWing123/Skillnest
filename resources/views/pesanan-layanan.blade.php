<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pesanan - SkillNest</title>
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
            <a href="{{ route('dashboard.mahasiswa') }}" class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Dashboard</a>
            <a href="{{ route('profile.mahasiswa') }}" class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Profil Saya</a>
            <a href="{{ route('portfolio.mahasiswa') }}" class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Portfolio</a>
            <a href="{{ route('layanan.saya') }}" class="block rounded-xl bg-[#EAF2FF] px-4 py-3 font-semibold text-[#1846A3]">Layanan Saya</a>
            <a href="{{ route('chat') }}" class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Pesan</a>
        </nav>
    </aside>

    {{-- CONTENT --}}
    <main class="flex-1 p-10">

        {{-- HEADER --}}
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('layanan.saya') }}"
               class="flex items-center justify-center w-10 h-10 rounded-xl bg-white border border-[#E2E8F0] text-slate-500 hover:bg-slate-50 shadow-sm">
                &#8592;
            </a>
            <div class="flex-1">
                <h1 class="text-3xl font-bold text-[#0F172A]">Kelola Pesanan</h1>
                <p class="mt-1 text-sm text-slate-500">{{ $layanan->nama }} &bull; {{ $layanan->kategori }}</p>
            </div>
        </div>

        {{-- FLASH --}}
        @if(session('success'))
            <div class="mb-6 rounded-xl bg-green-50 border border-green-200 px-5 py-3 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-6 rounded-xl bg-red-50 border border-red-200 px-5 py-3 text-sm text-red-700">
                {{ session('error') }}
            </div>
        @endif

        {{-- INFO LAYANAN + TOGGLE KETERSEDIAAN --}}
        <div class="mb-8 rounded-2xl bg-white border border-[#DCE7FB] p-6 shadow-sm flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <div class="flex items-center gap-5">
                @if($layanan->thumbnail)
                    <img src="{{ asset('storage/' . $layanan->thumbnail) }}"
                         class="h-16 w-24 rounded-xl object-cover" alt="{{ $layanan->nama }}">
                @else
                    <div class="h-16 w-24 rounded-xl bg-linear-to-br from-[#2563EB] to-[#1149C7] flex items-center justify-center">
                        <span class="text-white text-xs font-bold text-center px-2">{{ $layanan->nama }}</span>
                    </div>
                @endif
                @php
                    $pesananIds  = $pesanans->pluck('id');
                    $avgRating   = \App\Models\Rating::whereIn('pesanan_id', $pesananIds)->avg('stars');
                    $ratingCount = \App\Models\Rating::whereIn('pesanan_id', $pesananIds)->count();
                @endphp
                <div>
                    <h2 class="font-bold text-[#0F172A] text-lg">{{ $layanan->nama }}</h2>
                    <p class="text-sm text-slate-500">{{ $layanan->kategori }} &bull; {{ $layanan->formatHarga() }} &bull; {{ $layanan->estimasi }}</p>
                    <div class="mt-2 flex items-center gap-4 flex-wrap">
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-semibold text-slate-500">Total pesanan:</span>
                            <span class="rounded-lg bg-[#EAF2FF] px-2.5 py-0.5 text-xs font-bold text-[#1846A3]">
                                {{ $pesanans->count() }}
                            </span>
                        </div>
                        @if($avgRating)
                            <div class="flex items-center gap-1.5">
                                <span class="text-yellow-400 text-sm leading-none">
                                    @for($i = 1; $i <= 5; $i++){{ $i <= round($avgRating) ? '★' : '☆' }}@endfor
                                </span>
                                <span class="text-sm font-bold text-slate-700">{{ number_format($avgRating, 1) }}</span>
                                <span class="text-xs text-slate-400">({{ $ratingCount }} ulasan)</span>
                            </div>
                        @else
                            <span class="text-xs text-slate-400">Belum ada rating</span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Toggle Open/Closed --}}
            <div class="flex flex-col items-start md:items-end gap-2">
                <p class="text-xs text-slate-400 font-medium">Status Ketersediaan</p>
                <form action="{{ route('layanan.toggle-ketersediaan', $layanan->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit"
                        class="flex items-center gap-2 rounded-xl px-5 py-2.5 text-sm font-bold transition
                               {{ $layanan->isOpen()
                                    ? 'bg-emerald-50 text-emerald-700 border border-emerald-200 hover:bg-emerald-100'
                                    : 'bg-red-50 text-red-600 border border-red-200 hover:bg-red-100' }}">
                        <span class="h-2 w-2 rounded-full {{ $layanan->isOpen() ? 'bg-emerald-500' : 'bg-red-500' }}"></span>
                        {{ $layanan->isOpen() ? 'Open — Klik untuk Closed' : 'Closed — Klik untuk Open' }}
                    </button>
                </form>
                <p class="text-[11px] text-slate-400">
                    {{ $layanan->isOpen() ? 'Layanan sedang menerima pesanan baru.' : 'Layanan tidak menerima pesanan baru.' }}
                </p>
            </div>

        </div>

        {{-- STATS BAR --}}
        @php
            $counts = [
                'menunggu_verifikasi' => $pesanans->where('status','menunggu_verifikasi')->count(),
                'diterima'            => $pesanans->where('status','diterima')->count(),
                'on_going'            => $pesanans->where('status','on_going')->count(),
                'selesai'             => $pesanans->where('status','selesai')->count(),
                'ditolak'             => $pesanans->where('status','ditolak')->count(),
            ];
        @endphp
        <div class="mb-8 grid grid-cols-2 md:grid-cols-5 gap-4">
            <div class="rounded-2xl bg-yellow-50 border border-yellow-100 p-4">
                <p class="text-xs text-yellow-600 font-semibold">Menunggu</p>
                <p class="text-3xl font-bold text-yellow-700 mt-1">{{ $counts['menunggu_verifikasi'] }}</p>
            </div>
            <div class="rounded-2xl bg-blue-50 border border-blue-100 p-4">
                <p class="text-xs text-blue-600 font-semibold">Diterima</p>
                <p class="text-3xl font-bold text-blue-700 mt-1">{{ $counts['diterima'] }}</p>
            </div>
            <div class="rounded-2xl bg-purple-50 border border-purple-100 p-4">
                <p class="text-xs text-purple-600 font-semibold">On-going</p>
                <p class="text-3xl font-bold text-purple-700 mt-1">{{ $counts['on_going'] }}</p>
            </div>
            <div class="rounded-2xl bg-green-50 border border-green-100 p-4">
                <p class="text-xs text-green-600 font-semibold">Selesai</p>
                <p class="text-3xl font-bold text-green-700 mt-1">{{ $counts['selesai'] }}</p>
            </div>
            <div class="rounded-2xl bg-red-50 border border-red-100 p-4">
                <p class="text-xs text-red-600 font-semibold">Ditolak</p>
                <p class="text-3xl font-bold text-red-700 mt-1">{{ $counts['ditolak'] }}</p>
            </div>
        </div>

        {{-- DAFTAR PESANAN --}}
        @if($pesanans->isEmpty())
            <div class="flex flex-col items-center justify-center rounded-2xl bg-white border border-[#DCE7FB] py-20 text-center shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-14 h-14 text-slate-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                <p class="text-slate-400 text-sm font-medium">Belum ada pesanan untuk layanan ini.</p>
                <p class="text-slate-400 text-xs mt-1">Pesanan akan muncul di sini ketika ada UMKM yang tertarik.</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach($pesanans as $pesanan)
                <div class="rounded-2xl bg-white border border-[#DCE7FB] shadow-sm overflow-hidden">

                    {{-- Baris utama pesanan --}}
                    <div class="p-6 flex flex-col md:flex-row md:items-center gap-5">

                        {{-- Avatar & Info Pemesan --}}
                        <div class="flex items-center gap-4 flex-1 min-w-0">
                            @if($pesanan->user->photo)
                                <img src="{{ asset('storage/' . $pesanan->user->photo) }}" alt=""
                                     class="h-12 w-12 rounded-full object-cover shrink-0">
                            @else
                                <div class="h-12 w-12 rounded-full bg-linear-to-br from-[#2563EB] to-[#1149C7] flex items-center justify-center text-white font-bold text-lg shrink-0">
                                    {{ strtoupper(substr($pesanan->user->name, 0, 1)) }}
                                </div>
                            @endif
                            <div class="min-w-0">
                                <p class="font-bold text-[#0F172A]">{{ $pesanan->user->name }}</p>
                                <p class="text-xs text-slate-400">{{ $pesanan->user->email }}</p>
                                @if($pesanan->pesan)
                                    <p class="mt-1.5 text-sm text-slate-600 italic line-clamp-2">"{{ $pesanan->pesan }}"</p>
                                @endif
                            </div>
                        </div>

                        {{-- Tanggal & Status Badge --}}
                        <div class="flex flex-col items-start md:items-end gap-3 shrink-0">
                            <p class="text-xs text-slate-400">{{ $pesanan->created_at->format('d M Y, H:i') }}</p>
                            <span class="rounded-lg px-3 py-1 text-xs font-bold {{ $pesanan->statusColor() }}">
                                {{ $pesanan->statusLabel() }}
                            </span>

                            @if($pesanan->status === 'menunggu_verifikasi')
                                <div class="flex gap-2">
                                    <form action="{{ route('pesanan.update-status', $pesanan->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="diterima">
                                        <button type="submit"
                                            class="rounded-lg bg-blue-600 px-3 py-2 text-xs font-bold text-white hover:bg-blue-700 transition">
                                            ✓ Terima
                                        </button>
                                    </form>
                                    <form action="{{ route('pesanan.update-status', $pesanan->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="ditolak">
                                        <button type="submit"
                                            class="rounded-lg bg-red-50 border border-red-200 px-3 py-2 text-xs font-bold text-red-600 hover:bg-red-100 transition">
                                            ✕ Tolak
                                        </button>
                                    </form>
                                </div>
                            @elseif($pesanan->status === 'diterima')
                                <form action="{{ route('pesanan.update-status', $pesanan->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="on_going">
                                    <button type="submit"
                                        class="rounded-lg bg-purple-600 px-3 py-2 text-xs font-bold text-white hover:bg-purple-700 transition">
                                        ▶ Mulai Pengerjaan
                                    </button>
                                </form>
                            @elseif($pesanan->status === 'on_going')
                                <form action="{{ route('pesanan.update-status', $pesanan->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="selesai">
                                    <button type="submit"
                                        class="rounded-lg bg-green-600 px-3 py-2 text-xs font-bold text-white hover:bg-green-700 transition">
                                        ✓ Tandai Selesai
                                    </button>
                                </form>
                            @else
                                <span class="text-xs text-slate-400 italic">—</span>
                            @endif
                        </div>

                    </div>

                    {{-- Rating dari UMKM (hanya tampil kalau ada) --}}
                    @if($pesanan->rating)
                        <div class="border-t border-[#F1F5F9] mx-6 py-4 flex items-start gap-3">
                            <span class="text-yellow-400 text-base leading-none shrink-0 mt-0.5">
                                @for($i = 1; $i <= 5; $i++){{ $i <= $pesanan->rating->stars ? '★' : '☆' }}@endfor
                            </span>
                            <div class="min-w-0">
                                <div class="flex items-center gap-2">
                                    <span class="text-sm font-bold text-[#0F172A]">{{ $pesanan->rating->stars }}/5</span>
                                    <span class="text-xs text-slate-400">· {{ $pesanan->rating->created_at->format('d M Y') }}</span>
                                </div>
                                @if($pesanan->rating->ulasan)
                                    <p class="mt-1 text-sm text-slate-600">"{{ $pesanan->rating->ulasan }}"</p>
                                @else
                                    <p class="mt-1 text-xs text-slate-400 italic">Tidak ada ulasan tertulis.</p>
                                @endif
                            </div>
                        </div>
                    @endif

                </div>
                @endforeach
            </div>
        @endif

    </main>

</div>

</body>
</html>
