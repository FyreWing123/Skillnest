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

        <a href="{{ route('home') }}" class="flex items-center gap-3 mb-10">
            <img src="{{ asset('images/skillnestlogo.png') }}" alt="SkillNest" class="h-10">
            <span class="text-xl font-bold text-[#0F172A]">SkillNest</span>
        </a>

        <nav class="space-y-2">
            <a href="{{ route('dashboard.mahasiswa') }}" class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Dashboard</a>
            <a href="{{ route('profile.mahasiswa') }}" class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Profil Saya</a>
            <a href="{{ route('portfolio.mahasiswa') }}" class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Portfolio</a>
            <a href="{{ route('layanan.saya') }}" class="block rounded-xl bg-[#EAF2FF] px-4 py-3 font-semibold text-[#1846A3]">Layanan Saya</a>
            <a href="{{ route('chat') }}" class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Pesan</a>
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
               class="rounded-2xl bg-linear-to-r from-[#2563EB] to-[#1149C7] px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-500/20 hover:opacity-90 transition">
                + Tambah Layanan
            </a>
        </div>

        {{-- FLASH MESSAGE --}}
        @if(session('success'))
            <div class="mt-6 rounded-xl bg-green-50 border border-green-200 px-5 py-4 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        {{-- CARDS --}}
        <div class="mt-10">

            @if($layanans->isEmpty())
                <div class="flex flex-col items-center justify-center rounded-4xl bg-white py-20 shadow-sm text-center border border-[#DCE7FB]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-slate-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0"/>
                    </svg>
                    <p class="text-slate-400 text-sm">Belum ada layanan. Tambahkan layanan pertamamu!</p>
                    <a href="{{ route('layanan.create') }}"
                        class="mt-5 inline-block rounded-xl bg-linear-to-r from-[#2563EB] to-[#1149C7] px-6 py-3 text-sm font-semibold text-white shadow-md hover:opacity-90 transition">
                        + Tambah Layanan
                    </a>
                </div>
            @else
                <div class="grid gap-8 lg:grid-cols-2">
                    @foreach($layanans as $layanan)
                    <div class="rounded-4xl border border-[#DCE7FB] bg-white p-8 shadow-sm">

                        <div class="flex items-start justify-between">
                            <div>
                                <h2 class="text-2xl font-bold text-[#0F172A]">{{ $layanan->nama }}</h2>
                                <p class="mt-2 font-semibold text-[#2563EB]">{{ $layanan->kategori }}</p>
                            </div>
                            <div class="flex flex-col items-end gap-2">
                                <span class="rounded-xl px-4 py-2 text-sm font-bold
                                    {{ $layanan->status === 'aktif' ? 'bg-[#EAF2FF] text-[#1846A3]' : 'bg-slate-100 text-slate-500' }}">
                                    {{ ucfirst($layanan->status) }}
                                </span>
                                <span class="flex items-center gap-1.5 rounded-lg px-3 py-1 text-xs font-bold
                                    {{ $layanan->isOpen() ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-600' }}">
                                    <span class="h-1.5 w-1.5 rounded-full {{ $layanan->isOpen() ? 'bg-emerald-500' : 'bg-red-500' }}"></span>
                                    {{ $layanan->isOpen() ? 'Open' : 'Closed' }}
                                </span>
                            </div>
                        </div>

                        <p class="mt-6 text-[#64748B] leading-7">{{ $layanan->deskripsi_singkat }}</p>

                        <div class="mt-8 flex items-center justify-between">
                            <div>
                                <p class="text-sm text-[#64748B]">Harga Mulai</p>
                                <h3 class="text-3xl font-bold text-[#1846A3]">{{ $layanan->formatHarga() }}</h3>
                            </div>
                            <div>
                                <p class="text-sm text-[#64748B]">Estimasi</p>
                                <h3 class="text-lg font-bold text-[#0F172A]">{{ $layanan->estimasi }}</h3>
                            </div>
                        </div>

                        <div class="mt-8 flex flex-wrap gap-3">
                            <a href="{{ route('layanan.pesanan', $layanan->id) }}"
                               class="flex items-center gap-2 rounded-xl bg-[#F0F9FF] border border-[#BAE6FD] px-5 py-3 text-sm font-semibold text-[#0369A1] hover:bg-[#E0F2FE] transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                                Kelola Pesanan
                                @php $jumlah = $layanan->pesanans()->where('status','menunggu_verifikasi')->count(); @endphp
                                @if($jumlah > 0)
                                    <span class="ml-1 h-5 w-5 rounded-full bg-[#2563EB] text-white text-[10px] font-bold flex items-center justify-center">
                                        {{ $jumlah }}
                                    </span>
                                @endif
                            </a>
                            <a href="{{ route('layanan.edit', $layanan->id) }}"
                               class="rounded-xl bg-[#EAF2FF] px-5 py-3 text-sm font-semibold text-[#1846A3] hover:bg-blue-100 transition">
                                Edit
                            </a>
                            <form action="{{ route('layanan.destroy', $layanan->id) }}" method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus layanan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="rounded-xl bg-red-50 px-5 py-3 text-sm font-semibold text-red-600 hover:bg-red-100 transition">
                                    Hapus
                                </button>
                            </form>
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
