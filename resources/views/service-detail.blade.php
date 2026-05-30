<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Service Detail - SkillNest</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="bg-[#F6FAFF] text-[#1b1b18] min-h-screen flex flex-col overflow-x-hidden font-[instrument-sans]">

    {{-- MAIN --}}
    <main class="flex-1 px-6 py-10 md:px-10">

        <div class="mx-auto max-w-3xl">

            {{-- BACK BUTTON --}}
            <div class="mb-8">
                <a href="{{ route('services') }}"
                    class="inline-flex items-center gap-2 rounded-xl border border-[#DCE7FB] bg-white px-5 py-2.5 text-sm font-semibold text-[#0F172A] shadow-sm transition hover:bg-[#F0F6FF]">
                    ← Back to Services
                </a>
            </div>

            {{-- PROFILE CARD --}}
            <div class="rounded-[2rem] border border-[#DCE7FB] bg-white p-8 shadow-sm">

                <div class="flex items-start gap-6">

                    {{-- Avatar --}}
                    <img
                        src="https://i.pravatar.cc/150?u=BambangRonaldo"
                        alt="Bambang Ronaldo"
                        class="h-24 w-24 rounded-full object-cover flex-shrink-0"
                    >

                    {{-- Info --}}
                    <div class="flex-1 min-w-0">
                        <h1 class="text-3xl font-bold text-[#0F172A]">Bambang Ronaldo</h1>
                        <p class="mt-1 text-sm font-semibold text-[#2563EB]">Web Designer</p>

                        {{-- Rating & Price --}}
                        <div class="mt-4 flex items-center gap-3 flex-wrap">
                            <span class="text-sm font-semibold text-[#0F172A]">
                                ★ 4.9 (124 Review)
                            </span>
                            <span class="inline-flex items-center rounded-xl border border-[#DCE7FB] bg-[#F6FAFF] px-4 py-1.5 text-sm font-semibold text-[#1E3A8A]">
                                Rp50.000+
                            </span>
                        </div>

                        {{-- Chat Button only --}}
                        <div class="mt-6">
                            <a href="{{ route('chat') }}"
                                class="inline-flex items-center gap-2 rounded-2xl bg-gradient-to-r from-[#2563EB] to-[#1149C7] px-7 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-500/20 transition hover:opacity-90">
                                💬 Chat Freelancer
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            {{-- DESKRIPSI LAYANAN --}}
            <div class="mt-6 rounded-[2rem] border border-[#DCE7FB] bg-white p-8 shadow-sm">
                <h2 class="text-lg font-bold text-[#0F172A]">Deskripsi Layanan</h2>

                <p class="mt-4 text-sm leading-7 text-[#64748B]">
                    Melayani pembuatan landing page, company profile, redesign website,
                    UI website modern, dashboard UMKM, serta optimasi tampilan digital
                    agar lebih profesional dan meningkatkan branding bisnis.
                </p>
            </div>

            {{-- SKILL & ESTIMASI --}}
            <div class="mt-6 grid gap-6 md:grid-cols-2">

                {{-- Skill yang Dikuasai --}}
                <div class="rounded-[2rem] border border-[#DCE7FB] bg-white p-8 shadow-sm">
                    <h2 class="text-lg font-bold text-[#0F172A]">Skill yang Dikuasai</h2>

                    <div class="mt-5 flex flex-wrap gap-2">
                        @foreach (['Figma', 'HTML', 'CSS', 'UI Design', 'Landing Page'] as $skill)
                            <span class="rounded-2xl bg-[#EAF2FF] px-4 py-2 text-xs font-semibold text-[#1E3A8A]">
                                {{ $skill }}
                            </span>
                        @endforeach
                    </div>
                </div>

                {{-- Estimasi Pengerjaan --}}
                <div class="rounded-[2rem] border border-[#DCE7FB] bg-white p-8 shadow-sm">
                    <h2 class="text-lg font-bold text-[#0F172A]">Estimasi Pengerjaan</h2>

                    <div class="mt-5">
                        <p class="text-base font-bold text-[#0F172A]">2 - 5 Hari Kerja</p>
                    </div>
                </div>

            </div>

            {{-- PORTOFOLIO --}}
            <div class="mt-6 rounded-[2rem] border border-[#DCE7FB] bg-white p-8 shadow-sm">
                <h2 class="text-lg font-bold text-[#0F172A]">Portofolio</h2>

                <div class="mt-6 grid grid-cols-3 gap-4">

                    <div class="group">
                        <div class="overflow-hidden rounded-2xl">
                            <img
                                src="https://placehold.co/200x130/FF6B35/ffffff?text=Landing+Page"
                                alt="Landing Page UMKM"
                                class="h-[130px] w-full object-cover transition-transform duration-300 group-hover:scale-105"
                            >
                        </div>
                        <p class="mt-3 text-center text-xs font-semibold text-[#0F172A]">Landing Page UMKM</p>
                    </div>

                    <div class="group">
                        <div class="overflow-hidden rounded-2xl">
                            <img
                                src="https://placehold.co/200x130/1E1B4B/C084FC?text=Dashboard"
                                alt="Dashboard Admin"
                                class="h-[130px] w-full object-cover transition-transform duration-300 group-hover:scale-105"
                            >
                        </div>
                        <p class="mt-3 text-center text-xs font-semibold text-[#0F172A]">Dashboard Admin</p>
                    </div>

                    <div class="group">
                        <div class="overflow-hidden rounded-2xl">
                            <img
                                src="https://placehold.co/200x130/0F172A/60A5FA?text=Website+Company"
                                alt="Website Company"
                                class="h-[130px] w-full object-cover transition-transform duration-300 group-hover:scale-105"
                            >
                        </div>
                        <p class="mt-3 text-center text-xs font-semibold text-[#0F172A]">Website Company</p>
                    </div>

                </div>
            </div>

            {{-- REVIEW CLIENT --}}
            <div class="mt-6 rounded-[2rem] border border-[#DCE7FB] bg-white p-8 shadow-sm">
                <h2 class="text-lg font-bold text-[#0F172A]">Review Client</h2>

                <div class="mt-6 flex flex-col gap-6">

                    {{-- Review 1 --}}
                    <div class="flex items-start gap-4">
                        <img
                            src="https://i.pravatar.cc/150?u=RizkyUMKM"
                            alt="Rizky UMKM"
                            class="h-12 w-12 rounded-full object-cover flex-shrink-0"
                        >
                        <div>
                            <p class="text-sm font-bold text-[#0F172A]">Rizky UMKM</p>
                            <p class="mt-0.5 text-sm text-[#F59E0B]">★★★★★</p>
                            <p class="mt-2 text-xs leading-6 text-[#64748B]">
                                Hasil desain sangat profesional dan cepat dikerjakan. Sangat direkomendasikan!
                            </p>
                        </div>
                    </div>

                    <div class="border-t border-[#F1F5F9]"></div>

                    {{-- Review 2 --}}
                    <div class="flex items-start gap-4">
                        <img
                            src="https://i.pravatar.cc/150?u=SitiWarung"
                            alt="Siti Warung"
                            class="h-12 w-12 rounded-full object-cover flex-shrink-0"
                        >
                        <div>
                            <p class="text-sm font-bold text-[#0F172A]">Siti Warung</p>
                            <p class="mt-0.5 text-sm text-[#F59E0B]">★★★★★</p>
                            <p class="mt-2 text-xs leading-6 text-[#64748B]">
                                Landing page UMKM saya jadi kelihatan lebih modern dan menarik. Terima kasih!
                            </p>
                        </div>
                    </div>

                </div>
            </div>

            {{-- JASA SERUPA --}}
            <div class="mt-6 rounded-[2rem] border border-[#DCE7FB] bg-white p-8 shadow-sm">
                <h2 class="text-lg font-bold text-[#0F172A]">Jasa Serupa</h2>

                <div class="mt-6 flex flex-col gap-5">

                    <div class="flex items-center gap-4">
                        <img src="https://i.pravatar.cc/150?u=Clara" alt="Clara"
                            class="h-12 w-12 rounded-full object-cover flex-shrink-0">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold text-[#0F172A]">Clara</p>
                            <p class="text-xs font-semibold text-[#2563EB]">UI/UX Designer</p>
                        </div>
                        <span class="text-sm font-bold text-[#1846A3] flex-shrink-0">Rp60K+</span>
                    </div>

                    <div class="border-t border-[#F1F5F9]"></div>

                    <div class="flex items-center gap-4">
                        <img src="https://i.pravatar.cc/150?u=Andi" alt="Andi"
                            class="h-12 w-12 rounded-full object-cover flex-shrink-0">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold text-[#0F172A]">Andi</p>
                            <p class="text-xs font-semibold text-[#2563EB]">Digital Marketing</p>
                        </div>
                        <span class="text-sm font-bold text-[#1846A3] flex-shrink-0">Rp75K+</span>
                    </div>

                </div>
            </div>

            {{-- Bottom spacing --}}
            <div class="h-16"></div>

        </div>
    </main>

</body>
</html>