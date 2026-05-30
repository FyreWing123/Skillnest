<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Services - SkillNest</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="bg-[#F6FAFF] text-[#1b1b18] min-h-screen flex flex-col overflow-x-hidden">

    {{-- HEADER --}}
    @include('partials.header')





    {{-- MAIN --}}
    <main class="flex-1">




        {{-- HERO --}}
        <section class="relative overflow-hidden px-6 py-24 md:px-10">

            {{-- Decorative --}}
            <div class="absolute right-10 top-0 h-[260px] w-[260px] rounded-full bg-[#DCE7FB] opacity-70"></div>

            <div class="absolute right-0 top-24 h-[140px] w-[140px] rounded-full bg-[#F3E7BE] opacity-80"></div>





            <div class="relative mx-auto max-w-7xl">

                <span class="inline-flex items-center rounded-full bg-[#EAF2FF] px-5 py-2 text-xs font-semibold uppercase tracking-[0.28em] text-[#1E3A8A]">
                    EXPLORE SERVICES
                </span>

                <h1 class="mt-8 max-w-4xl text-5xl font-bold leading-[1.05] tracking-[-0.03em] text-[#0F172A] md:text-[4.5rem]">
                    Temukan Jasa Mahasiswa
                    <br>
                    Sesuai Kebutuhan Bisnismu
                </h1>

                <p class="mt-8 max-w-2xl text-lg leading-8 text-[#64748B]">
                    Cari mahasiswa berbakat untuk desain, website, marketing,
                    content creation, dan berbagai kebutuhan UMKM lainnya.
                </p>
            </div>
        </section>








        {{-- FILTER --}}
        <section class="px-6 py-16 md:px-10">

            <div class="mx-auto max-w-7xl">

                <div class="grid gap-5 lg:grid-cols-[1.2fr_0.8fr_0.8fr_0.7fr]">

                    {{-- SEARCH --}}
                    <input
                        type="text"
                        placeholder="Search services..."
                        class="h-[62px] rounded-2xl border border-[#DCE7FB] bg-white px-6 text-sm outline-none transition focus:border-[#2563EB]"
                    >

                   {{-- CATEGORY --}}
<div class="relative">
    <select
        class="appearance-none h-[62px] w-full rounded-2xl border border-[#DCE7FB] bg-white px-6 pr-14 text-sm font-semibold outline-none transition focus:border-[#2563EB]"
    >
        <option>Semua Kategori</option>
        <option>Desain Grafis</option>
        <option>Web Development</option>
        <option>Digital Marketing</option>
        <option>Fotografi Produk</option>
        <option>Content Creation</option>
        <option>Admin Support</option>
        <option>UI/UX Designer</option>
    </select>

    <svg
        class="pointer-events-none absolute right-6 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-500"
        fill="none"
        stroke="currentColor"
        viewBox="0 0 24 24"
        stroke-width="2"
    >
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6"/>
    </svg>
</div>

{{-- SORT --}}
<div class="relative">
    <select
        class="appearance-none h-[62px] w-full rounded-2xl border border-[#DCE7FB] bg-white px-6 pr-14 text-sm font-semibold outline-none transition focus:border-[#2563EB]"
    >
        <option>Sort: Populer</option>
        <option>Harga Terendah</option>
        <option>Rating Tertinggi</option>
    </select>

    <svg
        class="pointer-events-none absolute right-6 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-500"
        fill="none"
        stroke="currentColor"
        viewBox="0 0 24 24"
        stroke-width="2"
    >
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6"/>
    </svg>
</div>

                    {{-- BUTTON --}}
                    <button
                        class="h-[62px] rounded-2xl bg-gradient-to-r from-[#2563EB] to-[#1149C7] px-6 text-sm font-semibold text-white shadow-lg shadow-blue-500/20 transition hover:opacity-90"
                    >
                        Explore Services
                    </button>
                </div>
            </div>
        </section>



{{-- SERVICE PROVIDERS --}}
<section class="px-6 pb-20 md:px-10">

    <div class="mx-auto max-w-7xl">

        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-4">

    @php
        $services = [
            ['name' => 'Bambang', 'job' => 'Web Developer', 'price' => '50K+', 'rating' => '4.9'],
            ['name' => 'Abdul', 'job' => 'Content Writer', 'price' => '35K+', 'rating' => '4.8'],
            ['name' => 'Budi', 'job' => 'Digital Marketing', 'price' => '75K+', 'rating' => '5.0'],
            ['name' => 'Pram', 'job' => 'UI/UX Designer', 'price' => '60K+', 'rating' => '4.9'],

            ['name' => 'Dinda', 'job' => 'Graphic Designer', 'price' => '45K+', 'rating' => '4.8'],
            ['name' => 'Fajar', 'job' => 'Fotografi Produk', 'price' => '80K+', 'rating' => '5.0'],
            ['name' => 'Rina', 'job' => 'Content Creator', 'price' => '40K+', 'rating' => '4.7'],
            ['name' => 'Yoga', 'job' => 'Admin Support', 'price' => '30K+', 'rating' => '4.8'],

            ['name' => 'Sinta', 'job' => 'Copywriter', 'price' => '35K+', 'rating' => '4.9'],
            ['name' => 'Kevin', 'job' => 'Frontend Developer', 'price' => '70K+', 'rating' => '5.0'],
            ['name' => 'Nadia', 'job' => 'Social Media Specialist', 'price' => '55K+', 'rating' => '4.8'],
            ['name' => 'Rafi', 'job' => 'Branding Designer', 'price' => '65K+', 'rating' => '4.9'],
        ];
    @endphp

    @foreach ($services as $service)
        <div class="group rounded-[2rem] border border-[#DCE7FB] bg-white p-6 shadow-sm transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">

            <div class="flex items-center gap-4">
                <img
                    src="https://i.pravatar.cc/150?u={{ $service['name'] }}"
                    alt="{{ $service['name'] }}"
                    class="h-16 w-16 rounded-full object-cover"
                >

                <div>
                    <h3 class="text-2xl font-bold text-[#0F172A]">
                        {{ $service['name'] }}
                    </h3>

                    <p class="text-sm font-semibold text-[#2563EB]">
                        {{ $service['job'] }}
                    </p>
                </div>
            </div>

            <p class="mt-6 text-sm leading-7 text-[#64748B]">
                Mahasiswa berpengalaman membantu UMKM dan bisnis berkembang melalui layanan profesional.
            </p>

            <div class="mt-6 flex items-center justify-between">
                <div class="text-4xl font-bold text-[#1846A3]">
                    Rp{{ $service['price'] }}
                </div>

                <div class="text-sm font-semibold text-[#F59E0B]">
                    ★ {{ $service['rating'] }}
                </div>
            </div>

           <a href="{{ route('service.detail') }}"
                class="mt-6 inline-flex w-full items-center justify-center rounded-2xl bg-gradient-to-r from-[#2563EB] to-[#1149C7] px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-500/20 transition hover:opacity-90">
                Lihat Detail
            </a>

        </div>
    @endforeach

</div>

{{-- PAGINATION --}}
<div class="mt-16 flex items-center justify-end gap-4">

    <button
        class="flex h-11 w-11 items-center justify-center rounded-xl border border-[#DCE7FB] bg-white text-slate-400"
    >
        ←
    </button>

    <div class="text-sm font-semibold text-[#64748B]">
        Page 1 of 1
    </div>

    <button
        class="flex h-11 w-11 items-center justify-center rounded-xl border border-[#DCE7FB] bg-white text-slate-400"
    >
        →
    </button>

</div>


        {{-- CTA --}}
       <section class="mt-24 px-6 pb-24 md:px-10">
        
            <div class="mx-auto max-w-7xl overflow-hidden rounded-[2.5rem] bg-gradient-to-r from-[#2563EB] to-[#1149C7] p-10 text-white shadow-xl">

                <div class="flex flex-col gap-10 lg:flex-row lg:items-center lg:justify-between">

                    <div>

                        <h2 class="text-5xl font-bold tracking-[-0.03em]">
                            Butuh Bantuan?
                        </h2>

                        <p class="mt-5 text-lg text-white/85">
                            Langung hubungi pihak customer support yuk!
                        </p>
                    </div>

                    <button
                        class="rounded-2xl bg-[#FFC928] px-10 py-5 text-base font-bold text-[#0F172A] shadow-lg transition hover:opacity-90"
                    >
                        Hubungi Kita
                    </button>
                </div>
            </div>
        </section>
    </main>





    {{-- FOOTER --}}
    @include('partials.footer')

</body>
</html>