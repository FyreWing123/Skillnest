<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->nickname ?? $user->name }} - SkillNest</title>
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
            <a href="{{ route('portfolio.mahasiswa') }}" class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Portfolio</a>
            <a href="{{ route('layanan.saya') }}" class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Layanan Saya</a>
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

            {{-- LEFT: PROFILE CARD --}}
            <div class="lg:col-span-1 space-y-6">

                {{-- Identity --}}
                <div class="rounded-4xl bg-white border border-[#DCE7FB] p-8 shadow-sm text-center">
                    @php
                        $firstName = explode(' ', trim($user->nickname ?? $user->name))[0];
                        $initials  = strtoupper(substr($firstName, 0, 2));
                    @endphp
                    <div class="mx-auto h-20 w-20 rounded-full bg-[#EAF2FF] flex items-center justify-center text-[#1846A3] font-bold text-2xl mb-4">
                        {{ $initials }}
                    </div>
                    <h1 class="text-2xl font-bold text-[#0F172A]">{{ $user->nickname ?? $user->name }}</h1>
                    @if($user->jurusan)
                        <p class="mt-1 text-sm font-semibold text-[#2563EB]">{{ $user->jurusan }}</p>
                    @endif
                    @if($user->universitas)
                        <p class="mt-0.5 text-xs text-slate-400">{{ $user->universitas }}</p>
                    @endif
                    @if($user->semester)
                        <p class="mt-0.5 text-xs text-slate-400">Semester {{ $user->semester }}</p>
                    @endif

                    @if($user->bio)
                        <p class="mt-4 text-sm text-slate-500 leading-6">{{ $user->bio }}</p>
                    @endif

                    {{-- Action Buttons --}}
                    <div class="mt-6 flex gap-3">
                        <a href="{{ route('chat.start', $user->id) }}"
                           class="flex-1 rounded-xl border border-[#1846A3] px-4 py-2.5 text-sm font-semibold text-[#1846A3] hover:bg-[#EAF2FF] transition text-center">
                            Hubungi
                        </a>
                    </div>
                </div>

                {{-- Skills --}}
                @php $skills = $user->skills_array; @endphp
                @if(count($skills) > 0)
                <div class="rounded-4xl bg-white border border-[#DCE7FB] p-6 shadow-sm">
                    <h3 class="font-bold text-[#0F172A] mb-4">Keahlian</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($skills as $skill)
                            <span class="rounded-full bg-[#EAF2FF] px-3 py-1 text-xs font-semibold text-[#1846A3]">
                                {{ $skill }}
                            </span>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Portfolio --}}
                @if($portfolios->isNotEmpty())
                <div class="rounded-4xl bg-white border border-[#DCE7FB] p-6 shadow-sm">
                    <h3 class="font-bold text-[#0F172A] mb-4">Portfolio</h3>
                    <div class="grid grid-cols-2 gap-3">
                        @foreach($portfolios as $porto)
                        <a href="{{ route('portfolio.show', $porto->id) }}"
                           class="group block rounded-2xl overflow-hidden border border-[#DCE7FB] hover:shadow-md transition">
                            @if($porto->foto)
                                <div class="h-24 overflow-hidden">
                                    <img src="{{ asset('storage/' . $porto->foto) }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                                         alt="{{ $porto->judul }}">
                                </div>
                            @else
                                <div class="w-full h-24 bg-linear-to-br from-[#2563EB] to-[#1149C7] flex items-center justify-center px-2">
                                    <span class="text-white text-xs font-bold text-center">{{ $porto->judul }}</span>
                                </div>
                            @endif
                            <p class="text-xs font-semibold text-[#0F172A] truncate px-2 py-1.5">{{ $porto->judul }}</p>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

            </div>

            {{-- RIGHT: LAYANANS --}}
            <div class="lg:col-span-2">
                <h2 class="text-2xl font-bold text-[#0F172A] mb-6">
                    Layanan Tersedia
                    <span class="ml-2 rounded-lg bg-[#EAF2FF] px-2.5 py-1 text-sm font-bold text-[#1846A3]">
                        {{ $layanans->count() }}
                    </span>
                </h2>

                @if($layanans->isEmpty())
                    <div class="flex flex-col items-center justify-center rounded-4xl bg-white border border-[#DCE7FB] py-16 text-center shadow-sm">
                        <svg class="h-12 w-12 text-slate-200 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/>
                        </svg>
                        <p class="text-slate-400 font-medium">Belum ada layanan aktif.</p>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach($layanans as $layanan)
                        <div class="rounded-4xl bg-white border border-[#DCE7FB] p-6 shadow-sm hover:shadow-md transition">
                            <div class="flex items-start gap-5">

                                {{-- Thumbnail --}}
                                @if($layanan->thumbnail)
                                    <img src="{{ asset('storage/' . $layanan->thumbnail) }}"
                                         class="h-20 w-28 rounded-2xl object-cover shrink-0" alt="{{ $layanan->nama }}">
                                @else
                                    <div class="h-20 w-28 rounded-2xl bg-linear-to-br from-[#2563EB] to-[#1149C7] flex items-center justify-center shrink-0">
                                        <span class="text-white text-xs font-bold text-center px-2">{{ $layanan->nama }}</span>
                                    </div>
                                @endif

                                {{-- Info --}}
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-start justify-between gap-3">
                                        <div>
                                            <h3 class="font-bold text-[#0F172A]">{{ $layanan->nama }}</h3>
                                            <p class="text-sm text-slate-500 mt-0.5">{{ $layanan->kategori }} &bull; {{ $layanan->estimasi }}</p>
                                        </div>
                                        <span class="rounded-lg px-2.5 py-1 text-xs font-bold shrink-0
                                            {{ $layanan->isOpen() ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-600' }}">
                                            {{ $layanan->isOpen() ? 'Open' : 'Closed' }}
                                        </span>
                                    </div>

                                    @if($layanan->deskripsi_singkat)
                                        <p class="mt-2 text-sm text-slate-500 line-clamp-2">{{ $layanan->deskripsi_singkat }}</p>
                                    @endif

                                    <div class="mt-4 flex items-center justify-between">
                                        <p class="font-bold text-xl text-[#1846A3]">{{ $layanan->formatHarga() }}</p>

                                        @if(auth()->user()->role === 'umkm')
                                            @if($layanan->isOpen())
                                                <button onclick="openModal({{ $layanan->id }}, '{{ addslashes($layanan->nama) }}', '{{ $layanan->formatHarga() }}')"
                                                        class="rounded-xl bg-[#1846A3] px-5 py-2.5 text-sm font-semibold text-white hover:bg-[#2563EB] transition">
                                                    Pesan Layanan
                                                </button>
                                            @else
                                                <span class="rounded-xl bg-slate-100 px-5 py-2.5 text-sm font-semibold text-slate-400">
                                                    Tidak Tersedia
                                                </span>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>

    </main>
</div>

{{-- ORDER MODAL --}}
@if(auth()->user()->role === 'umkm')
<div id="orderModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm p-4">
    <div class="w-full max-w-md rounded-4xl bg-white p-8 shadow-2xl">

        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-[#0F172A]">Konfirmasi Pesanan</h2>
            <button onclick="closeModal()" class="text-slate-400 hover:text-slate-600 text-2xl leading-none">&times;</button>
        </div>

        {{-- Layanan info (filled by JS) --}}
        <div class="rounded-2xl bg-[#F6FAFF] border border-[#DCE7FB] p-4 mb-6">
            <p class="text-xs text-slate-400 font-semibold uppercase tracking-wide mb-1">Layanan Dipilih</p>
            <p id="modalLayananNama" class="font-bold text-[#0F172A]"></p>
            <p id="modalLayananHarga" class="text-sm font-semibold text-[#1846A3] mt-0.5"></p>
        </div>

        <form id="orderForm" method="POST">
            @csrf
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                Pesan / Catatan <span class="text-slate-400 font-normal">(opsional)</span>
            </label>
            <textarea name="pesan" rows="4" maxlength="500"
                      placeholder="Jelaskan kebutuhan spesifik atau catatan tambahan untuk mahasiswa..."
                      class="w-full rounded-2xl border border-[#D9E5F7] bg-[#F6FAFF] px-4 py-3 text-sm text-slate-700 outline-none focus:border-[#2563EB] resize-none"></textarea>
            <p class="text-xs text-slate-400 mt-1">Maks. 500 karakter</p>

            <div class="mt-6 flex gap-3">
                <button type="button" onclick="closeModal()"
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
    const baseUrl = '{{ url('/pesan') }}';

    function openModal(layananId, nama, harga) {
        document.getElementById('modalLayananNama').textContent = nama;
        document.getElementById('modalLayananHarga').textContent = harga;
        document.getElementById('orderForm').action = baseUrl + '/' + layananId;
        document.getElementById('orderModal').classList.remove('hidden');
        document.getElementById('orderModal').classList.add('flex');
    }

    function closeModal() {
        document.getElementById('orderModal').classList.add('hidden');
        document.getElementById('orderModal').classList.remove('flex');
    }

    // Close on backdrop click
    document.getElementById('orderModal').addEventListener('click', function(e) {
        if (e.target === this) closeModal();
    });
</script>
@endif

</body>
</html>
