<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan Saya - SkillNest</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#F6FAFF]">

<div class="min-h-screen flex">

    {{-- SIDEBAR --}}
    <aside class="w-72 bg-white border-r border-[#E2E8F0] p-6 shrink-0">

        <div class="flex items-center gap-3 mb-10">
            <img src="{{ asset('images/skillnestlogo.png') }}" alt="SkillNest" class="h-10">
            <span class="text-xl font-bold text-[#0F172A]">SkillNest</span>
        </div>

        <nav class="space-y-2">
            <a href="{{ route('dashboard.mahasiswa') }}" class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Dashboard</a>
            <a href="{{ route('profile.mahasiswa') }}" class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Profil Saya</a>
            <a href="{{ route('portfolio.mahasiswa') }}" class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Portfolio</a>
            <a href="{{ route('layanan.saya') }}" class="block rounded-xl bg-[#EAF2FF] px-4 py-3 font-semibold text-[#1846A3]">Layanan Saya</a>
            <a href="{{ route('chat') }}" class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Pesan</a>
            <a href="#" class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Settings</a>
        </nav>

    </aside>

    {{-- CONTENT --}}
    <main class="flex-1 p-10">

        {{-- HEADER --}}
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-bold text-[#0F172A]">Layanan Saya</h1>
                <p class="mt-2 text-slate-500">Kelola seluruh layanan yang akan tampil pada marketplace SkillNest.</p>
            </div>
            <a href="{{ route('layanan.create') }}"
               class="rounded-2xl bg-gradient-to-r from-[#2563EB] to-[#1149C7] px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-500/20">
                + Tambah Layanan
            </a>
        </div>

        {{-- CARDS --}}
        <div class="mt-10 grid gap-8 lg:grid-cols-2">

            {{-- Card 1 --}}
            <div class="rounded-[2rem] border border-[#DCE7FB] bg-white p-8 shadow-sm">
                <div class="flex items-start justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-[#0F172A]">Landing Page UMKM</h2>
                        <p class="mt-2 font-semibold text-[#2563EB]">Web Development</p>
                    </div>
                    <span class="rounded-xl bg-[#EAF2FF] px-4 py-2 text-sm font-bold text-[#1846A3]">Aktif</span>
                </div>
                <p class="mt-6 text-[#64748B] leading-7">
                    Landing page profesional untuk UMKM, bisnis lokal, company profile, dan promosi digital.
                </p>
                <div class="mt-8 flex items-center justify-between">
                    <div>
                        <p class="text-sm text-[#64748B]">Harga Mulai</p>
                        <h3 class="text-3xl font-bold text-[#1846A3]">Rp500K</h3>
                    </div>
                    <div>
                        <p class="text-sm text-[#64748B]">Estimasi</p>
                        <h3 class="text-lg font-bold text-[#0F172A]">3 Hari</h3>
                    </div>
                </div>
                <div class="mt-8 flex gap-3">
                    <a href="#" class="rounded-xl bg-[#EAF2FF] px-5 py-3 text-sm font-semibold text-[#1846A3]">Edit</a>
                    <button class="rounded-xl bg-red-50 px-5 py-3 text-sm font-semibold text-red-600">Hapus</button>
                </div>
            </div>

            {{-- Card 2 --}}
            <div class="rounded-[2rem] border border-[#DCE7FB] bg-white p-8 shadow-sm">
                <div class="flex items-start justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-[#0F172A]">Desain Feed Instagram</h2>
                        <p class="mt-2 font-semibold text-[#2563EB]">Desain Grafis</p>
                    </div>
                    <span class="rounded-xl bg-[#EAF2FF] px-4 py-2 text-sm font-bold text-[#1846A3]">Aktif</span>
                </div>
                <p class="mt-6 text-[#64748B] leading-7">
                    Desain feed profesional untuk meningkatkan branding dan engagement.
                </p>
                <div class="mt-8 flex items-center justify-between">
                    <div>
                        <p class="text-sm text-[#64748B]">Harga Mulai</p>
                        <h3 class="text-3xl font-bold text-[#1846A3]">Rp150K</h3>
                    </div>
                    <div>
                        <p class="text-sm text-[#64748B]">Estimasi</p>
                        <h3 class="text-lg font-bold text-[#0F172A]">2 Hari</h3>
                    </div>
                </div>
                <div class="mt-8 flex gap-3">
                    <a href="#" class="rounded-xl bg-[#EAF2FF] px-5 py-3 text-sm font-semibold text-[#1846A3]">Edit</a>
                    <button class="rounded-xl bg-red-50 px-5 py-3 text-sm font-semibold text-red-600">Hapus</button>
                </div>
            </div>

        </div>

    </main>

</div>

</body>
</html>
