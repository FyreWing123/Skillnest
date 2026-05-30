<footer class="mt-16 bg-[var(--color-footer)] text-white">

    {{-- MAIN FOOTER --}}
    <div class="mx-auto max-w-7xl px-6 py-14">

        <div class="grid gap-12 lg:grid-cols-[1.8fr_1fr_1fr_1fr]">

            {{-- BRAND COLUMN --}}
            <div>
                {{-- Logo --}}
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3">
                    <img
                        src="{{ asset('images/skillnestlogo.png') }}"
                        alt="SkillNest Logo"
                        class="h-10 w-10 object-contain"
                    >
                    <span class="text-2xl font-bold tracking-tight">SkillNest</span>
                </a>

                <p class="mt-5 max-w-xs text-sm leading-7 text-white/60">
                    Platform jasa mahasiswa berbakat untuk membantu UMKM dan bisnis berkembang secara digital.
                </p>

                {{-- Social icons --}}
                <div class="mt-6 flex items-center gap-3">
                    {{-- Instagram --}}
                    <a href="#" class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/10 transition hover:bg-white/20">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                        </svg>
                    </a>
                    {{-- Twitter/X --}}
                    <a href="#" class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/10 transition hover:bg-white/20">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                        </svg>
                    </a>
                    {{-- LinkedIn --}}
                    <a href="#" class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/10 transition hover:bg-white/20">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                    </a>
                </div>
            </div>

            {{-- NAV COLUMN 1 --}}
            <div>
                <h3 class="text-xs font-bold uppercase tracking-[0.2em] text-white/40">Navigasi</h3>
                <ul class="mt-5 space-y-3.5">
                    <li>
                        <a href="{{ route('home') }}" class="text-sm text-white/70 transition hover:text-white">Home</a>
                    </li>
                    <li>
                        <a href="{{ route('aboutus') }}" class="text-sm text-white/70 transition hover:text-white">About Us</a>
                    </li>
                    <li>
                        <a href="{{ route('services') }}" class="text-sm text-white/70 transition hover:text-white">Services</a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" class="text-sm text-white/70 transition hover:text-white">Contact Us</a>
                    </li>
                    <li>
                        <a href="{{ route('faqs') }}" class="text-sm text-white/70 transition hover:text-white">FAQ's</a>
                    </li>
                </ul>
            </div>

            {{-- NAV COLUMN 2 --}}
            <div>
                <h3 class="text-xs font-bold uppercase tracking-[0.2em] text-white/40">Layanan</h3>
                <ul class="mt-5 space-y-3.5">
                    <li><a href="{{ route('services') }}" class="text-sm text-white/70 transition hover:text-white">Desain Grafis</a></li>
                    <li><a href="{{ route('services') }}" class="text-sm text-white/70 transition hover:text-white">Web Development</a></li>
                    <li><a href="{{ route('services') }}" class="text-sm text-white/70 transition hover:text-white">Digital Marketing</a></li>
                    <li><a href="{{ route('services') }}" class="text-sm text-white/70 transition hover:text-white">Content Creation</a></li>
                    <li><a href="{{ route('services') }}" class="text-sm text-white/70 transition hover:text-white">UI/UX Designer</a></li>
                </ul>
            </div>

            {{-- NAV COLUMN 3 --}}
            <div>
                <h3 class="text-xs font-bold uppercase tracking-[0.2em] text-white/40">Akun</h3>
                <ul class="mt-5 space-y-3.5">
                    <li>
                        <a href="{{ route('register') }}" class="text-sm text-white/70 transition hover:text-white">Daftar</a>
                    </li>
                    <li>
                        <a href="{{ route('login') }}" class="text-sm text-white/70 transition hover:text-white">Masuk</a>
                    </li>
                </ul>

                <h3 class="mt-8 text-xs font-bold uppercase tracking-[0.2em] text-white/40">Kontak</h3>
                <ul class="mt-5 space-y-3.5">
                    <li>
                        <a href="{{ route('contact') }}" class="text-sm text-white/70 transition hover:text-white">Hubungi Kami</a>
                    </li>
                    <li>
                        <a href="mailto:hello@skillnest.id" class="text-sm text-white/70 transition hover:text-white">hello@skillnest.id</a>
                    </li>
                </ul>
            </div>

        </div>
    </div>

    {{-- BOTTOM BAR --}}
    <div class="border-t border-white/10">
        <div class="mx-auto max-w-7xl px-6 py-5 flex flex-col items-center justify-between gap-3 sm:flex-row">
            <p class="text-xs text-white/40">© 2026 SkillNest. All rights reserved.</p>
            <div class="flex items-center gap-5">
                <a href="#" class="text-xs text-white/40 transition hover:text-white/70">Privacy Policy</a>
                <a href="#" class="text-xs text-white/40 transition hover:text-white/70">Terms of Service</a>
            </div>
        </div>
    </div>

</footer>