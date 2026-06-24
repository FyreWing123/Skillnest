<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — SkillNest</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F6FAFF] text-[#0F172A]">
<div class="min-h-screen flex">

    {{-- SIDEBAR --}}
    <aside class="w-72 bg-white border-r border-[#E2E8F0] p-6 shrink-0 flex flex-col">
        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex items-center gap-3 mb-10">
            <img src="{{ asset('images/skillnestlogo.png') }}" class="h-10" alt="SkillNest">
            <span class="text-xl font-bold text-[#0F172A]">SkillNest</span>
        </a>

        {{-- NAV --}}
        <nav class="space-y-2 flex-1">
            <a href="{{ route('admin.dashboard') }}"
               class="block rounded-xl px-4 py-3 font-semibold transition
                      {{ request()->routeIs('admin.dashboard') ? 'bg-[#EAF2FF] text-[#1846A3]' : 'text-slate-600 hover:bg-slate-100' }}">
                Dashboard
            </a>
            <a href="{{ route('admin.users') }}"
               class="block rounded-xl px-4 py-3 font-semibold transition
                      {{ request()->routeIs('admin.users') ? 'bg-[#EAF2FF] text-[#1846A3]' : 'text-slate-600 hover:bg-slate-100' }}">
                Manajemen User
            </a>
            <a href="{{ route('admin.layanans') }}"
               class="block rounded-xl px-4 py-3 font-semibold transition
                      {{ request()->routeIs('admin.layanans') ? 'bg-[#EAF2FF] text-[#1846A3]' : 'text-slate-600 hover:bg-slate-100' }}">
                Manajemen Layanan
            </a>
            <a href="{{ route('admin.pesanans') }}"
               class="block rounded-xl px-4 py-3 font-semibold transition
                      {{ request()->routeIs('admin.pesanans') ? 'bg-[#EAF2FF] text-[#1846A3]' : 'text-slate-600 hover:bg-slate-100' }}">
                Semua Pesanan
            </a>
            <a href="{{ route('admin.laporan') }}"
               class="block rounded-xl px-4 py-3 font-semibold transition
                      {{ request()->routeIs('admin.laporan') ? 'bg-[#EAF2FF] text-[#1846A3]' : 'text-slate-600 hover:bg-slate-100' }}">
                Statistics
            </a>
        </nav>

        {{-- USER --}}
        <div class="pt-6 border-t border-[#E2E8F0]">
            <p class="text-sm font-semibold text-[#0F172A] truncate">{{ auth()->user()->name }}</p>
            <p class="text-xs text-slate-400 truncate">{{ auth()->user()->email }}</p>
            <form method="POST" action="{{ route('logout') }}" class="mt-3">
                @csrf
                <button type="submit"
                        class="text-sm font-semibold text-red-500 hover:text-red-700 transition">
                    ← Keluar
                </button>
            </form>
        </div>
    </aside>

    {{-- CONTENT --}}
    <main class="flex-1 overflow-y-auto">

        {{-- TOP BAR --}}
        <div class="bg-white border-b border-[#E2E8F0] px-8 py-4 flex items-center justify-between sticky top-0 z-10">
            <h1 class="text-lg font-bold text-[#0F172A]">@yield('heading', 'Admin Panel')</h1>
        </div>

        <div class="p-8">

            {{-- FLASH --}}
            @if(session('success'))
                <div class="mb-6 flex items-center gap-3 rounded-2xl bg-green-50 border border-green-200 px-5 py-3 text-sm text-green-700 font-medium">
                    <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-6 flex items-center gap-3 rounded-2xl bg-red-50 border border-red-200 px-5 py-3 text-sm text-red-700 font-medium">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>

    </main>
</div>
</body>
</html>
