<header class="sticky top-0 z-30 border-b border-slate-200 bg-white/90 backdrop-blur">
    @php
        $registerUrl = Route::has('register') ? route('register') : url('/register');
        $loginUrl = Route::has('login') ? route('login') : url('/login');
    @endphp

    <div class="mx-auto flex w-full max-w-7xl items-center justify-between px-6 py-4">

        {{-- LEFT --}}
        <div class="flex items-center gap-10">

            {{-- LOGO --}}
            <a href="/" class="flex items-center gap-3 shrink-0">
                <img
                    src="{{ asset('images/skillnestlogo.png') }}"
                    alt="SkillNest Logo"
                    class="h-10 w-10 object-contain"
                >

                <span class="text-2xl font-semibold text-slate-900">
                    SkillNest
                </span>
            </a>

            {{-- SEARCH --}}
            <div class="hidden xl:flex items-center gap-3 rounded-full border border-slate-300 bg-white px-4 py-2 shadow-sm">

                <svg
                    class="h-5 w-5 text-slate-400"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <circle cx="11" cy="11" r="7" />
                    <path d="m21 21-4.3-4.3" />
                </svg>

                <input
                    type="search"
                    placeholder="Cari jasa"
                    class="w-[240px] bg-transparent text-sm text-slate-900 outline-none placeholder:text-slate-500"
                />

                <button
                    type="button"
                    class="rounded-full bg-[var(--color-accent)] px-5 py-2 text-sm font-semibold text-slate-900"
                >
                    Explore
                </button>

            </div>

        </div>

        {{-- CENTER NAV --}}
        <nav class="hidden lg:flex items-center gap-8 text-sm font-semibold whitespace-nowrap">

            <a
                href="{{ route('home') }}"
                class="{{ request()->routeIs('home')
                    ? 'border-b-2 border-[var(--color-accent)] pb-2 text-[var(--color-primary-dark)]'
                    : 'text-slate-700 hover:text-slate-900' }}"
            >
                Home
            </a>

           <a 
                href="{{ route('aboutus') }}"
                class="{{ request()->routeIs('aboutus') 
                    ? 'text-[var(--color-primary-dark)] border-b-2 border-[var(--color-accent)] pb-2' 
                    : 'text-slate-700' }}"
            >
                About us
            </a>

            <a href="{{ route('services') }}"
            class="{{ request()->routeIs('services') ? 'text-[var(--color-primary-dark)] border-b-2 border-[var(--color-accent)] pb-2' : 'text-slate-700' }}">
                Services
            </a>

            <a
                href="{{ route('contact') }}"
                class="whitespace-nowrap {{ request()->routeIs('contact')
                    ? 'border-b-2 border-[var(--color-accent)] pb-2 text-[var(--color-primary-dark)]'
                    : 'text-slate-700 hover:text-slate-900' }}"
            >
                Contact us
            </a>

            <a  href="{{ route('faqs') }}"
                class="whitespace-nowrap {{ request()->routeIs('faqs')
                    ? 'border-b-2 border-[var(--color-accent)] pb-2 text-[var(--color-primary-dark)]'
                    : 'text-slate-700 hover:text-slate-900' }}"
            >
                FAQ's
            </a>

        </nav>

        {{-- RIGHT --}}
        <div class="flex items-center gap-3 shrink-0">

            <a
                href="{{ $registerUrl }}"
                class="inline-flex items-center justify-center rounded-full border border-slate-300 bg-slate-100 px-5 py-2 text-sm font-semibold text-slate-900"
            >
                Daftar
            </a>

            <a
                href="{{ $loginUrl }}"
                class="inline-flex items-center justify-center rounded-full bg-[var(--color-primary)] px-5 py-2 text-sm font-semibold text-white shadow-sm"
            >
                Masuk
            </a>

        </div>

    </div>
</header>