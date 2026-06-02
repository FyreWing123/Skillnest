<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SkillNest</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#F6FAFF] min-h-screen flex items-center justify-center">

    <div class="text-center max-w-md px-6">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="inline-flex items-center gap-3 mb-10">
            <img
                src="{{ asset('images/skillnestlogo.png') }}"
                class="h-12"
                alt="SkillNest"
            >
            <span class="text-2xl font-bold text-[#0F172A]">SkillNest</span>
        </a>

        {{-- Illustration --}}
        <div class="mx-auto mb-8 flex h-24 w-24 items-center justify-center rounded-full bg-[#EAF2FF]">
            <svg class="h-12 w-12 text-[#2563EB]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
        </div>

        <h1 class="text-2xl font-bold text-[#0F172A]">
            Halo, {{ auth()->user()->name }}!
        </h1>

        <p class="mt-3 text-slate-500 leading-relaxed">
            Akun kamu belum memiliki role yang valid.<br>
            Hubungi tim SkillNest untuk mendapatkan akses dashboard.
        </p>

        {{-- Actions --}}
        <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:justify-center">
            <a
                href="{{ route('contact') }}"
                class="rounded-xl bg-[#2563EB] px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-[#1d4ed8] transition"
            >
                Hubungi Kami
            </a>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button
                    type="submit"
                    class="w-full rounded-xl border border-slate-300 bg-white px-6 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition"
                >
                    Keluar
                </button>
            </form>
        </div>

    </div>

</body>
</html>
