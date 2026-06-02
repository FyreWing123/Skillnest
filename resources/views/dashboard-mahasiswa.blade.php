<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa - SkillNest</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#F6FAFF]">

<div class="min-h-screen flex">

    {{-- SIDEBAR --}}
    <aside class="w-72 bg-white border-r border-[#E2E8F0] p-6">

        {{-- LOGO --}}
        <div class="flex items-center gap-3 mb-10">

            <img
                src="{{ asset('images/skillnestlogo.png') }}"
                class="h-10"
                alt="SkillNest"
            >

            <span class="text-xl font-bold text-[#0F172A]">
                SkillNest
            </span>

        </div>

        {{-- MENU --}}
        <nav class="space-y-2">

            <a href="{{ route('dashboard.mahasiswa') }}"
                class="block rounded-xl bg-[#EAF2FF] px-4 py-3 font-semibold text-[#1846A3]">
                Dashboard
            </a>

            <a href="{{ route('profile.mahasiswa') }}"
                class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">
                Profil Saya
            </a>

            <a href="{{ route('portfolio.mahasiswa') }}"
                class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">
                Portfolio
            </a>

           <a href="{{ route('layanan.saya') }}"
            class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">
            Layanan Saya
           </a>

            <a href="{{ route('chat') }}"
                class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">
                Pesan
            </a>

            <a href="#"
                class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">
                Settings
            </a>

        </nav>

    </aside>



    {{-- CONTENT --}}
    <main class="flex-1 p-10">

        {{-- HEADER --}}
        <div class="flex items-center justify-between">

            <div>

                <h1 class="text-4xl font-bold text-[#0F172A]">
                    Halo, {{ auth()->user()->nickname ?? auth()->user()->name }} 👋
                </h1>

                <p class="mt-3 text-slate-500">
                    Selamat datang kembali di dashboard SkillNest.
                </p>

            </div>

            <a href="{{ route('layanan.create') }}"
                class="rounded-2xl bg-gradient-to-r from-[#2563EB] to-[#1149C7] px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-500/20">
                + Tambah Layanan
            </a>

        </div>



        {{-- STATS --}}
        <div class="mt-10 grid gap-6 md:grid-cols-2 xl:grid-cols-4">

            <div class="rounded-[2rem] bg-white p-6 shadow-sm">

                <p class="text-slate-500 text-sm">
                    Total Layanan
                </p>

                <h2 class="mt-3 text-4xl font-bold text-[#1846A3]">
                    3
                </h2>

            </div>

            <div class="rounded-[2rem] bg-white p-6 shadow-sm">

                <p class="text-slate-500 text-sm">
                    Portfolio
                </p>

                <h2 class="mt-3 text-4xl font-bold text-[#1846A3]">
                    6
                </h2>

            </div>

            <div class="rounded-[2rem] bg-white p-6 shadow-sm">

                <p class="text-slate-500 text-sm">
                    Review
                </p>

                <h2 class="mt-3 text-4xl font-bold text-[#1846A3]">
                    124
                </h2>

            </div>

            <div class="rounded-[2rem] bg-white p-6 shadow-sm">

                <p class="text-slate-500 text-sm">
                    Rating
                </p>

                <h2 class="mt-3 text-4xl font-bold text-[#F59E0B]">
                    ★ 4.9
                </h2>

            </div>

        </div>



        {{-- QUICK ACTION --}}
        <div class="mt-10 grid gap-6 lg:grid-cols-3">

            <a href="{{ route('layanan.create') }}"
                class="rounded-[2rem] bg-[#1846A3] p-8 text-white shadow-sm transition hover:scale-[1.02]">

                <h3 class="text-2xl font-bold">
                    + Tambah Layanan
                </h3>

                <p class="mt-3 text-white/80">
                    Buat layanan baru dan tampilkan di marketplace SkillNest.
                </p>

            </a>

            <a href="{{ route('portfolio.mahasiswa') }}"
                class="rounded-[2rem] bg-white p-8 shadow-sm transition hover:shadow-md">

                <h3 class="text-2xl font-bold text-[#0F172A]">
                    Portfolio Saya
                </h3>

                <p class="mt-3 text-slate-500">
                    Kelola hasil pekerjaan dan project yang pernah dibuat.
                </p>

            </a>

            <a href="{{ route('profile.mahasiswa') }}"
                class="rounded-[2rem] bg-white p-8 shadow-sm transition hover:shadow-md">

                <h3 class="text-2xl font-bold text-[#0F172A]">
                    Edit Profil
                </h3>

                <p class="mt-3 text-slate-500">
                    Perbarui informasi akun, skill, dan bio profesional.
                </p>

            </a>

        </div>



        {{-- LAYANAN AKTIF --}}
        <div class="mt-10 rounded-[2rem] bg-white p-8 shadow-sm">

            <h2 class="text-2xl font-bold text-[#0F172A]">
                Layanan Aktif
            </h2>

            <div class="mt-6">

                <div class="flex items-center justify-between border-b py-4">

                    <div>

                        <p class="font-semibold">
                            Landing Page UMKM
                        </p>

                        <p class="text-sm text-slate-500">
                            Web Development
                        </p>

                    </div>

                    <span class="font-bold text-[#1846A3]">
                        Rp500K
                    </span>

                </div>

                <div class="flex items-center justify-between border-b py-4">

                    <div>

                        <p class="font-semibold">
                            UI Design Website
                        </p>

                        <p class="text-sm text-slate-500">
                            UI/UX Design
                        </p>

                    </div>

                    <span class="font-bold text-[#1846A3]">
                        Rp750K
                    </span>

                </div>

                <div class="flex items-center justify-between py-4">

                    <div>

                        <p class="font-semibold">
                            Company Profile Website
                        </p>

                        <p class="text-sm text-slate-500">
                            Web Development
                        </p>

                    </div>

                    <span class="font-bold text-[#1846A3]">
                        Rp900K
                    </span>

                </div>

            </div>

        </div>



        {{-- PORTFOLIO TERBARU --}}
        <div class="mt-10 rounded-[2rem] bg-white p-8 shadow-sm">

            <div class="flex items-center justify-between">

                <h2 class="text-2xl font-bold text-[#0F172A]">
                    Portfolio Terbaru
                </h2>

                <a href="{{ route('portfolio.mahasiswa') }}"
                    class="text-sm font-semibold text-[#2563EB]">
                    Lihat Semua
                </a>

            </div>

            <div class="mt-6 grid gap-6 md:grid-cols-3">

                <img
                    src="https://placehold.co/600x400/2563EB/FFFFFF?text=Landing+Page"
                    class="rounded-2xl"
                    alt=""
                >

                <img
                    src="https://placehold.co/600x400/F59E0B/FFFFFF?text=Dashboard"
                    class="rounded-2xl"
                    alt=""
                >

                <img
                    src="https://placehold.co/600x400/0F172A/FFFFFF?text=Company+Profile"
                    class="rounded-2xl"
                    alt=""
                >

            </div>

        </div>

    </main>

</div>

</body>
</html>