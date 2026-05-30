<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>About Us - SkillNest</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            body {
                margin: 0;
                font-family: ui-sans-serif, system-ui, sans-serif;
            }

            button,
            input,
            textarea,
            select {
                font: inherit;
            }
        </style>
    @endif
</head>

<body class="bg-[#F6FAFF] text-[#1b1b18] min-h-screen flex flex-col overflow-x-hidden">

    {{-- HEADER --}}
    @include('partials.header')



    {{-- MAIN --}}
    <main class="flex-1 w-full px-6 py-16 md:px-8 md:py-24">

        <div class="relative mx-auto max-w-7xl">

            {{-- Background Decorations --}}
            <div class="absolute top-0 right-0 h-[280px] w-[280px] rounded-full bg-[#DCE7FB] opacity-70 -z-10"></div>

            <div class="absolute top-28 right-8 h-[120px] w-[120px] rounded-full bg-[#F3E7BE] opacity-90 -z-10"></div>

            <div class="absolute inset-0 -z-10 bg-gradient-to-b from-[#EFF6FF] via-[#F8FBFF] to-transparent rounded-3xl blur-3xl opacity-60"></div>





            {{-- HERO SECTION --}}
            <section class="grid gap-16 lg:grid-cols-2 lg:items-center">




                {{-- LEFT CONTENT --}}
                <div>

                    <span class="inline-flex items-center rounded-full bg-[#EAF2FF] px-5 py-2 text-xs font-semibold uppercase tracking-[0.28em] text-[#1E3A8A]">
                        ABOUT SKILLNEST
                    </span>

                    <h1 class="mt-8 text-5xl font-bold leading-[1.05] tracking-[-0.04em] text-[#0F172A] sm:text-[4.2rem]">
                        Marketplace Skill
                        Mahasiswa untuk
                        <span class="text-[#1D4ED8]">
                            Mendorong UMKM
                        </span>
                    </h1>

                    <p class="mt-8 max-w-2xl text-lg leading-9 text-[#64748B]">
                        SkillNest dibuat untuk menjadi ruang kolaborasi antara mahasiswa
                        berbakat dan UMKM yang membutuhkan layanan digital terjangkau.
                    </p>

                   <div class="mt-12">
                    <a href="{{ route('register') }}"
                    class="inline-flex items-center justify-center rounded-2xl bg-gradient-to-r from-[#2563EB] to-[#1149C7] px-8 py-4 text-base font-semibold text-white shadow-lg shadow-blue-500/20 transition hover:opacity-90">
                        Gabung Sekarang
                    </a>
                </div>
                </div>



                {{-- RIGHT MOCKUP --}}
                <div class="relative">

                    <div class="rounded-[2.5rem] bg-white p-8 shadow-[0_25px_70px_rgba(15,23,42,0.07)]">




                        {{-- TOP CARDS --}}
                        <div class="grid grid-cols-2 gap-6">

                            {{-- STUDENT --}}
                            <div class="rounded-[1.8rem] bg-[#1846A3] p-7 text-white">

                                <div class="text-3xl font-bold">
                                    Student
                                </div>

                                <div class="mt-4 text-base text-white/85">
                                    Penyedia jasa
                                </div>
                            </div>





                            {{-- UMKM --}}
                            <div class="rounded-[1.8rem] bg-[#FFC928] p-7 text-[#0F172A]">

                                <div class="text-3xl font-bold">
                                    UMKM
                                </div>

                                <div class="mt-4 text-base font-medium text-slate-800">
                                    Pengguna jasa
                                </div>
                            </div>
                        </div>







                        {{-- BOTTOM PROJECT CARD --}}
                        <div class="mt-7 rounded-[1.8rem] border border-[#DCE7FB] bg-[#F8FBFF] p-6">

                            <div class="flex items-center justify-between gap-5">




                                {{-- LEFT DOT --}}
                                <div class="h-12 w-12 rounded-full bg-[#2563EB]"></div>





                                {{-- CONTENT --}}
                                <div class="flex-1">

                                    <div class="text-2xl font-bold text-[#0F172A]">
                                        Kolaborasi Project
                                    </div>

                                    <div class="mt-3 h-2 overflow-hidden rounded-full bg-[#E2E8F0]">

                                        <div class="h-full w-[72%] rounded-full bg-[#F4C430]"></div>
                                    </div>

                                    <div class="mt-3 text-sm text-[#64748B]">
                                        Pesan jasa, pantau progress, beri ulasan.
                                    </div>
                                </div>


                                {{-- RIGHT DOT --}}
                                <div class="h-12 w-12 rounded-full bg-[#1846A3]"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>









            {{-- PURPOSE SECTION --}}
            <section class="mt-32 text-center">

                <span class="inline-flex items-center rounded-full bg-[#EAF2FF] px-5 py-2 text-xs font-semibold uppercase tracking-[0.28em] text-[#1E3A8A]">
                    OUR PURPOSE
                </span>

                <h2 class="mt-7 text-5xl font-bold tracking-[-0.03em] text-[#0F172A]">
                    Kenapa SkillNest Dibuat?
                </h2>

                <p class="mx-auto mt-6 max-w-3xl text-lg leading-8 text-[#64748B]">
                    Membantu mahasiswa membangun portofolio dan membantu UMKM mendapat layanan terpercaya.
                </p>






                {{-- PURPOSE CARDS --}}
                <div class="mt-16 grid gap-8 lg:grid-cols-3">




                    {{-- CARD 1 --}}
                    <div class="rounded-[2rem] border border-[#DCE7FB] bg-white p-10 text-left shadow-sm">

                        <div class="flex h-14 w-14 items-center justify-center rounded-full bg-[#E8F0FF] text-xl font-bold text-[#1846A3]">
                            1
                        </div>

                        <h3 class="mt-8 text-3xl font-bold text-[#0F172A]">
                            Akses Talenta
                        </h3>

                        <p class="mt-5 text-base leading-8 text-[#64748B]">
                            UMKM dapat menemukan mahasiswa dengan skill sesuai kebutuhan bisnis.
                        </p>
                    </div>






                    {{-- CARD 2 --}}
                    <div class="rounded-[2rem] bg-[#1846A3] p-10 text-left text-white shadow-lg">

                        <div class="flex h-14 w-14 items-center justify-center rounded-full bg-[#FFC928] text-xl font-bold text-[#0F172A]">
                            2
                        </div>

                        <h3 class="mt-8 text-3xl font-bold">
                            Portofolio Nyata
                        </h3>

                        <p class="mt-5 text-base leading-8 text-white/85">
                            Mahasiswa mendapat pengalaman project langsung dari kebutuhan UMKM.
                        </p>
                    </div>






                    {{-- CARD 3 --}}
                    <div class="rounded-[2rem] border border-[#DCE7FB] bg-white p-10 text-left shadow-sm">

                        <div class="flex h-14 w-14 items-center justify-center rounded-full bg-[#FFF5D8] text-xl font-bold text-[#1846A3]">
                            3
                        </div>

                        <h3 class="mt-8 text-3xl font-bold text-[#0F172A]">
                            Ekosistem Kampus
                        </h3>

                        <p class="mt-5 text-base leading-8 text-[#64748B]">
                            Mendorong kolaborasi kampus, mahasiswa, dan pelaku usaha lokal.
                        </p>
                    </div>
                </div>
            </section>

            {{-- SERVICE CATEGORIES --}}
<section class="mt-28 text-center">

    <span class="inline-flex items-center rounded-full bg-[#EAF2FF] px-5 py-2 text-xs font-semibold uppercase tracking-[0.28em] text-[#1E3A8A]">
        SERVICE CATEGORIES
    </span>

    <h2 class="mt-7 text-5xl font-bold tracking-[-0.03em] text-[#0F172A]">
        Kategori Layanan
    </h2>

    <p class="mx-auto mt-6 max-w-3xl text-lg leading-8 text-[#64748B]">
        Pilih layanan berdasarkan kebutuhan bisnis dan budget.
    </p>






    {{-- FIRST ROW --}}
    <div class="mt-16 grid gap-8 md:grid-cols-2 lg:grid-cols-4">




        {{-- CARD 1 --}}
        <div class="group rounded-[2rem] border border-[#DCE7FB] bg-white p-8 text-left shadow-sm transition-all duration-300 hover:-translate-y-2 hover:bg-[#1846A3] hover:shadow-xl">

            <div class="flex h-14 w-14 items-center justify-center rounded-full bg-[#E8F0FF] text-xl font-bold text-[#1846A3] transition-all duration-300 group-hover:bg-[#FFC928] group-hover:text-[#0F172A]">
                D
            </div>

            <h3 class="mt-7 text-2xl font-bold text-[#0F172A] transition-colors duration-300 group-hover:text-white">
                Desain Grafis
            </h3>

            <p class="mt-4 text-base leading-8 text-[#64748B] transition-colors duration-300 group-hover:text-white/80">
                Logo, poster, feed, banner, menu, dan katalog.
            </p>
        </div>








        {{-- CARD 2 --}}
        <div class="group rounded-[2rem] border border-[#DCE7FB] bg-white p-8 text-left shadow-sm transition-all duration-300 hover:-translate-y-2 hover:bg-[#1846A3] hover:shadow-xl">

            <div class="flex h-14 w-14 items-center justify-center rounded-full bg-[#FFF5D8] text-xl font-bold text-[#0F172A] transition-all duration-300 group-hover:bg-[#FFC928] group-hover:text-[#0F172A]">
                W
            </div>

            <h3 class="mt-7 text-2xl font-bold text-[#0F172A] transition-colors duration-300 group-hover:text-white">
                Web Development
            </h3>

            <p class="mt-4 text-base leading-8 text-[#64748B] transition-colors duration-300 group-hover:text-white/80">
                Landing page, katalog web, dan profil perusahaan.
            </p>
        </div>








        {{-- CARD 3 --}}
        <div class="group rounded-[2rem] border border-[#DCE7FB] bg-white p-8 text-left shadow-sm transition-all duration-300 hover:-translate-y-2 hover:bg-[#1846A3] hover:shadow-xl">

            <div class="flex h-14 w-14 items-center justify-center rounded-full bg-[#FFF5D8] text-xl font-bold text-[#0F172A] transition-all duration-300 group-hover:bg-[#FFC928] group-hover:text-[#0F172A]">
                M
            </div>

            <h3 class="mt-7 text-2xl font-bold text-[#0F172A] transition-colors duration-300 group-hover:text-white">
                Digital Marketing
            </h3>

            <p class="mt-4 text-base leading-8 text-[#64748B] transition-colors duration-300 group-hover:text-white/80">
                Strategi konten, campaign, dan optimasi sosial media.
            </p>
        </div>








        {{-- CARD 4 --}}
        <div class="group rounded-[2rem] border border-[#DCE7FB] bg-white p-8 text-left shadow-sm transition-all duration-300 hover:-translate-y-2 hover:bg-[#1846A3] hover:shadow-xl">

            <div class="flex h-14 w-14 items-center justify-center rounded-full bg-[#E8F0FF] text-xl font-bold text-[#1846A3] transition-all duration-300 group-hover:bg-[#FFC928] group-hover:text-[#0F172A]">
                F
            </div>

            <h3 class="mt-7 text-2xl font-bold text-[#0F172A] transition-colors duration-300 group-hover:text-white">
                Fotografi Produk
            </h3>

            <p class="mt-4 text-base leading-8 text-[#64748B] transition-colors duration-300 group-hover:text-white/80">
                Foto katalog, marketplace, dan konten promosi.
            </p>
        </div>
    </div>








    {{-- SECOND ROW --}}
    <div class="mx-auto mt-8 grid max-w-5xl gap-8 md:grid-cols-3">




        {{-- CARD 5 --}}
        <div class="group rounded-[2rem] border border-[#DCE7FB] bg-white p-8 text-left shadow-sm transition-all duration-300 hover:-translate-y-2 hover:bg-[#1846A3] hover:shadow-xl">

            <div class="flex h-14 w-14 items-center justify-center rounded-full bg-[#FFF5D8] text-xl font-bold text-[#0F172A] transition-all duration-300 group-hover:bg-[#FFC928] group-hover:text-[#0F172A]">
                C
            </div>

            <h3 class="mt-7 text-2xl font-bold text-[#0F172A] transition-colors duration-300 group-hover:text-white">
                Content Creation
            </h3>

            <p class="mt-4 text-base leading-8 text-[#64748B] transition-colors duration-300 group-hover:text-white/80">
                Caption, copywriting, artikel, dan konsep konten.
            </p>
        </div>








        {{-- CARD 6 --}}
        <div class="group rounded-[2rem] border border-[#DCE7FB] bg-white p-8 text-left shadow-sm transition-all duration-300 hover:-translate-y-2 hover:bg-[#1846A3] hover:shadow-xl">

            <div class="flex h-14 w-14 items-center justify-center rounded-full bg-[#E8F0FF] text-xl font-bold text-[#1846A3] transition-all duration-300 group-hover:bg-[#FFC928] group-hover:text-[#0F172A]">
                A
            </div>

            <h3 class="mt-7 text-2xl font-bold text-[#0F172A] transition-colors duration-300 group-hover:text-white">
                Admin Support
            </h3>

            <p class="mt-4 text-base leading-8 text-[#64748B] transition-colors duration-300 group-hover:text-white/80">
                Input data, laporan sederhana, dan administrasi digital.
            </p>
        </div>




        {{-- CARD 7 --}}
        <div class="group rounded-[2rem] border border-[#DCE7FB] bg-white p-8 text-left shadow-sm transition-all duration-300 hover:-translate-y-2 hover:bg-[#1846A3] hover:shadow-xl">

            <div class="flex h-14 w-14 items-center justify-center rounded-full bg-[#FFF5D8] text-xl font-bold text-[#0F172A] transition-all duration-300 group-hover:bg-[#FFC928] group-hover:text-[#0F172A]">
                U
            </div>

            <h3 class="mt-7 text-2xl font-bold text-[#0F172A] transition-colors duration-300 group-hover:text-white">
                UI/UX Designer
            </h3>

            <p class="mt-4 text-base leading-8 text-[#64748B] transition-colors duration-300 group-hover:text-white/80">
                Membuat desain antarmuka dan pengalaman pengguna untuk aplikasi dan website.
            </p>
        </div>
    </div>
</section>


            {{-- CTA SECTION --}}
            <section class="mt-24">

                <div class="flex flex-col gap-8 rounded-[2.5rem] border border-[#DCE7FB] bg-[#F8FBFF] p-10 shadow-sm lg:flex-row lg:items-center lg:justify-between">

                    <div>

                        <h3 class="text-4xl font-bold tracking-[-0.03em] text-[#0F172A]">
                            Nilai Utama
                        </h3>

                        <p class="mt-5 max-w-3xl text-lg leading-8 text-[#64748B]">
                            Terpercaya, mudah digunakan, terjangkau,
                            dan berfokus pada pertumbuhan pengguna.
                        </p>
                    </div>





                    <div>
                        <a href="#"
                           class="inline-flex items-center justify-center rounded-2xl bg-[#FFC928] px-8 py-4 text-base font-semibold text-[#0F172A] shadow-lg shadow-yellow-300/20 transition hover:opacity-90">
                            Lihat Services
                        </a>
                    </div>
                </div>
            </section>
        </div>
    </main>



    {{-- FOOTER --}}
    @include('partials.footer')

</body>
</html>