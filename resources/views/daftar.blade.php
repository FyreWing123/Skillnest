<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Daftar - SkillNest</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="register-page">

    @include('partials.header')

    <main class="register-wrapper">

        {{-- ===== LEFT PANEL ===== --}}
        <div class="register-left">

            {{-- Decorations --}}
            <div class="reg-deco-circle-blue"></div>
            <div class="reg-deco-circle-yellow"></div>
            <div class="reg-deco-square-gray"></div>
            <div class="reg-deco-square-yellow"></div>

            <div class="register-left-content">

                {{-- Badge --}}
                <span class="reg-badge">CREATE ACCOUNT</span>

                {{-- Heading --}}
                <h1 class="reg-heading">
                    Daftar ke SkillNest
                </h1>

                <p class="reg-subtext">
                    Pilih peranmu dan mulai gunakan SkillNest untuk
                    menawarkan jasa atau mencari talenta mahasiswa.
                </p>

                {{-- Role Cards --}}
                <div class="reg-role-cards">

                    <div class="reg-role-card" id="role-card-mahasiswa">
                        <div class="reg-role-avatar reg-role-avatar--blue">
                            M
                        </div>
                        <div>
                            <p class="reg-role-title">Mahasiswa</p>
                            <p class="reg-role-desc">
                                Daftarkan skill, buat portofolio,<br>
                                dan dapatkan project UMKM.
                            </p>
                        </div>
                    </div>

                    <div class="reg-role-card" id="role-card-umkm">
                        <div class="reg-role-avatar reg-role-avatar--yellow">
                            U
                        </div>
                        <div>
                            <p class="reg-role-title">UMKM</p>
                            <p class="reg-role-desc">
                                Cari jasa digital terpercaya<br>
                                dengan harga terjangkau.
                            </p>
                        </div>
                    </div>

                </div>

            </div>

        </div>

        {{-- ===== RIGHT PANEL (FORM) ===== --}}
        <div class="register-right">

            <div class="register-form-card">

                <h2 class="reg-form-title">Buat Akun Baru</h2>
                <p class="reg-form-sub">Isi data berikut untuk mulai bergabung.</p>

                <form
                    action="{{ route('register.store') }}"
                    method="POST"
                    class="reg-form"
                    id="register-form"
                >
                    @csrf

                    {{-- PILIH PERAN --}}
                    <div class="reg-field">
                        <label class="reg-label">Pilih Peran</label>

                        <div class="reg-role-toggle">
                            <button
                                type="button"
                                class="reg-toggle-btn reg-toggle-btn--active"
                                data-role="mahasiswa"
                                id="btn-mahasiswa"
                            >
                                Mahasiswa
                            </button>
                            <button
                                type="button"
                                class="reg-toggle-btn"
                                data-role="umkm"
                                id="btn-umkm"
                            >
                                UMKM
                            </button>
                        </div>

                        <input type="hidden" name="role" id="role-input" value="{{ old('role', 'mahasiswa') }}">

                        @error('role')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- NAMA LENGKAP --}}
                    <div class="reg-field">
                        <label class="reg-label" for="name">Nama Lengkap</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Masukkan nama lengkap"
                            class="input-field {{ $errors->has('name') ? 'input-error' : '' }}"
                        >
                        @error('name')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- NAMA PANGGILAN --}}
                    <div class="reg-field">
                        <label class="reg-label" for="nickname">Nama Panggilan</label>
                        <input
                            type="text"
                            id="nickname"
                            name="nickname"
                            value="{{ old('nickname') }}"
                            placeholder="Nama singkat kamu"
                            class="input-field {{ $errors->has('nickname') ? 'input-error' : '' }}"
                        >
                        @error('nickname')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- EMAIL --}}
                    <div class="reg-field">
                        <label class="reg-label" for="email">Email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="nama@email.com"
                            class="input-field {{ $errors->has('email') ? 'input-error' : '' }}"
                        >
                        @error('email')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- PASSWORD --}}
                    <div class="reg-field">
                        <label class="reg-label" for="password">Password</label>
                        <div class="reg-password-wrap">
                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Minimal 8 karakter"
                                class="input-field {{ $errors->has('password') ? 'input-error' : '' }}"
                            >
                            <button type="button" class="reg-eye-btn" id="toggle-password" aria-label="Tampilkan password">
                                {{-- Eye icon --}}
                                <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                                {{-- Eye-off icon (hidden by default) --}}
                                <svg id="eye-off-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    style="display:none">
                                    <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/>
                                    <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/>
                                    <line x1="1" y1="1" x2="23" y2="23"/>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- PASSWORD CONFIRMATION --}}
                    <div class="reg-field">
                        <label class="reg-label" for="password_confirmation">Konfirmasi Password</label>
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            placeholder="Ulangi password"
                            class="input-field"
                        >
                    </div>

                    {{-- SUCCESS --}}
                    @if(session('success'))
                        <div class="success-box">
                            ✓ {{ session('success') }}
                        </div>
                    @endif

                    {{-- SUBMIT --}}
                    <button type="submit" class="btn-primary w-full reg-submit-btn">
                        Daftar Sekarang
                    </button>

                </form>

                {{-- LOGIN LINK --}}
                <p class="reg-login-link">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="reg-login-anchor">Masuk</a>
                </p>

            </div>

        </div>

    </main>

    @include('partials.footer')

    <script>
        // ---- Role toggle ----
        const btnMahasiswa   = document.getElementById('btn-mahasiswa');
        const btnUmkm        = document.getElementById('btn-umkm');
        const roleInput      = document.getElementById('role-input');
        const cardMahasiswa  = document.getElementById('role-card-mahasiswa');
        const cardUmkm       = document.getElementById('role-card-umkm');

        function setRole(role) {
            roleInput.value = role;

            // Toggle buttons
            btnMahasiswa.classList.toggle('reg-toggle-btn--active', role === 'mahasiswa');
            btnUmkm.classList.toggle('reg-toggle-btn--active',      role === 'umkm');

            // Highlight left panel cards
            cardMahasiswa.classList.toggle('reg-role-card--active', role === 'mahasiswa');
            cardUmkm.classList.toggle('reg-role-card--active',      role === 'umkm');
        }

        // Set initial state
        setRole('{{ old('role', 'mahasiswa') }}');

        btnMahasiswa.addEventListener('click', () => setRole('mahasiswa'));
        btnUmkm.addEventListener('click',      () => setRole('umkm'));

        // Clicking the left panel cards also switches role
        cardMahasiswa.addEventListener('click', () => setRole('mahasiswa'));
        cardUmkm.addEventListener('click',      () => setRole('umkm'));

        // ---- Show/hide password ----
        const togglePwd  = document.getElementById('toggle-password');
        const pwdInput   = document.getElementById('password');
        const eyeIcon    = document.getElementById('eye-icon');
        const eyeOffIcon = document.getElementById('eye-off-icon');

        togglePwd.addEventListener('click', () => {
            const isHidden = pwdInput.type === 'password';
            pwdInput.type        = isHidden ? 'text' : 'password';
            eyeIcon.style.display    = isHidden ? 'none'  : '';
            eyeOffIcon.style.display = isHidden ? ''      : 'none';
        });
    </script>

</body>
</html>