<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorit - SkillNest</title>
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
            <a href="{{ route('pesanan.umkm') }}" class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Pesanan Saya</a>
            <a href="{{ route('favorit.umkm') }}" class="block rounded-xl bg-[#EAF2FF] px-4 py-3 font-semibold text-[#1846A3]">Favorit</a>
            <a href="{{ route('chat') }}" class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Pesan</a>
        </nav>
    </aside>

    {{-- CONTENT --}}
    <main class="flex-1 p-10 overflow-y-auto">

        <div class="flex items-center justify-between mb-2">
            <h1 class="text-4xl font-bold text-[#0F172A]">Favorit</h1>
            <span class="rounded-xl bg-[#EAF2FF] px-4 py-2 text-sm font-semibold text-[#1846A3]">
                {{ $favorits->count() }} mahasiswa
            </span>
        </div>
        <p class="text-slate-500 mb-8">Mahasiswa berbakat yang kamu simpan.</p>

        @if($favorits->isEmpty())
            <div class="flex flex-col items-center justify-center rounded-4xl bg-white border border-[#DCE7FB] py-20 text-center shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 text-slate-200 mb-4" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
                <p class="text-slate-400 font-medium">Belum ada mahasiswa yang difavoritkan.</p>
                <p class="text-slate-400 text-sm mt-1">
                    Tekan ikon <span class="text-red-400">♥</span> di kartu mahasiswa untuk menyimpannya ke sini.
                </p>
                <a href="{{ route('cari.mahasiswa') }}"
                   class="mt-5 inline-block rounded-xl bg-[#1846A3] px-6 py-3 text-sm font-semibold text-white hover:bg-[#2563EB] transition">
                    Cari Mahasiswa
                </a>
            </div>
        @else
            <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                @foreach($favorits as $fav)
                @php
                    $m          = $fav->mahasiswa;
                    $skills     = $m->skills_array;
                    $firstName  = explode(' ', trim($m->nickname ?? $m->name))[0];
                    $initial    = strtoupper(substr($firstName, 0, 2));
                    $keahlian   = $m->jurusan ?? ($skills[0] ?? 'Mahasiswa');
                    $minLayanan = $m->layanans->first();
                @endphp
                <div class="rounded-4xl bg-white p-6 shadow-sm border border-[#DCE7FB] hover:shadow-md transition flex flex-col">

                    {{-- Header --}}
                    <div class="flex items-start justify-between">
                        <div class="flex items-center gap-4">
                            @if($m->photo)
                                <img src="{{ asset('storage/' . $m->photo) }}" alt="{{ $firstName }}"
                                     class="h-14 w-14 rounded-full object-cover shrink-0">
                            @else
                                <div class="h-14 w-14 rounded-full bg-[#EAF2FF] flex items-center justify-center text-[#1846A3] font-bold text-lg shrink-0">
                                    {{ $initial }}
                                </div>
                            @endif
                            <div class="min-w-0">
                                <p class="font-bold text-[#0F172A] truncate">{{ $firstName }}</p>
                                <p class="text-sm text-slate-500">{{ $keahlian }}</p>
                                @if($m->universitas)
                                    <p class="text-xs text-slate-400 mt-0.5 truncate">{{ $m->universitas }}</p>
                                @endif
                            </div>
                        </div>
                        {{-- Tombol hapus favorit --}}
                        <button onclick="toggleFavorit(this, {{ $m->id }})"
                                data-fav="1"
                                title="Hapus dari Favorit"
                                class="flex items-center justify-center h-8 w-8 rounded-xl border border-red-100 bg-red-50 hover:bg-red-100 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 pointer-events-none"
                                 viewBox="0 0 24 24" fill="#EF4444" stroke="#EF4444" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </button>
                    </div>

                    {{-- Bio --}}
                    @if($m->bio)
                        <p class="mt-3 text-xs text-slate-500 line-clamp-2 leading-5">{{ $m->bio }}</p>
                    @endif

                    {{-- Skills --}}
                    @if(count($skills) > 0)
                        <div class="mt-4 flex flex-wrap gap-2">
                            @foreach(array_slice($skills, 0, 4) as $skill)
                                <span class="rounded-full bg-[#EAF2FF] px-3 py-1 text-xs font-semibold text-[#1846A3]">
                                    {{ $skill }}
                                </span>
                            @endforeach
                            @if(count($skills) > 4)
                                <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-400">
                                    +{{ count($skills) - 4 }}
                                </span>
                            @endif
                        </div>
                    @endif

                    {{-- Footer --}}
                    <div class="mt-auto pt-4 mt-4 flex items-center justify-between border-t border-[#F1F5F9]">
                        <div>
                            @if($minLayanan)
                                <p class="text-xs text-slate-400">Mulai dari</p>
                                <p class="font-bold text-[#1846A3]">{{ $minLayanan->formatHarga() }}</p>
                            @else
                                <p class="text-xs text-slate-400 italic">Belum ada layanan</p>
                            @endif
                        </div>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('mahasiswa.profil', $m->id) }}"
                               class="rounded-xl border border-[#1846A3] px-4 py-2 text-xs font-semibold text-[#1846A3] hover:bg-[#EAF2FF] transition">
                                Lihat Profil
                            </a>
                            <a href="{{ route('chat.start', $m->id) }}"
                               class="rounded-xl bg-[#1846A3] px-4 py-2 text-xs font-semibold text-white hover:bg-[#2563EB] transition">
                                Hubungi
                            </a>
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
    if (!data.favorited) {
        // Hilangkan kartu dari halaman favorit
        const card = btn.closest('.rounded-4xl');
        card.style.transition = 'opacity 0.3s';
        card.style.opacity = '0';
        setTimeout(() => card.remove(), 300);
    }
}
</script>

</body>
</html>
