<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil UMKM - SkillNest</title>
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
        <p class="mt-3 text-slate-500">Kelola informasi usaha dan kontak bisnis kamu.</p>

        <div class="mt-10 grid gap-8 lg:grid-cols-[1fr_2fr]">

            {{-- FOTO & INFO SINGKAT --}}
            <div class="rounded-[2rem] bg-white p-8 shadow-sm text-center">
                <div class="mx-auto h-24 w-24 rounded-full bg-[#EAF2FF] flex items-center justify-center text-[#1846A3] text-3xl font-bold">TM</div>
                <h2 class="mt-5 text-xl font-bold text-[#0F172A]">Toko Maju</h2>
                <p class="mt-1 text-sm text-slate-500">Kuliner & F&B</p>
                <p class="mt-1 text-sm text-slate-500">Surabaya, Jawa Timur</p>
                <button class="mt-6 w-full rounded-2xl border border-[#D9E5F7] bg-[#F9FBFF] px-4 py-3 text-sm font-semibold text-[#1846A3] hover:bg-[#EAF2FF] transition">
                    Ganti Foto
                </button>
            </div>

            {{-- FORM EDIT --}}
            <div class="rounded-[2rem] bg-white p-8 shadow-sm">
                <h2 class="text-xl font-bold text-[#0F172A] mb-6">Informasi Usaha</h2>

                <form method="POST" action="#" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div class="grid gap-5 md:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">Nama Usaha</label>
                            <input type="text" value="Toko Maju"
                                class="h-[52px] w-full rounded-2xl border border-[#D9E5F7] bg-[#F9FBFF] px-5 text-sm outline-none focus:border-[#2563EB] transition">
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">Kategori Usaha</label>
                            <select class="h-[52px] w-full rounded-2xl border border-[#D9E5F7] bg-[#F9FBFF] px-5 text-sm outline-none focus:border-[#2563EB] transition">
                                <option>Kuliner & F&B</option>
                                <option>Fashion</option>
                                <option>Teknologi</option>
                                <option>Jasa</option>
                                <option>Lainnya</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid gap-5 md:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">Email</label>
                            <input type="email" value="tokomain@gmail.com"
                                class="h-[52px] w-full rounded-2xl border border-[#D9E5F7] bg-[#F9FBFF] px-5 text-sm outline-none focus:border-[#2563EB] transition">
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">No. WhatsApp</label>
                            <input type="text" value="+62 812 3456 7890"
                                class="h-[52px] w-full rounded-2xl border border-[#D9E5F7] bg-[#F9FBFF] px-5 text-sm outline-none focus:border-[#2563EB] transition">
                        </div>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Alamat Usaha</label>
                        <input type="text" value="Jl. Raya Darmo No. 12, Surabaya"
                            class="h-[52px] w-full rounded-2xl border border-[#D9E5F7] bg-[#F9FBFF] px-5 text-sm outline-none focus:border-[#2563EB] transition">
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Deskripsi Usaha</label>
                        <textarea rows="4" placeholder="Ceritakan tentang usahamu..."
                            class="w-full rounded-2xl border border-[#D9E5F7] bg-[#F9FBFF] px-5 py-4 text-sm outline-none focus:border-[#2563EB] transition resize-none">Toko Maju adalah usaha kuliner yang berfokus pada makanan tradisional Jawa Timur dengan cita rasa otentik.</textarea>
                    </div>

                    <div class="pt-2">
                        <button type="submit"
                            class="rounded-2xl bg-gradient-to-r from-[#2563EB] to-[#1149C7] px-8 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-500/20 hover:opacity-90 transition">
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