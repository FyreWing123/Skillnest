<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Services - SkillNest</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="bg-[#F6FAFF] text-[#1b1b18] min-h-screen flex flex-col overflow-x-hidden">

    @include('partials.header')

    <main class="flex-1">

        {{-- HERO --}}
        <section class="relative overflow-hidden px-6 py-24 md:px-10">
            <div class="absolute right-10 top-0 h-[260px] w-[260px] rounded-full bg-[#DCE7FB] opacity-70"></div>
            <div class="absolute right-0 top-24 h-[140px] w-[140px] rounded-full bg-[#F3E7BE] opacity-80"></div>
            <div class="relative mx-auto max-w-7xl">
                <span class="inline-flex items-center rounded-full bg-[#EAF2FF] px-5 py-2 text-xs font-semibold uppercase tracking-[0.28em] text-[#1E3A8A]">
                    EXPLORE SERVICES
                </span>
                <h1 class="mt-8 max-w-4xl text-5xl font-bold leading-[1.05] tracking-[-0.03em] text-[#0F172A] md:text-[4.5rem]">
                    Temukan Jasa Mahasiswa<br>Sesuai Kebutuhan Bisnismu
                </h1>
                <p class="mt-8 max-w-2xl text-lg leading-8 text-[#64748B]">
                    Cari mahasiswa berbakat untuk desain, website, marketing,
                    content creation, dan berbagai kebutuhan UMKM lainnya.
                </p>
            </div>
        </section>

        {{-- FILTER --}}
        <section class="px-6 pb-8 md:px-10">
            <div class="mx-auto max-w-7xl">
                <form method="GET" action="{{ route('services') }}"
                      class="grid gap-5 lg:grid-cols-[1.2fr_0.8fr_0.7fr]">

                    {{-- Search --}}
                    <div class="flex items-center gap-3 h-[62px] rounded-2xl border border-[#DCE7FB] bg-white px-6 shadow-sm">
                        <svg class="h-5 w-5 text-slate-400 shrink-0" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/>
                        </svg>
                        <input type="search" name="q" value="{{ $q ?? '' }}"
                               placeholder="Search services..."
                               class="flex-1 bg-transparent text-sm text-slate-700 outline-none placeholder:text-slate-400">
                    </div>

                    {{-- Category --}}
                    <div class="relative">
                        <select name="kategori" onchange="this.form.submit()"
                                class="appearance-none h-[62px] w-full rounded-2xl border border-[#DCE7FB] bg-white px-6 pr-14 text-sm font-semibold outline-none transition focus:border-[#2563EB]">
                            <option value="">Semua Kategori</option>
                            @foreach(['Web Development','UI/UX Design','Desain Grafis','Fotografi','Videografi','Copywriting','Social Media','Mobile App','Digital Marketing','Content Creation','Admin Support'] as $opt)
                                <option value="{{ $opt }}" {{ ($kategori ?? '') === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                            @endforeach
                        </select>
                        <svg class="pointer-events-none absolute right-6 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-500"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6"/>
                        </svg>
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                            class="h-[62px] rounded-2xl bg-linear-to-r from-[#2563EB] to-[#1149C7] px-6 text-sm font-semibold text-white shadow-lg shadow-blue-500/20 transition hover:opacity-90">
                        Explore Services
                    </button>
                </form>
            </div>
        </section>

        {{-- SERVICE PROVIDERS --}}
        <section class="px-6 pb-20 md:px-10">
            <div class="mx-auto max-w-7xl">

                @if($mahasiswas->isEmpty())
                    <div class="flex flex-col items-center justify-center rounded-[2rem] bg-white border border-[#DCE7FB] py-20 text-center shadow-sm">
                        <svg class="h-14 w-14 text-slate-200 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <p class="text-slate-400 font-medium text-lg">Tidak ada mahasiswa ditemukan.</p>
                        @if($q || $kategori)
                            <a href="{{ route('services') }}"
                               class="mt-4 text-sm font-semibold text-[#2563EB] hover:underline">Reset pencarian</a>
                        @endif
                    </div>
                @else
                    <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-4">
                        @foreach($mahasiswas as $m)
                        @php
                            $skills     = $m->skills_array;
                            $firstName  = explode(' ', trim($m->nickname ?? $m->name))[0];
                            $initials   = strtoupper(substr($firstName, 0, 2));
                            $jobLabel   = $m->jurusan ?? ($skills[0] ?? 'Mahasiswa');
                            $minLayanan = $m->layanans->first();
                            $avg        = $m->avgRating();
                            $rCount     = $m->ratingCount();
                        @endphp
                        <div class="group rounded-[2rem] border border-[#DCE7FB] bg-white p-6 shadow-sm transition-all duration-300 hover:-translate-y-2 hover:shadow-xl flex flex-col">

                            {{-- Avatar + Name --}}
                            <div class="flex items-center gap-4">
                                @if($m->photo)
                                    <img src="{{ asset('storage/' . $m->photo) }}" alt="{{ $firstName }}"
                                         class="h-16 w-16 rounded-full object-cover shrink-0">
                                @else
                                    <div class="h-16 w-16 rounded-full bg-[#EAF2FF] flex items-center justify-center text-[#1846A3] font-bold text-xl shrink-0">
                                        {{ $initials }}
                                    </div>
                                @endif
                                <div class="min-w-0">
                                    <h3 class="text-2xl font-bold text-[#0F172A] truncate">{{ $firstName }}</h3>
                                    <p class="text-sm font-semibold text-[#2563EB] truncate">{{ $jobLabel }}</p>
                                </div>
                            </div>

                            {{-- Service Type Tags --}}
                            <div class="mt-6 flex flex-wrap gap-2 flex-1 content-start">
                                @forelse($m->layanans->pluck('kategori')->unique() as $kat)
                                    <span class="inline-flex items-center rounded-full bg-[#EAF2FF] px-3 py-1 text-xs font-semibold text-[#1846A3]">
                                        {{ $kat }}
                                    </span>
                                @empty
                                    <span class="text-sm text-slate-400">Belum ada layanan</span>
                                @endforelse
                            </div>

                            {{-- Rating --}}
                            @if($avg)
                                <div class="mt-4 flex items-center gap-1.5">
                                    <span class="text-yellow-400 text-sm leading-none">
                                        @for($i = 1; $i <= 5; $i++){{ $i <= round($avg) ? '★' : '☆' }}@endfor
                                    </span>
                                    <span class="text-sm font-bold text-slate-700">{{ number_format($avg, 1) }}</span>
                                    <span class="text-xs text-slate-400">({{ $rCount }})</span>
                                </div>
                            @endif

                            {{-- Price --}}
                            <div class="mt-6 flex items-end justify-between">
                                @if($minLayanan)
                                    <div class="text-4xl font-bold text-[#1846A3]">
                                        {{ $minLayanan->formatHarga() }}+
                                    </div>
                                    <p class="text-xs text-slate-400 mb-1">{{ $m->layanans->count() }} layanan</p>
                                @else
                                    <div class="text-base font-semibold text-slate-400">Belum ada layanan</div>
                                @endif
                            </div>

                            {{-- CTA --}}
                            @auth
                                <a href="{{ route('mahasiswa.profil', $m->id) }}"
                                   class="mt-6 inline-flex w-full items-center justify-center rounded-2xl bg-linear-to-r from-[#2563EB] to-[#1149C7] px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-500/20 transition hover:opacity-90">
                                    Lihat Detail
                                </a>
                            @else
                                <button onclick="openGuestModal()"
                                        class="mt-6 inline-flex w-full items-center justify-center rounded-2xl bg-linear-to-r from-[#2563EB] to-[#1149C7] px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-500/20 transition hover:opacity-90">
                                    Lihat Detail
                                </button>
                            @endauth

                        </div>
                        @endforeach
                    </div>

                    {{-- PAGINATION --}}
                    <div class="mt-16 flex items-center justify-center gap-4">
                        @if($mahasiswas->onFirstPage())
                            <span class="flex h-11 w-11 items-center justify-center rounded-xl border border-[#DCE7FB] bg-white text-slate-300 cursor-not-allowed">←</span>
                        @else
                            <a href="{{ $mahasiswas->previousPageUrl() }}"
                               class="flex h-11 w-11 items-center justify-center rounded-xl border border-[#DCE7FB] bg-white text-slate-500 hover:bg-[#EAF2FF] hover:text-[#1846A3] transition">←</a>
                        @endif

                        <div class="text-sm font-semibold text-[#64748B]">
                            Halaman {{ $mahasiswas->currentPage() }} dari {{ $mahasiswas->lastPage() }}
                        </div>

                        @if($mahasiswas->hasMorePages())
                            <a href="{{ $mahasiswas->nextPageUrl() }}"
                               class="flex h-11 w-11 items-center justify-center rounded-xl border border-[#DCE7FB] bg-white text-slate-500 hover:bg-[#EAF2FF] hover:text-[#1846A3] transition">→</a>
                        @else
                            <span class="flex h-11 w-11 items-center justify-center rounded-xl border border-[#DCE7FB] bg-white text-slate-300 cursor-not-allowed">→</span>
                        @endif
                    </div>
                @endif

                {{-- CTA --}}
                <section class="mt-24">
                    <div class="overflow-hidden rounded-[2.5rem] bg-linear-to-r from-[#2563EB] to-[#1149C7] p-10 text-white shadow-xl">
                        <div class="flex flex-col gap-10 lg:flex-row lg:items-center lg:justify-between">
                            <div>
                                <h2 class="text-5xl font-bold tracking-[-0.03em]">Butuh Bantuan?</h2>
                                <p class="mt-5 text-lg text-white/85">Langsung hubungi pihak customer support yuk!</p>
                            </div>
                            <button class="rounded-2xl bg-[#FFC928] px-10 py-5 text-base font-bold text-[#0F172A] shadow-lg transition hover:opacity-90">
                                Hubungi Kita
                            </button>
                        </div>
                    </div>
                </section>

            </div>
        </section>

    </main>

    @include('partials.footer')

    {{-- GUEST MODAL --}}
    @guest
    <div id="guestModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm p-4">
        <div class="w-full max-w-lg rounded-[2rem] bg-white p-10 shadow-2xl text-center">

            {{-- Icon --}}
            <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-[#EAF2FF]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#1846A3]" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>

            <h2 class="text-2xl font-bold text-[#0F172A] leading-tight">
                Bergabunglah dengan SkillNest!
            </h2>

            <p class="mt-4 text-sm leading-7 text-[#64748B]">
                Ingin mencari jasa yang terjangkau untuk bisnis Anda? Atau ingin menawarkan keahlianmu sebagai mahasiswa untuk mendapat uang tambahan sekaligus mempercantik portfolio? <br><br>
                <span class="font-semibold text-[#1846A3]">Daftarkan diri Anda sekarang juga di SkillNest</span> dan mulai perjalananmu bersama ribuan UMKM dan mahasiswa Indonesia!
            </p>

            <div class="mt-8 flex flex-col gap-3">
                <a href="{{ route('register') }}"
                   class="inline-flex w-full items-center justify-center rounded-2xl bg-linear-to-r from-[#2563EB] to-[#1149C7] px-6 py-4 text-sm font-bold text-white shadow-lg shadow-blue-500/20 transition hover:opacity-90">
                    Daftar Sekarang
                </a>
                <a href="{{ route('login') }}"
                   class="inline-flex w-full items-center justify-center rounded-2xl border border-[#DCE7FB] bg-white px-6 py-4 text-sm font-semibold text-[#1846A3] hover:bg-[#EAF2FF] transition">
                    Sudah punya akun? Masuk
                </a>
            </div>

            <button onclick="closeGuestModal()"
                    class="mt-4 text-xs text-slate-400 hover:text-slate-600 transition">
                Tutup
            </button>
        </div>
    </div>

    <script>
        function openGuestModal() {
            const m = document.getElementById('guestModal');
            m.classList.remove('hidden');
            m.classList.add('flex');
        }
        function closeGuestModal() {
            const m = document.getElementById('guestModal');
            m.classList.add('hidden');
            m.classList.remove('flex');
        }
        document.getElementById('guestModal').addEventListener('click', function(e) {
            if (e.target === this) closeGuestModal();
        });
    </script>
    @endguest

</body>
</html>
