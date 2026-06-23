<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $layanan->nama }} - SkillNest</title>
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
            <a href="{{ route('portfolio.mahasiswa') }}" class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Portfolio</a>
            <a href="{{ route('layanan.saya') }}" class="block rounded-xl bg-[#EAF2FF] px-4 py-3 font-semibold text-[#1846A3]">Layanan Saya</a>
            <a href="{{ route('chat') }}" class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Pesan</a>
        </nav>
        @endif
    </aside>

    {{-- CONTENT --}}
    <main class="flex-1 p-10 overflow-y-auto">

        {{-- BACK --}}
        <div class="mb-6">
            <a href="{{ url()->previous() }}"
               class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 hover:text-[#1846A3] transition">
                &#8592; Kembali
            </a>
        </div>

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

        <div class="grid gap-8 lg:grid-cols-3">

            {{-- LEFT: SERVICE INFO --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Thumbnail --}}
                @if($layanan->thumbnail)
                    <img src="{{ asset('storage/' . $layanan->thumbnail) }}"
                         class="w-full h-64 object-cover rounded-4xl" alt="{{ $layanan->nama }}">
                @else
                    <div class="w-full h-48 rounded-4xl bg-gradient-to-br from-[#2563EB] to-[#1149C7] flex items-center justify-center">
                        <span class="text-white text-2xl font-bold">{{ $layanan->nama }}</span>
                    </div>
                @endif

                {{-- Title + badges --}}
                <div class="rounded-4xl bg-white border border-[#DCE7FB] p-8 shadow-sm">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex-1 min-w-0">
                            <h1 class="text-3xl font-bold text-[#0F172A]">{{ $layanan->nama }}</h1>
                            <p class="mt-2 text-sm font-semibold text-[#2563EB]">{{ $layanan->kategori }}</p>
                        </div>
                        <div class="flex flex-col items-end gap-2 shrink-0">
                            <span class="rounded-xl px-3 py-1.5 text-xs font-bold
                                {{ $layanan->isOpen() ? 'bg-emerald-50 text-emerald-700 border border-emerald-100' : 'bg-red-50 text-red-600 border border-red-100' }}">
                                {{ $layanan->isOpen() ? '● Open' : '● Closed' }}
                            </span>
                        </div>
                    </div>

                    {{-- Rating summary --}}
                    @if($avgRating)
                        <div class="mt-4 flex items-center gap-2">
                            <span class="text-yellow-400 text-lg leading-none">
                                @for($i = 1; $i <= 5; $i++){{ $i <= round($avgRating) ? '★' : '☆' }}@endfor
                            </span>
                            <span class="font-bold text-slate-700">{{ number_format($avgRating, 1) }}</span>
                            <span class="text-sm text-slate-400">({{ $ratingCount }} ulasan)</span>
                        </div>
                    @endif

                    {{-- Description detail --}}
                    @if($layanan->deskripsi_detail)
                        <div class="mt-6 pt-6 border-t border-[#F1F5F9]">
                            <h3 class="font-bold text-[#0F172A] mb-3">Deskripsi Layanan</h3>
                            <div class="text-sm text-slate-600 leading-7 whitespace-pre-line">{{ $layanan->deskripsi_detail }}</div>
                        </div>
                    @elseif($layanan->deskripsi_singkat)
                        <div class="mt-6 pt-6 border-t border-[#F1F5F9]">
                            <p class="text-sm text-slate-600 leading-7">{{ $layanan->deskripsi_singkat }}</p>
                        </div>
                    @endif
                </div>

                {{-- ULASAN --}}
                <div class="rounded-4xl bg-white border border-[#DCE7FB] p-8 shadow-sm">
                    <h2 class="text-xl font-bold text-[#0F172A] mb-6">
                        Ulasan
                        @if($ratingCount > 0)
                            <span class="ml-2 text-sm font-normal text-slate-400">({{ $ratingCount }})</span>
                        @endif
                    </h2>

                    @if($ratings->isEmpty())
                        <div class="flex flex-col items-center justify-center py-10 text-center">
                            <svg class="h-12 w-12 text-slate-200 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                            </svg>
                            <p class="text-slate-400 font-medium">Belum ada ulasan untuk layanan ini.</p>
                        </div>
                    @else
                        <div class="space-y-5">
                            @foreach($ratings as $r)
                            @php
                                $umkmName = $r->umkm->nama_usaha ?? $r->umkm->name ?? 'Anonim';
                                $umkmInit = strtoupper(substr($umkmName, 0, 2));
                            @endphp
                            <div class="border-b border-[#F1F5F9] pb-5 last:border-0 last:pb-0">
                                <div class="flex items-start gap-4">
                                    @if($r->umkm->photo)
                                        <img src="{{ asset('storage/' . $r->umkm->photo) }}" alt="{{ $umkmName }}"
                                             class="h-10 w-10 rounded-full object-cover shrink-0">
                                    @else
                                        <div class="h-10 w-10 rounded-full bg-[#EAF2FF] flex items-center justify-center text-[#1846A3] font-bold text-sm shrink-0">
                                            {{ $umkmInit }}
                                        </div>
                                    @endif
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between gap-2 flex-wrap">
                                            <p class="font-semibold text-[#0F172A] text-sm">{{ $umkmName }}</p>
                                            <span class="text-xs text-slate-400">{{ $r->created_at->format('d M Y') }}</span>
                                        </div>
                                        <div class="mt-1 flex items-center gap-1.5">
                                            <span class="text-yellow-400 text-sm leading-none">
                                                @for($i = 1; $i <= 5; $i++){{ $i <= $r->stars ? '★' : '☆' }}@endfor
                                            </span>
                                            <span class="text-xs font-semibold text-slate-500">{{ $r->stars }}/5</span>
                                        </div>
                                        @if($r->ulasan)
                                            <p class="mt-2 text-sm text-slate-600 leading-6">"{{ $r->ulasan }}"</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>

            {{-- RIGHT: SIDEBAR --}}
            <div class="space-y-6">

                {{-- Price card + CTA --}}
                <div class="rounded-4xl bg-white border border-[#DCE7FB] p-6 shadow-sm sticky top-8">
                    <p class="text-xs text-slate-400 font-semibold uppercase tracking-wide">Harga Mulai</p>
                    <p class="mt-1 text-4xl font-bold text-[#1846A3]">{{ $layanan->formatHarga() }}</p>
                    <p class="mt-2 text-sm text-slate-500">Estimasi: <span class="font-semibold text-[#0F172A]">{{ $layanan->estimasi }}</span></p>

                    @if(auth()->user()->role === 'umkm')
                        <div class="mt-6">
                            @if(!$layanan->isOpen())
                                <div class="rounded-2xl bg-slate-50 border border-slate-200 px-5 py-4 text-center">
                                    <p class="text-sm font-semibold text-slate-400">Layanan Sedang Closed</p>
                                    <p class="text-xs text-slate-400 mt-1">Mahasiswa tidak menerima pesanan saat ini.</p>
                                </div>
                            @elseif($hasActiveOrder)
                                <div class="rounded-2xl bg-blue-50 border border-blue-200 px-5 py-4 text-center">
                                    <p class="text-sm font-semibold text-blue-700">Pesanan Sedang Berjalan</p>
                                    <p class="text-xs text-blue-500 mt-1">Kamu sudah memiliki pesanan aktif untuk layanan ini.</p>
                                </div>
                                <a href="{{ route('pesanan.umkm') }}"
                                   class="mt-3 flex w-full items-center justify-center rounded-2xl border border-[#1846A3] px-5 py-3 text-sm font-semibold text-[#1846A3] hover:bg-[#EAF2FF] transition">
                                    Lihat Pesanan
                                </a>
                            @else
                                <button onclick="openOrderModal()"
                                        class="w-full rounded-2xl bg-[#1846A3] px-5 py-4 text-sm font-bold text-white hover:bg-[#2563EB] transition shadow-lg shadow-blue-500/20">
                                    Pesan Layanan Ini
                                </button>
                            @endif
                        </div>
                    @endif
                </div>

                {{-- Mahasiswa info card --}}
                @php
                    $mhs      = $layanan->user;
                    $mName    = $mhs->nickname ?? $mhs->name;
                    $mInit    = strtoupper(substr($mName, 0, 2));
                    $mAvg     = $mhs->avgRating();
                    $mCount   = $mhs->ratingCount();
                @endphp
                <div class="rounded-4xl bg-white border border-[#DCE7FB] p-6 shadow-sm">
                    <h3 class="font-bold text-[#0F172A] mb-4 text-sm uppercase tracking-wide text-slate-400">Ditawarkan oleh</h3>
                    <div class="flex items-center gap-4">
                        @if($mhs->photo)
                            <img src="{{ asset('storage/' . $mhs->photo) }}" alt="{{ $mName }}"
                                 class="h-14 w-14 rounded-full object-cover shrink-0">
                        @else
                            <div class="h-14 w-14 rounded-full bg-[#EAF2FF] flex items-center justify-center text-[#1846A3] font-bold text-lg shrink-0">
                                {{ $mInit }}
                            </div>
                        @endif
                        <div class="min-w-0">
                            <p class="font-bold text-[#0F172A] truncate">{{ $mName }}</p>
                            @if($mhs->jurusan)
                                <p class="text-xs text-slate-500">{{ $mhs->jurusan }}</p>
                            @endif
                            @if($mAvg)
                                <div class="mt-1 flex items-center gap-1">
                                    <span class="text-yellow-400 text-xs">
                                        @for($i = 1; $i <= 5; $i++){{ $i <= round($mAvg) ? '★' : '☆' }}@endfor
                                    </span>
                                    <span class="text-xs font-semibold text-slate-600">{{ number_format($mAvg, 1) }}</span>
                                    <span class="text-xs text-slate-400">({{ $mCount }})</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="mt-4 grid grid-cols-2 gap-2">
                        <a href="{{ route('mahasiswa.profil', $mhs->id) }}"
                           class="rounded-xl border border-[#D9E5F7] px-4 py-2.5 text-xs font-semibold text-slate-600 hover:bg-slate-50 transition text-center">
                            Lihat Profil
                        </a>
                        <a href="{{ route('chat.start', $mhs->id) }}"
                           class="rounded-xl bg-[#1846A3] px-4 py-2.5 text-xs font-semibold text-white hover:bg-[#2563EB] transition text-center">
                            Hubungi
                        </a>
                    </div>
                </div>

            </div>

        </div>

    </main>
</div>

{{-- ORDER MODAL --}}
@if(auth()->user()->role === 'umkm' && $layanan->isOpen() && !$hasActiveOrder)
<div id="orderModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm p-4">
    <div class="w-full max-w-md rounded-4xl bg-white p-8 shadow-2xl">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-[#0F172A]">Konfirmasi Pesanan</h2>
            <button onclick="closeOrderModal()" class="text-slate-400 hover:text-slate-600 text-2xl leading-none">&times;</button>
        </div>
        <div class="rounded-2xl bg-[#F6FAFF] border border-[#DCE7FB] p-4 mb-6">
            <p class="text-xs text-slate-400 font-semibold uppercase tracking-wide mb-1">Layanan Dipilih</p>
            <p class="font-bold text-[#0F172A]">{{ $layanan->nama }}</p>
            <p class="text-sm font-semibold text-[#1846A3] mt-0.5">{{ $layanan->formatHarga() }}</p>
        </div>
        <form method="POST" action="{{ route('pesanan.store', $layanan->id) }}">
            @csrf
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                Pesan / Catatan <span class="text-slate-400 font-normal">(opsional)</span>
            </label>
            <textarea name="pesan" rows="4" maxlength="500"
                      placeholder="Jelaskan kebutuhan spesifik atau catatan tambahan untuk mahasiswa..."
                      class="w-full rounded-2xl border border-[#D9E5F7] bg-[#F6FAFF] px-4 py-3 text-sm text-slate-700 outline-none focus:border-[#2563EB] resize-none"></textarea>
            <p class="text-xs text-slate-400 mt-1">Maks. 500 karakter</p>
            <div class="mt-6 flex gap-3">
                <button type="button" onclick="closeOrderModal()"
                        class="flex-1 rounded-xl border border-[#D9E5F7] px-4 py-3 text-sm font-semibold text-slate-600 hover:bg-slate-50 transition">
                    Batal
                </button>
                <button type="submit"
                        class="flex-1 rounded-xl bg-[#1846A3] px-4 py-3 text-sm font-semibold text-white hover:bg-[#2563EB] transition">
                    Pesan Sekarang
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openOrderModal() {
        const m = document.getElementById('orderModal');
        m.classList.remove('hidden');
        m.classList.add('flex');
    }
    function closeOrderModal() {
        const m = document.getElementById('orderModal');
        m.classList.add('hidden');
        m.classList.remove('flex');
    }
    document.getElementById('orderModal').addEventListener('click', function(e) {
        if (e.target === this) closeOrderModal();
    });
</script>
@endif

</body>
</html>
