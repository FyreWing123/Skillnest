<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Lupa Password - SkillNest</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="login-page">

    @include('partials.header')

    <main class="login-wrapper">

        {{-- ===== LEFT PANEL ===== --}}
        <div class="login-left">

            <div class="login-deco-circle-blue"></div>
            <div class="login-deco-circle-yellow"></div>
            <div class="login-deco-square-gray"></div>
            <div class="login-deco-square-yellow"></div>

            <div class="login-left-content">

                <span class="login-badge">RESET PASSWORD</span>

                <h1 class="login-heading">
                    Pulihkan akses ke
                    <span>akunmu</span>
                </h1>

                <p class="login-subtext">
                    Masukkan email yang terdaftar dan kami akan mengirimkan
                    link untuk mereset password kamu.
                </p>

                <div class="login-dashboard-card">
                    <div class="login-dashboard-header">
                        Keamanan Akun
                    </div>
                    <div class="login-dashboard-stats">
                        <div class="login-stat-card">
                            <h3>🔒</h3>
                            <p>Akun aman</p>
                        </div>
                        <div class="login-stat-card login-stat-card--yellow">
                            <h3>✉️</h3>
                            <p>Via Email</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        {{-- ===== RIGHT PANEL ===== --}}
        <div class="login-right">

            <div class="login-form-card">

                <h2 class="login-form-title">Lupa Password?</h2>

                <p class="login-form-sub">
                    Masukkan email kamu dan kami akan mengirimkan link reset password.
                </p>

                <form
                    action="{{ route('password.email') }}"
                    method="POST"
                    class="login-form"
                >
                    @csrf

                    {{-- EMAIL --}}
                    <div class="login-field">
                        <label class="login-label" for="email">Email</label>

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

                    {{-- SUCCESS --}}
                    @if(session('success'))
                        <div class="success-box">
                            ✓ {{ session('success') }}
                        </div>
                    @endif

                    {{-- SUBMIT --}}
                    <button type="submit" class="login-submit-btn">
                        Kirim Link Reset Password
                    </button>

                </form>

                <p class="login-register-link">
                    Ingat password kamu?
                    <a href="{{ route('login') }}" class="login-register-anchor">
                        Kembali Masuk
                    </a>
                </p>

            </div>

        </div>

    </main>

    @include('partials.footer')

</body>
</html>
