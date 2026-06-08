<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya - SkillNest</title>
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
            <a href="{{ route('dashboard.umkm') }}" class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Dashboard</a>
            <a href="{{ route('profile.umkm') }}" class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Profil UMKM</a>
            <a href="{{ route('cari.mahasiswa') }}" class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Cari Mahasiswa</a>
            <a href="{{ route('pesanan.umkm') }}" class="block rounded-xl bg-[#EAF2FF] px-4 py-3 font-semibold text-[#1846A3]">Pesanan Saya</a>
            <a href="{{ route('favorit.umkm') }}" class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Favorit</a>
            <a href="{{ route('chat') }}" class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Pesan</a>
        </nav>
    </aside>

    {{-- CONTENT --}}
    <main class="flex-1 p-10">
        <h1 class="text-4xl font-bold text-[#0F172A]">Pesanan Saya</h1>
        <p class="mt-3 text-slate-500">Pantau semua pesanan dan status pengerjaannya.</p>

        {{-- TABS --}}
        <div class="mt-8 flex gap-2">
            <button class="rounded-xl bg-[#1846A3] px-5 py-2 text-sm font-semibold text-white">Semua</button>
            <button class="rounded-xl border border-[#D9E5F7] bg-white px-5 py-2 text-sm font-semibold text-slate-600 hover:bg-[#EAF2FF] transition">Dalam Proses</button>
            <button class="rounded-xl border border-[#D9E5F7] bg-white px-5 py-2 text-sm font-semibold text-slate-600 hover:bg-[#EAF2FF] transition">Menunggu</button>
            <button class="rounded-xl border border-[#D9E5F7] bg-white px-5 py-2 text-sm font-semibold text-slate-600 hover:bg-[#EAF2FF] transition">Selesai</button>
        </div>

        {{-- TABLE --}}
        <div class="mt-6 rounded-4xl bg-white shadow-sm overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-[#F8FAFF] border-b border-[#E2E8F0]">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold text-slate-500">Mahasiswa</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-500">Layanan</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-500">Tanggal</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-500">Harga</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-500">Status</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-500">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#F1F5F9]">
                    <tr class="hover:bg-[#FAFCFF]">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="h-9 w-9 rounded-full bg-[#EAF2FF] flex items-center justify-center text-[#1846A3] font-bold text-xs">BW</div>
                                <span class="font-semibold text-[#0F172A]">Budi Wicaksono</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-slate-600">Landing Page UMKM</td>
                        <td class="px-6 py-4 text-slate-500">12 Mei 2026</td>
                        <td class="px-6 py-4 font-semibold text-[#1846A3]">Rp500K</td>
                        <td class="px-6 py-4"><span class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">Dalam Proses</span></td>
                        <td class="px-6 py-4"><a href="{{ route('chat') }}" class="text-xs font-semibold text-[#2563EB]">Chat</a></td>
                    </tr>
                    <tr class="hover:bg-[#FAFCFF]">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="h-9 w-9 rounded-full bg-[#EAF2FF] flex items-center justify-center text-[#1846A3] font-bold text-xs">AR</div>
                                <span class="font-semibold text-[#0F172A]">Anisa Rahmawati</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-slate-600">Desain Logo & Branding</td>
                        <td class="px-6 py-4 text-slate-500">8 Mei 2026</td>
                        <td class="px-6 py-4 font-semibold text-[#1846A3]">Rp400K</td>
                        <td class="px-6 py-4"><span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">Menunggu</span></td>
                        <td class="px-6 py-4"><a href="{{ route('chat') }}" class="text-xs font-semibold text-[#2563EB]">Chat</a></td>
                    </tr>
                    <tr class="hover:bg-[#FAFCFF]">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="h-9 w-9 rounded-full bg-[#EAF2FF] flex items-center justify-center text-[#1846A3] font-bold text-xs">DP</div>
                                <span class="font-semibold text-[#0F172A]">Dimas Pratama</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-slate-600">Foto Produk</td>
                        <td class="px-6 py-4 text-slate-500">1 Mei 2026</td>
                        <td class="px-6 py-4 font-semibold text-[#1846A3]">Rp350K</td>
                        <td class="px-6 py-4"><span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">Selesai</span></td>
                        <td class="px-6 py-4"><a href="#" class="text-xs font-semibold text-[#2563EB]">Beri Review</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
</div>
</body>
</html>