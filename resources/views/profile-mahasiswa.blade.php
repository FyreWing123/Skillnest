<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Mahasiswa - SkillNest</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#F6FAFF]">

<div class="min-h-screen flex">

    {{-- SIDEBAR --}}
    <aside class="w-72 bg-white border-r border-[#E2E8F0] p-6">

        <div class="flex items-center gap-3 mb-10">

            <img
                src="{{ asset('images/skillnestlogo.png') }}"
                alt="SkillNest"
                class="h-10"
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
                class="block rounded-xl bg-[#EAF2FF] px-4 py-3 font-semibold text-[#1846A3]">
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

            <a href="#"
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

        <h1 class="text-4xl font-bold text-[#0F172A]">
            Profil Saya
        </h1>

        <p class="mt-2 text-slate-500">
            Lengkapi informasi profil agar lebih mudah ditemukan UMKM.
        </p>





        {{-- PROFILE CARD --}}
        <div class="mt-10 rounded-[2rem] bg-white p-8 shadow-sm">

            <div class="flex flex-col gap-8 lg:flex-row">

                {{-- PHOTO --}}
                <div class="flex flex-col items-center">

                    <img
                        src="https://i.pravatar.cc/300?u=bambang"
                        alt="profile"
                        class="h-40 w-40 rounded-full object-cover"
                    >

                    <button
                        class="mt-4 rounded-xl bg-[#1846A3] px-5 py-2 text-sm font-semibold text-white"
                    >
                        Upload Foto
                    </button>

                </div>





                {{-- FORM --}}
                <div class="flex-1">

                    <div class="grid gap-6 md:grid-cols-2">

                        <div>
                            <label class="mb-2 block text-sm font-semibold">
                                Nama Lengkap
                            </label>

                            <input
                                type="text"
                                value="Bambang Ronaldo"
                                class="w-full rounded-xl border border-[#DCE7FB] px-4 py-3"
                            >
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-semibold">
                                Universitas
                            </label>

                            <input
                                type="text"
                                value="Universitas Airlangga"
                                class="w-full rounded-xl border border-[#DCE7FB] px-4 py-3"
                            >
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-semibold">
                                Jurusan
                            </label>

                            <input
                                type="text"
                                value="Sistem Informasi"
                                class="w-full rounded-xl border border-[#DCE7FB] px-4 py-3"
                            >
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-semibold">
                                Semester
                            </label>

                            <input
                                type="text"
                                value="5"
                                class="w-full rounded-xl border border-[#DCE7FB] px-4 py-3"
                            >
                        </div>

                    </div>





                    {{-- BIO --}}
                    <div class="mt-6">

                        <label class="mb-2 block text-sm font-semibold">
                            Bio
                        </label>

                        <textarea
                            rows="5"
                            class="w-full rounded-xl border border-[#DCE7FB] px-4 py-3"
                        >Saya adalah mahasiswa yang fokus pada UI/UX Design dan Web Development untuk membantu UMKM berkembang secara digital.</textarea>

                    </div>





                    {{-- SKILLS --}}
                    <div class="mt-6">

                        <label class="mb-3 block text-sm font-semibold">
                            Skills
                        </label>

                        <div class="flex flex-wrap gap-2">

                            <span class="rounded-full bg-[#EAF2FF] px-4 py-2 text-sm font-semibold text-[#1846A3]">
                                HTML
                            </span>

                            <span class="rounded-full bg-[#EAF2FF] px-4 py-2 text-sm font-semibold text-[#1846A3]">
                                CSS
                            </span>

                            <span class="rounded-full bg-[#EAF2FF] px-4 py-2 text-sm font-semibold text-[#1846A3]">
                                Laravel
                            </span>

                            <span class="rounded-full bg-[#EAF2FF] px-4 py-2 text-sm font-semibold text-[#1846A3]">
                                Figma
                            </span>

                        </div>

                    </div>





                    <button
                        class="mt-8 rounded-2xl bg-gradient-to-r from-[#2563EB] to-[#1149C7] px-8 py-4 text-sm font-semibold text-white"
                    >
                        Simpan Profil
                    </button>

                </div>

            </div>

        </div>

    </main>

</div>

</body>
</html>