<!DOCTYPE html>
<html lang="id">
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

        <a href="{{ route('home') }}" class="flex items-center gap-3 mb-10">
            <img src="{{ asset('images/skillnestlogo.png') }}" class="h-10" alt="SkillNest">
            <span class="text-xl font-bold text-[#0F172A]">SkillNest</span>
        </a>

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
        </nav>

    </aside>

    {{-- CONTENT --}}
    <main class="flex-1 p-10">

        {{-- HEADER --}}
        <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-4xl font-bold text-[#0F172A]">Portfolio Saya</h1>
                <p class="mt-2 text-slate-500">Tampilkan hasil pekerjaan terbaikmu agar lebih dipercaya UMKM.</p>
            </div>

            <a href="{{ route('portfolio.create') }}"
                class="inline-block rounded-2xl bg-gradient-to-r from-[#2563EB] to-[#1149C7] px-6 py-4 text-sm font-semibold text-white shadow-lg shadow-blue-500/20 hover:opacity-90 transition-opacity">
                + Tambah Portfolio
            </a>
        </div>

        {{-- FLASH MESSAGE --}}
        @if(session('success'))
            <div class="mt-6 rounded-xl bg-green-50 border border-green-200 px-5 py-4 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        {{-- STATS --}}
        <div class="mt-8 grid gap-6 md:grid-cols-3">
            <div class="rounded-[2rem] bg-white p-6 shadow-sm">
                <p class="text-sm text-slate-500">Total Project</p>
                <h2 class="mt-3 text-4xl font-bold text-[#1846A3]">{{ $total }}</h2>
            </div>
            <div class="rounded-[2rem] bg-white p-6 shadow-sm">
                <p class="text-sm text-slate-500">Total Views</p>
                <h2 class="mt-3 text-4xl font-bold text-[#1846A3]">0</h2>
            </div>
            <div class="rounded-[2rem] bg-white p-6 shadow-sm">
                <p class="text-sm text-slate-500">Total Likes</p>
                <h2 class="mt-3 text-4xl font-bold text-[#F59E0B]">0</h2>
            </div>
        </div>

        {{-- PORTFOLIO GRID --}}
        <div class="mt-10">

            @if($portfolios->isEmpty())
                <div class="flex flex-col items-center justify-center rounded-[2rem] bg-white py-20 shadow-sm text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-slate-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3 21h18M6.75 6.75h.008v.008H6.75V6.75z"/>
                    </svg>
                    <p class="text-slate-400 text-sm">Belum ada portfolio. Tambahkan portfolio pertamamu!</p>
                    <a href="{{ route('portfolio.create') }}"
                        class="mt-5 inline-block rounded-xl bg-gradient-to-r from-[#2563EB] to-[#1149C7] px-6 py-3 text-sm font-semibold text-white shadow-md hover:opacity-90 transition-opacity">
                        + Tambah Portfolio
                    </a>
                </div>
            @else
                <div class="grid gap-8 md:grid-cols-2 xl:grid-cols-3">
                    @foreach($portfolios as $portfolio)
                    <div class="overflow-hidden rounded-[2rem] bg-white shadow-sm transition hover:-translate-y-2 hover:shadow-xl">

                        <div class="overflow-hidden h-56 bg-slate-100">
                            @if($portfolio->foto)
                                <img
                                    src="{{ asset('storage/' . $portfolio->foto) }}"
                                    alt="{{ $portfolio->judul }}"
                                    class="h-full w-full object-cover transition duration-300 hover:scale-105"
                                >
                            @else
                                <div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-[#2563EB] to-[#1149C7]">
                                    <span class="text-white text-lg font-bold text-center px-4">{{ $portfolio->judul }}</span>
                                </div>
                            @endif
                        </div>

                        <div class="p-6">
                            <h3 class="text-xl font-bold text-[#0F172A]">{{ $portfolio->judul }}</h3>
                            <p class="mt-2 text-sm text-slate-500 line-clamp-2">{{ $portfolio->deskripsi }}</p>

                            <div class="mt-6 flex gap-3">
                                <a href="{{ route('portfolio.edit', $portfolio->id) }}"
                                    class="flex-1 text-center rounded-xl border border-[#DCE7FB] py-3 text-sm font-semibold text-[#1846A3] hover:bg-[#F8FAFF]">
                                    Edit
                                </a>

                                <form action="{{ route('portfolio.destroy', $portfolio->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus portfolio ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-full rounded-xl bg-red-50 px-6 py-3 text-sm font-semibold text-red-500 hover:bg-red-100">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                    @endforeach
                </div>
            @endif

        </div>

    </main>
</div>

</body>
</html>
