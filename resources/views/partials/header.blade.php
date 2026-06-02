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

            @guest
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
            @endguest

            @auth
                <div class="relative" id="profile-menu">

                    {{-- Trigger --}}
                    <button
                        type="button"
                        onclick="toggleProfileMenu()"
                        class="flex items-center gap-2 rounded-full border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-900 shadow-sm hover:bg-slate-50 transition"
                    >
                        {{-- Avatar inisial --}}
                        <span class="flex h-8 w-8 items-center justify-center rounded-full bg-[var(--color-primary)] text-white text-sm font-bold select-none">
                            {{ strtoupper(substr(auth()->user()->nickname ?? auth()->user()->name, 0, 1)) }}
                        </span>

                        <span class="hidden sm:block max-w-[120px] truncate">
                            {{ auth()->user()->nickname ?? auth()->user()->name }}
                        </span>

                        <svg class="h-4 w-4 text-slate-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    {{-- Dropdown --}}
                    <div
                        id="profile-dropdown"
                        class="hidden absolute right-0 mt-2 w-48 rounded-xl border border-slate-200 bg-white py-1 shadow-lg z-50"
                    >
                        <a
                            href="{{ url('/dashboard') }}"
                            class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50"
                        >
                            <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Dashboard
                        </a>

                        <hr class="my-1 border-slate-100">

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button
                                type="submit"
                                class="flex w-full items-center gap-3 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50"
                            >
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Keluar
                            </button>
                        </form>
                    </div>

                </div>
            @endauth

        </div>

    </div>
</header>

<script>
function toggleProfileMenu() {
    document.getElementById('profile-dropdown').classList.toggle('hidden');
}

document.addEventListener('click', function (e) {
    const menu = document.getElementById('profile-menu');
    if (menu && !menu.contains(e.target)) {
        document.getElementById('profile-dropdown').classList.add('hidden');
    }
});
</script>