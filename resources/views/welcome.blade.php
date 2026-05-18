<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Skillnest') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                body { margin: 0; font-family: ui-sans-serif, system-ui, sans-serif; }
                button, input, textarea, select { font: inherit; }
            </style>
        @endif
    </head>
    <body class="bg-[#F8FAFC] text-[#1b1b18] min-h-screen">
        @include('partials.header')

        <main class="mx-auto w-full max-w-screen-xl px-6 py-16 md:px-8 md:py-24">
            <div class="relative">
                <div class="absolute inset-0 -z-10 bg-gradient-to-b from-[#EFF6FF] via-[#F0F9FF] to-transparent rounded-3xl blur-3xl opacity-60"></div>
            @include('partials.hero')
            @include('partials.stats')
            @include('partials.services')
            @include('partials.cta-banner')
            @include('partials.footer')
        </main>
    </body>
</html>
