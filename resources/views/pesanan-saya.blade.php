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
            <a href="{{ route('layanan.saya') }}" class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Layanan Saya</a>
            <a href="{{ route('pesanan.saya') }}" class="block rounded-xl bg-[#EAF2FF] px-4 py-3 font-semibold text-[#1846A3] relative">
                Kelola Pesanan
                @if($counts['menunggu_verifikasi'] > 0)
                    <span class="absolute right-4 top-1/2 -translate-y-1/2 rounded-full bg-yellow-400 px-2 py-0.5 text-xs font-bold text-white">
                        {{ $counts['menunggu_verifikasi'] }}
                    </span>
                @endif
            </a>
            <a href="{{ route('chat') }}" class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Pesan</a>
        </nav>
    </aside>

    {{-- CONTENT --}}
    <main class="flex-1 p-10 overflow-y-auto">

        <div class="flex items-center justify-between mb-2">
            <h1 class="text-4xl font-bold text-[#0F172A]">Kelola Pesanan</h1>
            @if($counts['menunggu_verifikasi'] > 0)
                <span class="rounded-xl bg-yellow-100 px-4 py-2 text-sm font-bold text-yellow-700">
                    {{ $counts['menunggu_verifikasi'] }} perlu ditinjau
                </span>
            @endif
        </div>
        <p class="text-slate-500 mb-8">Terima, kerjakan, dan selesaikan pesanan dari klien UMKM.</p>

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
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">
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
            <div class="rounded-2xl bg-red-50 border border-red-100 p-4">
                <p class="text-xs text-red-600 font-semibold">Ditolak</p>
                <p class="text-3xl font-bold text-red-700 mt-1">{{ $counts['ditolak'] }}</p>
            </div>
            <div class="rounded-2xl bg-slate-50 border border-slate-100 p-4">
                <p class="text-xs text-slate-500 font-semibold">Total</p>
                <p class="text-3xl font-bold text-slate-700 mt-1">{{ $counts['all'] }}</p>
            </div>
        </div>

        {{-- FILTER TABS --}}
        <div class="flex flex-wrap gap-2 mb-6">
            <a href="{{ route('pesanan.saya') }}"
               class="rounded-xl px-5 py-2 text-sm font-semibold transition
                      {{ !$filterStatus ? 'bg-[#1846A3] text-white' : 'border border-[#D9E5F7] bg-white text-slate-600 hover:bg-[#EAF2FF]' }}">
                Semua
            </a>
            <a href="{{ route('pesanan.saya', ['status' => 'menunggu_verifikasi']) }}"
               class="rounded-xl px-5 py-2 text-sm font-semibold transition
                      {{ $filterStatus === 'menunggu_verifikasi' ? 'bg-yellow-500 text-white' : 'border border-[#D9E5F7] bg-white text-slate-600 hover:bg-[#EAF2FF]' }}">
                Menunggu
                @if($counts['menunggu_verifikasi'] > 0)
                    <span class="ml-1 rounded-full bg-yellow-400 px-1.5 text-xs text-white font-bold">{{ $counts['menunggu_verifikasi'] }}</span>
                @endif
            </a>
            <a href="{{ route('pesanan.saya', ['status' => 'on_going']) }}"
               class="rounded-xl px-5 py-2 text-sm font-semibold transition
                      {{ $filterStatus === 'on_going' ? 'bg-purple-600 text-white' : 'border border-[#D9E5F7] bg-white text-slate-600 hover:bg-[#EAF2FF]' }}">
                On-going
            </a>
            <a href="{{ route('pesanan.saya', ['status' => 'selesai']) }}"
               class="rounded-xl px-5 py-2 text-sm font-semibold transition
                      {{ $filterStatus === 'selesai' ? 'bg-green-600 text-white' : 'border border-[#D9E5F7] bg-white text-slate-600 hover:bg-[#EAF2FF]' }}">
                Selesai
            </a>
        </div>

        {{-- PESANAN LIST --}}
        @if($pesanans->isEmpty())
            <div class="flex flex-col items-center justify-center rounded-4xl bg-white border border-[#DCE7FB] py-20 text-center shadow-sm">
                <svg class="h-14 w-14 text-slate-200 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                <p class="text-slate-400 font-medium">Tidak ada pesanan ditemukan.</p>
                <p class="text-slate-400 text-sm mt-1">Pesanan akan muncul saat UMKM memesan layananmu.</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach($pesanans as $pesanan)
                <div class="rounded-4xl bg-white border border-[#DCE7FB] p-6 shadow-sm
                    {{ $pesanan->status === 'menunggu_verifikasi' ? 'border-l-4 border-l-yellow-400' : '' }}">

                    <div class="flex flex-col md:flex-row md:items-start gap-5">

                        {{-- Client info --}}
                        <div class="flex items-center gap-4 flex-1 min-w-0">
                            <div class="h-12 w-12 rounded-full bg-linear-to-br from-[#2563EB] to-[#1149C7] flex items-center justify-center text-white font-bold text-lg shrink-0">
                                {{ strtoupper(substr($pesanan->user->name, 0, 1)) }}
                            </div>
                            <div class="min-w-0">
                                <p class="font-bold text-[#0F172A]">{{ $pesanan->user->name }}</p>
                                <p class="text-xs text-slate-400">{{ $pesanan->user->email }}</p>
                                <p class="text-sm text-slate-600 mt-1 font-semibold truncate">{{ $pesanan->layanan->nama }}</p>
                                <p class="text-xs text-slate-400 mt-0.5">{{ $pesanan->layanan->kategori }} &bull; {{ $pesanan->layanan->formatHarga() }}</p>
                                @if($pesanan->pesan)
                                    <p class="mt-2 text-sm text-slate-600 italic line-clamp-2 bg-slate-50 rounded-xl px-3 py-2 border border-[#F1F5F9]">
                                        "{{ $pesanan->pesan }}"
                                    </p>
                                @endif
                            </div>
                        </div>

                        {{-- Status + actions --}}
                        <div class="flex flex-col items-start md:items-end gap-3 shrink-0">
                            <p class="text-xs text-slate-400">{{ $pesanan->created_at->format('d M Y, H:i') }}</p>
                            <span class="rounded-lg px-3 py-1.5 text-xs font-bold {{ $pesanan->statusColor() }}">
                                {{ $pesanan->statusLabel() }}
                            </span>

                            {{-- Action buttons based on status --}}
                            @if($pesanan->status === 'menunggu_verifikasi')
                                <div class="flex gap-2">
                                    <form action="{{ route('pesanan.update-status', $pesanan->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="diterima">
                                        <button type="submit"
                                            class="rounded-xl bg-blue-600 px-4 py-2 text-xs font-bold text-white hover:bg-blue-700 transition">
                                            ✓ Terima
                                        </button>
                                    </form>
                                    <form action="{{ route('pesanan.update-status', $pesanan->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="ditolak">
                                        <button type="submit"
                                            class="rounded-xl bg-red-50 border border-red-200 px-4 py-2 text-xs font-bold text-red-600 hover:bg-red-100 transition">
                                            ✕ Tolak
                                        </button>
                                    </form>
                                </div>
                            @elseif($pesanan->status === 'diterima')
                                <form action="{{ route('pesanan.update-status', $pesanan->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="on_going">
                                    <button type="submit"
                                        class="rounded-xl bg-purple-600 px-4 py-2 text-xs font-bold text-white hover:bg-purple-700 transition">
                                        ▶ Mulai Pengerjaan
                                    </button>
                                </form>
                            @elseif($pesanan->status === 'on_going')
                                <form action="{{ route('pesanan.update-status', $pesanan->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="selesai">
                                    <button type="submit"
                                        class="rounded-xl bg-green-600 px-4 py-2 text-xs font-bold text-white hover:bg-green-700 transition">
                                        ✓ Tandai Selesai
                                    </button>
                                </form>
                            @endif

                            <a href="{{ route('chat.start', $pesanan->user_id) }}"
                               class="text-xs font-semibold text-[#2563EB] hover:underline">
                                Chat dengan klien &rarr;
                            </a>
                        </div>

                    </div>
                </div>
                @endforeach
            </div>
        @endif

    </main>
</div>
</body>
</html>
