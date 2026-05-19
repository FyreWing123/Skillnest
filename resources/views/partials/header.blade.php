<header class="sticky top-0 z-30 bg-white border-b border-slate-200">
    @php
        $registerUrl = Route::has('register') ? route('register') : url('/register');
        $loginUrl = Route::has('login') ? route('login') : url('/login');
    @endphp
    <div class="mx-auto flex w-full max-w-screen-xl items-center justify-between gap-6 px-6 py-4">
       <a href="/" class="flex items-center gap-3">
    <img 
        src="{{ asset('images/skillnestlogo.png') }}" 
        alt="SkillNest Logo"
        class="h-10 w-10 object-contain">
    <span class="text-lg font-semibold text-slate-900">
        SkillNest
    </span>
</a>

        <div class="flex flex-1 items-center justify-center gap-6">
            <div class="hidden md:flex items-center gap-3 rounded-full border border-slate-300 bg-white px-4 py-2 shadow-sm">
                <svg class="h-5 w-5 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <circle cx="11" cy="11" r="7" />
                    <path d="m21 21-4.3-4.3" />
                </svg>
                <input type="search" placeholder="Cari jasa" class="min-w-[22rem] bg-transparent text-sm text-slate-900 outline-none placeholder:text-slate-500" />
                <button type="button" class="rounded-full bg-[var(--color-accent)] px-5 py-2 text-sm font-semibold text-slate-900">Explore</button>
            </div>

            <nav class="hidden lg:flex items-center gap-8 text-sm font-semibold">

                <a 
                    href="{{ route('home') }}"
                    class="{{ request()->routeIs('home') 
                        ? 'text-[var(--color-primary-dark)] border-b-2 border-[var(--color-accent)] pb-2' 
                        : 'text-slate-700' }}"
                >
                    Home
                </a>

                <a href="#" class="text-slate-700">
                    About us
                </a>

                <a href="#" class="text-slate-700">
                    Services
                </a>

                <a 
                    href="{{ route('contact') }}"
                    class="{{ request()->routeIs('contact') 
                        ? 'text-[var(--color-primary-dark)] border-b-2 border-[var(--color-accent)] pb-2' 
                        : 'text-slate-700' }}"
                >
                    Contact us
                </a>

                <a href="#" class="text-slate-700">
                    FAQ's
                </a>

            </nav>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ $registerUrl }}" class="inline-flex items-center justify-center rounded-full border border-slate-300 bg-slate-100 px-5 py-2 text-sm font-semibold text-slate-900">Daftar</a>
            <a href="{{ $loginUrl }}" class="inline-flex items-center justify-center rounded-full bg-[var(--color-primary)] px-5 py-2 text-sm font-semibold text-white shadow-sm">Masuk</a>
        </div>
    </div>
</header>
