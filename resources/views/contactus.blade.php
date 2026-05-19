<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Contact Us - SkillNest</title>

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

            {{-- Background Blur --}}
            <div class="absolute inset-0 -z-10 bg-gradient-to-b from-[#EFF6FF] via-[#F8FBFF] to-transparent rounded-3xl blur-3xl opacity-60"></div>

            {{-- Decorative Shapes --}}
            <div class="absolute top-0 right-0 h-[260px] w-[260px] rounded-full bg-[#DCE7FB] opacity-70 -z-10"></div>

            <div class="absolute top-28 right-8 h-[120px] w-[120px] rounded-full bg-[#F3E7BE] opacity-90 -z-10"></div>

            <div class="absolute bottom-16 left-0 h-[160px] w-[160px] rounded-full bg-[#E6EEFF] opacity-80 -z-10"></div>

            <div class="absolute left-0 top-40 h-20 w-20 rounded-[1.5rem] border-[5px] border-[#D6E1F7] -z-10"></div>

            <div class="absolute left-10 top-56 h-14 w-14 rounded-[1.25rem] border-[5px] border-[#F2D98D] -z-10"></div>



            {{-- HEADING --}}
            <section class="text-center pt-6">

                <span class="inline-flex items-center rounded-full bg-[var(--color-bg)] px-5 py-2 text-xs font-semibold uppercase tracking-[0.28em] text-[var(--color-primary-dark)]">
                    CONTACT SKILLNEST
                </span>

                <h1 class="mt-8 text-5xl font-semibold tracking-[-0.03em] text-[var(--color-primary-dark)] leading-[1.05] sm:text-[4rem]">
                    Hubungi Tim SkillNest
                </h1>

                <p class="mx-auto mt-6 max-w-3xl text-lg leading-8 text-[var(--color-muted)]">
                    Punya pertanyaan tentang layanan, akun, atau kolaborasi UMKM?
                    Kirim pesanmu dan tim SkillNest akan membantu dengan cepat.
                </p>
            </section>





            {{-- CONTACT CARD --}}
            <section class="mt-20">

               <div class="overflow-hidden rounded-[2.5rem] border border-[#EDF2FA] bg-white p-8 shadow-[0_20px_60px_rgba(15,23,42,0.06)] lg:p-10">

                    <div class="grid gap-10 lg:grid-cols-[0.9fr_1.3fr] lg:items-start">




                        {{-- LEFT SIDE --}}
                        <div class="relative overflow-hidden rounded-[2.25rem] bg-gradient-to-br from-[#2B6FFF] to-[#1550D8]">

                            {{-- Decorative --}}
                            <div class="absolute top-0 right-0 h-36 w-36 rounded-full bg-white/10"></div>

                            <div class="absolute bottom-0 right-0 h-44 w-44 rounded-full bg-[#FFD54F]/15"></div>



                            <div class="relative z-10">

                                <h2 class="text-[44px] font-bold leading-[1.05] tracking-[-0.03em]">
                                    Mari Terhubung
                                </h2>

                                <p class="mt-5 text-[17px] leading-8text-white/85">
                                    Kami siap membantu mahasiswa dan UMKM untuk berkolaborasi melalui SkillNest.
                                </p>





                                {{-- CONTACT INFO --}}
                                <div class="mt-14 space-y-8">



                                    {{-- EMAIL --}}
                                    <div class="flex items-start gap-5">

                                        <div class="flex h-14 w-14 items-center justify-center rounded-full bg-[#FFC928] text-2xl">
                                            ✉
                                        </div>

                                        <div>
                                            <div class="text-base font-semibold">
                                                Email
                                            </div>

                                            <div class="mt-2 text-sm text-white/85">
                                                hello@skillnest.com
                                            </div>
                                        </div>
                                    </div>




                                    {{-- PHONE --}}
                                    <div class="flex items-start gap-5">

                                        <div class="flex h-14 w-14 items-center justify-center rounded-full bg-[#FFC928] text-2xl">
                                            ☎
                                        </div>

                                        <div>
                                            <div class="text-base font-semibold">
                                                Telepon
                                            </div>

                                            <div class="mt-2 text-sm text-white/85">
                                                +62 812 3456 7890
                                            </div>
                                        </div>
                                    </div>




                                    {{-- LOCATION --}}
                                    <div class="flex items-start gap-5">

                                        <div class="flex h-14 w-14 items-center justify-center rounded-full bg-[#FFC928] text-2xl">
                                            📍
                                        </div>

                                        <div>
                                            <div class="text-base font-semibold">
                                                Lokasi
                                            </div>

                                            <div class="mt-2 text-sm text-white/85">
                                                Universitas Airlangga, Surabaya
                                            </div>
                                        </div>
                                    </div>
                                </div>





                                {{-- BADGE --}}
                                <div class="mt-14">

                                    <div class="inline-flex rounded-full bg-[#FFC928] px-6 py-3 text-sm font-semibold text-slate-900 shadow-sm">
                                        Respon Maksimal 24 Jam
                                    </div>
                                </div>
                            </div>
                        </div>








                        {{-- RIGHT FORM --}}
                        <div>

                            <h2 class="text-4xl font-semibold tracking-[-0.03em] text-[var(--color-primary-dark)]">
                                Kirim Pesan
                            </h2>

                            <p class="mt-5 text-base leading-8 text-[var(--color-muted)]">
                                Isi form berikut agar tim SkillNest dapat menghubungimu kembali.
                            </p>





                            {{-- FORM --}}
                            <form class="mt-12 space-y-7">




                                {{-- NAME + EMAIL --}}
                                <div class="grid gap-6 md:grid-cols-2">

                                    {{-- NAME --}}
                                    <div>

                                        <label class="mb-3 block text-sm font-semibold text-slate-700">
                                            Nama Lengkap
                                        </label>

                                        <input
                                            type="text"
                                            placeholder="Nama kamu"
                                            class="h-[58px] w-full rounded-2xl border border-[#D9E5F7] bg-[#F9FBFF]px-5 text-base outline-none transition focus:border-[var(--color-primary)]"
                                        >
                                    </div>



                                    {{-- EMAIL --}}
                                    <div>

                                        <label class="mb-3 block text-sm font-semibold text-slate-700">
                                            Email
                                        </label>

                                        <input
                                            type="email"
                                            placeholder="nama@email.com"
                                            class="h-[58px] w-full rounded-2xl border border-[#D9E5F7] bg-[#F9FBFF] px-5 text-base outline-none transition focus:border-[var(--color-primary)]"
                                        >
                                    </div>
                                </div>





                                {{-- CATEGORY --}}
                                <div>

                                    <label class="mb-3 block text-sm font-semibold text-slate-700">
                                        Kategori Bantuan
                                    </label>

                                    <select
                                        class="h-[58px] w-full rounded-2xl border border-[#D9E5F7] bg-[#F9FBFF] px-5 text-base outline-none transition focus:border-[var(--color-primary)]"
                                    >
                                        <option>Pilih kategori pesan</option>
                                        <option>Kerjasama UMKM</option>
                                        <option>Menjadi Penyedia Jasa</option>
                                        <option>Partnership</option>
                                        <option>Lainnya</option>
                                    </select>
                                </div>





                                {{-- MESSAGE --}}
                                <div>

                                    <label class="mb-3 block text-sm font-semibold text-slate-700">
                                        Pesan
                                    </label>

                                    <textarea
                                        rows="6"
                                        placeholder="Tulis pesan atau pertanyaanmu di sini"
                                        class="w-full rounded-2xl border border-[#D8E2F3] bg-[#F8FAFD] px-5 py-4 text-base outline-none transition focus:border-[var(--color-primary)]"
                                    ></textarea>
                                </div>





                                {{-- BUTTON --}}
                                <button
                                    type="submit"
                                    class="inline-flex w-full items-center justify-center rounded-2xl bg-[var(--color-primary)] px-8 py-4 text-base font-semibold text-white shadow-sm transition hover:opacity-90"
                                >
                                    Kirim Pesan
                                </button>

                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>



    {{-- FOOTER --}}
    @include('partials.footer')

</body>
</html>