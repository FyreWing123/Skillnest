<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Layanan Saya - SkillNest</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#F6FAFF] min-h-screen">

@include('partials.header')

<main class="px-6 py-16 md:px-10">

    <div class="mx-auto max-w-7xl">

        {{-- Header --}}
        <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">

            <div>
                <span class="inline-flex rounded-full bg-[#EAF2FF] px-4 py-2 text-xs font-semibold tracking-[0.2em] text-[#1E3A8A]">
                    MY SERVICES
                </span>

                <h1 class="mt-5 text-5xl font-bold tracking-[-0.03em] text-[#0F172A]">
                    Layanan Saya
                </h1>

                <p class="mt-4 max-w-2xl text-lg text-[#64748B]">
                    Kelola seluruh layanan yang akan tampil pada marketplace SkillNest.
                </p>
            </div>

            <a href="{{ route('layanan.create') }}"
               class="inline-flex items-center justify-center rounded-2xl bg-gradient-to-r from-[#2563EB] to-[#1149C7] px-8 py-4 text-sm font-semibold text-white shadow-lg shadow-blue-500/20">
                + Tambah Layanan
            </a>

        </div>

        {{-- Cards --}}
        <div class="mt-16 grid gap-8 lg:grid-cols-2">

            {{-- Card --}}
            <div class="rounded-[2rem] border border-[#DCE7FB] bg-white p-8 shadow-sm">

                <div class="flex items-start justify-between">

                    <div>
                        <h2 class="text-2xl font-bold text-[#0F172A]">
                            Landing Page UMKM
                        </h2>

                        <p class="mt-2 font-semibold text-[#2563EB]">
                            Web Development
                        </p>
                    </div>

                    <div class="rounded-xl bg-[#EAF2FF] px-4 py-2 text-sm font-bold text-[#1846A3]">
                        Aktif
                    </div>

                </div>

                <p class="mt-6 text-[#64748B] leading-7">
                    Landing page profesional untuk UMKM, bisnis lokal,
                    company profile, dan promosi digital.
                </p>

                <div class="mt-8 flex items-center justify-between">

                    <div>
                        <p class="text-sm text-[#64748B]">
                            Harga Mulai
                        </p>

                        <h3 class="text-3xl font-bold text-[#1846A3]">
                            Rp500K
                        </h3>
                    </div>

                    <div>
                        <p class="text-sm text-[#64748B]">
                            Estimasi
                        </p>

                        <h3 class="text-lg font-bold text-[#0F172A]">
                            3 Hari
                        </h3>
                    </div>

                </div>

                <div class="mt-8 flex gap-3">

                    <a href="#"
                       class="rounded-xl bg-[#EAF2FF] px-5 py-3 font-semibold text-[#1846A3]">
                        Edit
                    </a>

                    <button
                        class="rounded-xl bg-red-50 px-5 py-3 font-semibold text-red-600">
                        Hapus
                    </button>

                </div>

            </div>

            {{-- Card 2 --}}
            <div class="rounded-[2rem] border border-[#DCE7FB] bg-white p-8 shadow-sm">

                <div class="flex items-start justify-between">

                    <div>
                        <h2 class="text-2xl font-bold text-[#0F172A]">
                            Desain Feed Instagram
                        </h2>

                        <p class="mt-2 font-semibold text-[#2563EB]">
                            Desain Grafis
                        </p>
                    </div>

                    <div class="rounded-xl bg-[#EAF2FF] px-4 py-2 text-sm font-bold text-[#1846A3]">
                        Aktif
                    </div>

                </div>

                <p class="mt-6 text-[#64748B] leading-7">
                    Desain feed profesional untuk meningkatkan branding dan engagement.
                </p>

                <div class="mt-8 flex items-center justify-between">

                    <div>
                        <p class="text-sm text-[#64748B]">
                            Harga Mulai
                        </p>

                        <h3 class="text-3xl font-bold text-[#1846A3]">
                            Rp150K
                        </h3>
                    </div>

                    <div>
                        <p class="text-sm text-[#64748B]">
                            Estimasi
                        </p>

                        <h3 class="text-lg font-bold text-[#0F172A]">
                            2 Hari
                        </h3>
                    </div>

                </div>

                <div class="mt-8 flex gap-3">

                    <a href="#"
                       class="rounded-xl bg-[#EAF2FF] px-5 py-3 font-semibold text-[#1846A3]">
                        Edit
                    </a>

                    <button
                        class="rounded-xl bg-red-50 px-5 py-3 font-semibold text-red-600">
                        Hapus
                    </button>

                </div>

            </div>

        </div>

    </div>

</main>

@include('partials.footer')

</body>
</html>