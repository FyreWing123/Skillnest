<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil UMKM - SkillNest</title>
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
            <a href="{{ route('dashboard.umkm') }}"
               class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Dashboard</a>
            <a href="{{ route('profile.umkm') }}"
               class="block rounded-xl bg-[#EAF2FF] px-4 py-3 font-semibold text-[#1846A3]">Profil UMKM</a>
            <a href="{{ route('cari.mahasiswa') }}"
               class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Cari Mahasiswa</a>
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
        <h1 class="text-4xl font-bold text-[#0F172A]">Profil UMKM</h1>
        <p class="mt-2 text-slate-500">Kelola informasi usaha dan kontak bisnis kamu.</p>

        @if(session('success'))
            <div class="mt-6 rounded-xl bg-green-50 border border-green-200 px-5 py-3 text-sm font-semibold text-green-700">
                ✓ {{ session('success') }}
            </div>
        @endif

        <div class="mt-8 grid gap-8 lg:grid-cols-[280px_1fr]">

            {{-- KARTU INFO SINGKAT --}}
            <div class="rounded-4xl bg-white p-8 shadow-sm border border-[#DCE7FB] text-center self-start">
                @php
                    $initial = strtoupper(substr($user->nama_usaha ?? $user->name, 0, 2));
                @endphp
                <div class="mx-auto h-24 w-24 rounded-full bg-[#EAF2FF] flex items-center justify-center text-[#1846A3] text-2xl font-bold">
                    {{ $initial }}
                </div>
                <h2 class="mt-5 text-xl font-bold text-[#0F172A]">
                    {{ $user->nama_usaha ?? $user->name }}
                </h2>
                @if($user->kategori_usaha)
                    <p class="mt-1 text-sm text-slate-500">{{ $user->kategori_usaha }}</p>
                @endif
                @if($user->alamat_usaha)
                    <p class="mt-1 text-sm text-slate-400">{{ $user->alamat_usaha }}</p>
                @endif

                <div class="mt-6 space-y-2 text-left border-t border-[#F1F5F9] pt-5">
                    <div class="flex items-center gap-2 text-sm text-slate-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span class="truncate">{{ $user->email }}</span>
                    </div>
                    @if($user->no_whatsapp)
                    <div class="flex items-center gap-2 text-sm text-slate-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <span>{{ $user->no_whatsapp }}</span>
                    </div>
                    @endif
                </div>
            </div>

            {{-- FORM EDIT --}}
            <div class="rounded-4xl bg-white p-8 shadow-sm border border-[#DCE7FB]">
                <h2 class="text-xl font-bold text-[#0F172A] mb-6">Informasi Usaha</h2>

                @if($errors->any())
                    <div class="mb-6 rounded-xl bg-red-50 border border-red-200 p-4">
                        <ul class="text-sm text-red-600 space-y-1 list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('profile.umkm.update') }}" class="space-y-5">
                    @csrf

                    <div class="grid gap-5 md:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                Nama Usaha <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nama_usaha"
                                   value="{{ old('nama_usaha', $user->nama_usaha) }}"
                                   placeholder="Contoh: Toko Maju"
                                   class="h-[52px] w-full rounded-2xl border px-5 text-sm outline-none focus:ring-2 focus:ring-blue-100 transition
                                          {{ $errors->has('nama_usaha') ? 'border-red-400 bg-red-50' : 'border-[#D9E5F7] bg-[#F9FBFF] focus:border-[#2563EB]' }}">
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                Kategori Usaha <span class="text-red-500">*</span>
                            </label>
                            <select name="kategori_usaha"
                                    class="h-[52px] w-full rounded-2xl border px-5 text-sm outline-none focus:ring-2 focus:ring-blue-100 transition
                                           {{ $errors->has('kategori_usaha') ? 'border-red-400 bg-red-50' : 'border-[#D9E5F7] bg-[#F9FBFF] focus:border-[#2563EB]' }}">
                                @foreach(['Kuliner & F&B','Fashion','Teknologi','Jasa','Kesehatan','Pendidikan','Retail','Lainnya'] as $kat)
                                    <option value="{{ $kat }}" {{ old('kategori_usaha', $user->kategori_usaha) === $kat ? 'selected' : '' }}>
                                        {{ $kat }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid gap-5 md:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">Nama Pemilik / Perwakilan</label>
                            <input type="text" name="name"
                                   value="{{ old('name', $user->name) }}"
                                   placeholder="Nama lengkap pemilik"
                                   class="h-[52px] w-full rounded-2xl border px-5 text-sm outline-none focus:ring-2 focus:ring-blue-100 transition
                                          {{ $errors->has('name') ? 'border-red-400 bg-red-50' : 'border-[#D9E5F7] bg-[#F9FBFF] focus:border-[#2563EB]' }}">
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">No. WhatsApp</label>
                            <input type="text" name="no_whatsapp"
                                   value="{{ old('no_whatsapp', $user->no_whatsapp) }}"
                                   placeholder="+62 812 3456 7890"
                                   class="h-[52px] w-full rounded-2xl border px-5 text-sm outline-none focus:ring-2 focus:ring-blue-100 transition
                                          border-[#D9E5F7] bg-[#F9FBFF] focus:border-[#2563EB]">
                        </div>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Email</label>
                        <input type="email" value="{{ $user->email }}" disabled
                               class="h-[52px] w-full rounded-2xl border border-[#D9E5F7] bg-slate-50 px-5 text-sm text-slate-400 cursor-not-allowed outline-none">
                        <p class="mt-1 text-xs text-slate-400">Email tidak dapat diubah.</p>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Alamat Usaha</label>
                        <input type="text" name="alamat_usaha"
                               value="{{ old('alamat_usaha', $user->alamat_usaha) }}"
                               placeholder="Jl. Raya No. 1, Kota"
                               class="h-[52px] w-full rounded-2xl border border-[#D9E5F7] bg-[#F9FBFF] px-5 text-sm outline-none focus:border-[#2563EB] focus:ring-2 focus:ring-blue-100 transition">
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Deskripsi Usaha</label>
                        <textarea name="deskripsi_usaha" rows="4"
                                  placeholder="Ceritakan tentang usahamu, produk/layanan yang ditawarkan..."
                                  class="w-full rounded-2xl border border-[#D9E5F7] bg-[#F9FBFF] px-5 py-4 text-sm outline-none focus:border-[#2563EB] focus:ring-2 focus:ring-blue-100 transition resize-none">{{ old('deskripsi_usaha', $user->deskripsi_usaha) }}</textarea>
                    </div>

                    <div class="pt-2">
                        <button type="submit"
                                class="rounded-2xl bg-linear-to-r from-[#2563EB] to-[#1149C7] px-8 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-500/20 hover:opacity-90 transition">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </main>
</div>
</body>
</html>
