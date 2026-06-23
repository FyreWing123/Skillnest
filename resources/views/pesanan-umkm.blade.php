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
                    $rating = $p->rating;
                @endphp
                <div class="rounded-4xl bg-white border border-[#DCE7FB] p-6 shadow-sm hover:shadow-md transition">
                    <div class="flex flex-col md:flex-row md:items-center gap-5">

                        {{-- Mahasiswa info --}}
                        <div class="flex items-center gap-4 flex-1 min-w-0">
                            @if($mahasiswa->photo)
                                <img src="{{ asset('storage/' . $mahasiswa->photo) }}" alt="{{ $mName }}"
                                     class="h-12 w-12 rounded-full object-cover shrink-0">
                            @else
                                <div class="h-12 w-12 rounded-full bg-[#EAF2FF] flex items-center justify-center text-[#1846A3] font-bold text-sm shrink-0">
                                    {{ $mInit }}
                                </div>
                            @endif
                            <div class="min-w-0">
                                <p class="font-bold text-[#0F172A]">{{ $mName }}</p>
                                <p class="text-sm font-semibold text-slate-600 truncate">{{ $p->layanan->nama }}</p>
                                <p class="text-xs text-slate-400 mt-0.5">{{ $p->layanan->kategori }} &bull; {{ $p->layanan->formatHarga() }}</p>
                                @if($p->pesan)
                                    <p class="mt-1.5 text-xs text-slate-500 italic line-clamp-1">"{{ $p->pesan }}"</p>
                                @endif
                                {{-- Tampilkan rating yang sudah diberikan --}}
                                @if($rating)
                                    <div class="mt-2 flex items-center gap-1.5 flex-wrap">
                                        <span class="flex text-yellow-400 text-sm leading-none">
                                            @for($i = 1; $i <= 5; $i++)
                                                {{ $i <= $rating->stars ? '★' : '☆' }}
                                            @endfor
                                        </span>
                                        <span class="text-xs text-slate-400">Rating kamu · {{ $rating->created_at->format('d M Y') }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- Date, status, action --}}
                        <div class="flex flex-col items-start md:items-end gap-2 shrink-0">
                            <p class="text-xs text-slate-400">{{ $p->created_at->format('d M Y, H:i') }}</p>
                            <span class="rounded-lg px-3 py-1 text-xs font-bold {{ $p->statusColor() }}">
                                {{ $p->statusLabel() }}
                            </span>
                            <div class="flex gap-2 mt-1 items-center flex-wrap justify-end">
                                <a href="{{ route('mahasiswa.profil', $mahasiswa->id) }}"
                                   class="rounded-lg border border-[#D9E5F7] px-3 py-1.5 text-xs font-semibold text-slate-600 hover:bg-slate-50 transition">
                                    Lihat Profil
                                </a>
                                <a href="{{ route('chat.start', $mahasiswa->id) }}"
                                   class="rounded-lg bg-[#1846A3] px-3 py-1.5 text-xs font-semibold text-white hover:bg-[#2563EB] transition">
                                    Chat
                                </a>
                                @if($p->status === 'selesai')
                                    @if(!$rating)
                                        <button onclick="openRatingModal({{ $p->id }}, '{{ addslashes($mName) }}', '{{ route('rating.store', $p->id) }}')"
                                                class="rounded-lg bg-yellow-400 hover:bg-yellow-500 px-3 py-1.5 text-xs font-bold text-white transition flex items-center gap-1">
                                            <span>★</span> Beri Rating
                                        </button>
                                    @endif
                                    <button onclick="openOrderModal({{ $p->layanan->id }}, '{{ addslashes($p->layanan->nama) }}', '{{ $p->layanan->formatHarga() }}')"
                                            class="rounded-lg border border-[#1846A3] px-3 py-1.5 text-xs font-semibold text-[#1846A3] hover:bg-[#EAF2FF] transition">
                                        Pesan Lagi
                                    </button>
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

{{-- MODAL PESAN LAGI --}}
<div id="orderModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm p-4">
    <div class="w-full max-w-md rounded-4xl bg-white p-8 shadow-2xl">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-[#0F172A]">Pesan Lagi</h2>
            <button onclick="closeOrderModal()" class="text-slate-400 hover:text-slate-600 text-2xl leading-none">&times;</button>
        </div>
        <div class="rounded-2xl bg-[#F6FAFF] border border-[#DCE7FB] p-4 mb-6">
            <p class="text-xs text-slate-400 font-semibold uppercase tracking-wide mb-1">Layanan Dipilih</p>
            <p id="orderLayananNama" class="font-bold text-[#0F172A]"></p>
            <p id="orderLayananHarga" class="text-sm font-semibold text-[#1846A3] mt-0.5"></p>
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

{{-- MODAL RATING --}}
<div id="rating-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 backdrop-blur-sm p-4">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md overflow-hidden">

        <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h3 class="text-lg font-bold text-[#0F172A]">Beri Rating</h3>
                <p id="rating-subtitle" class="text-sm text-slate-400 mt-0.5"></p>
            </div>
            <button type="button" onclick="closeRatingModal()"
                class="flex h-8 w-8 items-center justify-center rounded-full text-slate-400 hover:bg-slate-100 transition text-xl leading-none">×</button>
        </div>

        <form id="rating-form" method="POST" class="px-6 py-6 space-y-5">
            @csrf

            {{-- Bintang interaktif --}}
            <div class="flex flex-col items-center gap-2">
                <p class="text-sm font-semibold text-slate-600">Seberapa puas kamu dengan layanannya?</p>
                <div class="flex gap-2 mt-1" id="star-row">
                    @for($i = 1; $i <= 5; $i++)
                        <button type="button"
                            data-value="{{ $i }}"
                            onclick="selectStar({{ $i }})"
                            onmouseover="hoverStar({{ $i }})"
                            onmouseout="resetHover()"
                            class="star-btn text-4xl text-slate-300 transition-colors duration-100 leading-none select-none">★</button>
                    @endfor
                </div>
                <p id="star-label" class="text-sm font-semibold text-slate-400 h-5"></p>
                <input type="hidden" name="stars" id="stars-input" value="">
            </div>

            {{-- Ulasan opsional --}}
            <div>
                <label class="mb-1.5 block text-sm font-semibold text-slate-700">
                    Ulasan <span class="font-normal text-slate-400">(opsional)</span>
                </label>
                <textarea name="ulasan" rows="3" maxlength="500"
                    placeholder="Ceritakan pengalamanmu bekerja sama dengan mahasiswa ini..."
                    class="w-full rounded-2xl border border-[#D9E5F7] bg-[#F9FBFF] px-4 py-3 text-sm outline-none focus:border-[#2563EB] resize-none"></textarea>
            </div>

            <div class="flex gap-3 pt-1">
                <button type="button" onclick="closeRatingModal()"
                    class="flex-1 rounded-2xl border border-slate-200 py-3 text-sm font-semibold text-slate-600 hover:bg-slate-50 transition">
                    Batal
                </button>
                <button type="submit" id="rating-submit"
                    disabled
                    class="flex-1 rounded-2xl bg-yellow-400 py-3 text-sm font-bold text-white transition disabled:opacity-40 disabled:cursor-not-allowed hover:bg-yellow-500">
                    Kirim Rating
                </button>
            </div>
        </form>

    </div>
</div>

<script>
const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

// ── Order modal ───────────────────────────────────────────
const pesanBaseUrl = '{{ url('/pesan') }}';

function openOrderModal(layananId, nama, harga) {
    document.getElementById('orderLayananNama').textContent = nama;
    document.getElementById('orderLayananHarga').textContent = harga;
    document.getElementById('orderForm').action = pesanBaseUrl + '/' + layananId;
    const modal = document.getElementById('orderModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeOrderModal() {
    const modal = document.getElementById('orderModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

document.getElementById('orderModal').addEventListener('click', function(e) {
    if (e.target === this) closeOrderModal();
});

// ── Rating modal ──────────────────────────────────────────
const STAR_LABELS = ['', 'Buruk', 'Kurang memuaskan', 'Cukup', 'Bagus', 'Sangat bagus!'];
let selectedStar = 0;

function openRatingModal(pesananId, mName, actionUrl) {
    selectedStar = 0;
    document.getElementById('stars-input').value = '';
    document.getElementById('rating-submit').disabled = true;
    document.getElementById('star-label').textContent = '';
    document.getElementById('rating-subtitle').textContent = 'Beri rating untuk ' + mName;
    document.getElementById('rating-form').action = actionUrl;
    document.querySelectorAll('.star-btn').forEach(b => b.style.color = '#d1d5db');
    document.querySelector('textarea[name="ulasan"]').value = '';
    document.getElementById('rating-modal').classList.remove('hidden');
    document.getElementById('rating-modal').classList.add('flex');
}

function closeRatingModal() {
    document.getElementById('rating-modal').classList.add('hidden');
    document.getElementById('rating-modal').classList.remove('flex');
}

function paintStars(upTo, color) {
    document.querySelectorAll('.star-btn').forEach(b => {
        b.style.color = parseInt(b.dataset.value) <= upTo ? color : '#d1d5db';
    });
}

function hoverStar(n) { paintStars(n, '#facc15'); }

function resetHover() {
    paintStars(selectedStar, '#f59e0b');
    if (selectedStar === 0) paintStars(0, '#d1d5db');
}

function selectStar(n) {
    selectedStar = n;
    paintStars(n, '#f59e0b');
    document.getElementById('stars-input').value = n;
    document.getElementById('star-label').textContent = STAR_LABELS[n];
    document.getElementById('rating-submit').disabled = false;
}

document.getElementById('rating-modal').addEventListener('click', function (e) {
    if (e.target === this) closeRatingModal();
});

// ── Favorit ───────────────────────────────────────────────
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
