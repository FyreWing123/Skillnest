<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Mahasiswa - SkillNest</title>
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
                class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Dashboard</a>
            <a href="{{ route('profile.umkm') }}"
                class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Profil UMKM</a>
            <a href="{{ route('cari.mahasiswa') }}"
                class="block rounded-xl bg-[#EAF2FF] px-4 py-3 font-semibold text-[#1846A3]">Cari Mahasiswa</a>
            <a href="{{ route('pesanan.umkm') }}"
                class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Pesanan Saya</a>
            <a href="{{ route('favorit.umkm') }}"
                class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Favorit</a>
            <a href="{{ route('chat') }}"
                class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Pesan</a>
        </nav>
    </aside>

    {{-- CONTENT --}}
    <main class="flex-1 p-10">
        <h1 class="text-4xl font-bold text-[#0F172A]">Cari Mahasiswa</h1>
        <p class="mt-3 text-slate-500">Temukan mahasiswa berbakat sesuai kebutuhan bisnismu.</p>

        {{-- SEARCH & FILTER --}}
        <div class="mt-8 flex flex-wrap gap-4">
            <div class="flex flex-1 min-w-[240px] items-center gap-3 rounded-2xl border border-[#D9E5F7] bg-white px-5 py-3 shadow-sm">
                <svg class="h-5 w-5 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/>
                </svg>
                <input type="search" placeholder="Cari nama atau keahlian..."
                    class="flex-1 bg-transparent text-sm text-slate-700 outline-none placeholder:text-slate-400">
            </div>
            <select class="rounded-2xl border border-[#D9E5F7] bg-white px-5 py-3 text-sm text-slate-700 outline-none shadow-sm">
                <option>Semua Kategori</option>
                <option>Web Development</option>
                <option>UI/UX Design</option>
                <option>Fotografi</option>
                <option>Videografi</option>
                <option>Copywriting</option>
                <option>Social Media</option>
            </select>
            <select class="rounded-2xl border border-[#D9E5F7] bg-white px-5 py-3 text-sm text-slate-700 outline-none shadow-sm">
                <option>Semua Rating</option>
                <option>★ 4.5 ke atas</option>
                <option>★ 4.0 ke atas</option>
            </select>
        </div>

        {{-- GRID MAHASISWA --}}
        <div class="mt-8 grid gap-6 md:grid-cols-2 xl:grid-cols-3">

            @php
            $mahasiswa = [
                ['inisial' => 'BW', 'nama' => 'Budi Wicaksono', 'keahlian' => 'Web Development', 'rating' => '4.9', 'layanan' => 3, 'harga' => 'Rp500K', 'tags' => ['Laravel', 'React', 'UI/UX']],
                ['inisial' => 'AR', 'nama' => 'Anisa Rahmawati', 'keahlian' => 'UI/UX Design', 'rating' => '4.8', 'layanan' => 5, 'harga' => 'Rp400K', 'tags' => ['Figma', 'Branding', 'Logo']],
                ['inisial' => 'DP', 'nama' => 'Dimas Pratama', 'keahlian' => 'Fotografi', 'rating' => '4.7', 'layanan' => 4, 'harga' => 'Rp350K', 'tags' => ['Foto Produk', 'Editing', 'Drone']],
                ['inisial' => 'NS', 'nama' => 'Nadia Sari', 'keahlian' => 'Copywriting', 'rating' => '4.9', 'layanan' => 6, 'harga' => 'Rp250K', 'tags' => ['SEO', 'Artikel', 'Caption']],
                ['inisial' => 'RH', 'nama' => 'Rizky Hidayat', 'keahlian' => 'Videografi', 'rating' => '4.6', 'layanan' => 2, 'harga' => 'Rp600K', 'tags' => ['Video Iklan', 'Editing', 'Motion']],
                ['inisial' => 'LF', 'nama' => 'Laila Fitriani', 'keahlian' => 'Social Media', 'rating' => '4.8', 'layanan' => 4, 'harga' => 'Rp300K', 'tags' => ['Instagram', 'TikTok', 'Konten']],
            ];
            @endphp

            @foreach($mahasiswa as $m)
            <div class="rounded-[2rem] bg-white p-6 shadow-sm hover:shadow-md transition">
                <div class="flex items-start justify-between">
                    <div class="flex items-center gap-4">
                        <div class="h-14 w-14 rounded-full bg-[#EAF2FF] flex items-center justify-center text-[#1846A3] font-bold text-lg">
                            {{ $m['inisial'] }}
                        </div>
                        <div>
                            <p class="font-semibold text-[#0F172A]">{{ $m['nama'] }}</p>
                            <p class="text-sm text-slate-500">{{ $m['keahlian'] }}</p>
                        </div>
                    </div>
                    <span class="text-sm font-semibold text-[#F59E0B]">★ {{ $m['rating'] }}</span>
                </div>

                <div class="mt-4 flex flex-wrap gap-2">
                    @foreach($m['tags'] as $tag)
                    <span class="rounded-full bg-[#EAF2FF] px-3 py-1 text-xs font-semibold text-[#1846A3]">{{ $tag }}</span>
                    @endforeach
                </div>

                <div class="mt-4 flex items-center justify-between border-t border-[#F1F5F9] pt-4">
                    <div>
                        <p class="text-xs text-slate-400">Mulai dari</p>
                        <p class="font-bold text-[#1846A3]">{{ $m['harga'] }}</p>
                    </div>
                    <div class="flex gap-2">
                        <button class="rounded-xl border border-[#D9E5F7] p-2 text-slate-400 hover:text-[#F59E0B] hover:border-[#F59E0B] transition" title="Simpan favorit">
                            ♡
                        </button>
                        <a href="#" class="rounded-xl bg-[#1846A3] px-4 py-2 text-xs font-semibold text-white hover:bg-[#2563EB] transition">
                            Lihat Profil
                        </a>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </main>
</div>
</body>
</html>