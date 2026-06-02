<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio Mahasiswa - SkillNest</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#F6FAFF]">

<div class="min-h-screen flex">

    {{-- SIDEBAR --}}
    <aside class="w-72 bg-white border-r border-[#E2E8F0] p-6">

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

        <nav class="space-y-2">

            <a href="{{ route('dashboard.mahasiswa') }}"
                class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">
                Dashboard
            </a>

            <a href="{{ route('profile.mahasiswa') }}"
                class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">
                Profil Saya
            </a>

            <a href="{{ route('portfolio.mahasiswa') }}"
                class="block rounded-xl bg-[#EAF2FF] px-4 py-3 font-semibold text-[#1846A3]">
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
        <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">

            <div>
                <h1 class="text-4xl font-bold text-[#0F172A]">
                    Portfolio Saya
                </h1>

                <p class="mt-2 text-slate-500">
                    Tampilkan hasil pekerjaan terbaikmu agar lebih dipercaya UMKM.
                </p>
            </div>

            <button
                class="rounded-2xl bg-gradient-to-r from-[#2563EB] to-[#1149C7] px-6 py-4 text-sm font-semibold text-white shadow-lg shadow-blue-500/20"
            >
                + Tambah Portfolio
            </button>

        </div>





        {{-- STATS --}}
        <div class="mt-8 grid gap-6 md:grid-cols-3">

            <div class="rounded-[2rem] bg-white p-6 shadow-sm">
                <p class="text-sm text-slate-500">
                    Total Project
                </p>

                <h2 class="mt-3 text-4xl font-bold text-[#1846A3]">
                    6
                </h2>
            </div>

            <div class="rounded-[2rem] bg-white p-6 shadow-sm">
                <p class="text-sm text-slate-500">
                    Total Views
                </p>

                <h2 class="mt-3 text-4xl font-bold text-[#1846A3]">
                    342
                </h2>
            </div>

            <div class="rounded-[2rem] bg-white p-6 shadow-sm">
                <p class="text-sm text-slate-500">
                    Total Likes
                </p>

                <h2 class="mt-3 text-4xl font-bold text-[#F59E0B]">
                    128
                </h2>
            </div>

        </div>





        {{-- PORTFOLIO GRID --}}
        <div class="mt-10 grid gap-8 md:grid-cols-2 xl:grid-cols-3">

            @php
                $portfolios = [
                    [
                        'title' => 'Landing Page UMKM',
                        'image' => 'https://placehold.co/500x320/2563EB/FFFFFF?text=Landing+Page'
                    ],
                    [
                        'title' => 'Dashboard Admin',
                        'image' => 'https://placehold.co/500x320/0F172A/FFFFFF?text=Dashboard'
                    ],
                    [
                        'title' => 'Website Company',
                        'image' => 'https://placehold.co/500x320/F59E0B/FFFFFF?text=Company+Profile'
                    ],
                    [
                        'title' => 'UI Design Mobile App',
                        'image' => 'https://placehold.co/500x320/9333EA/FFFFFF?text=Mobile+UI'
                    ],
                    [
                        'title' => 'Coffee Shop Website',
                        'image' => 'https://placehold.co/500x320/10B981/FFFFFF?text=Coffee+Shop'
                    ],
                    [
                        'title' => 'E-Commerce Design',
                        'image' => 'https://placehold.co/500x320/EF4444/FFFFFF?text=E-Commerce'
                    ],
                ];
            @endphp

            @foreach($portfolios as $portfolio)

            <div class="overflow-hidden rounded-[2rem] bg-white shadow-sm transition hover:-translate-y-2 hover:shadow-xl">

                <div class="overflow-hidden">

                    <img
                        src="{{ $portfolio['image'] }}"
                        alt="{{ $portfolio['title'] }}"
                        class="h-56 w-full object-cover transition duration-300 hover:scale-105"
                    >

                </div>

                <div class="p-6">

                    <h3 class="text-xl font-bold text-[#0F172A]">
                        {{ $portfolio['title'] }}
                    </h3>

                    <p class="mt-2 text-sm text-slate-500">
                        Project yang pernah dikerjakan untuk client.
                    </p>

                    <div class="mt-6 flex gap-3">

                        <button
                            class="flex-1 rounded-xl border border-[#DCE7FB] py-3 text-sm font-semibold text-[#1846A3] hover:bg-[#F8FAFF]"
                        >
                            Edit
                        </button>

                        <button
                            class="flex-1 rounded-xl bg-red-50 py-3 text-sm font-semibold text-red-500 hover:bg-red-100"
                        >
                            Delete
                        </button>

                    </div>

                </div>

            </div>

            @endforeach

        </div>

    </main>

</div>

</body>
</html>