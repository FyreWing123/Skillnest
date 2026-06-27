<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FAQ's - SkillNest</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="faq-page">

    @include('partials.header')

    <main class="flex-1">

        <section class="faq-wrapper">

            {{-- Decorations --}}
            <div class="faq-deco-square-1"></div>
            <div class="faq-deco-square-2"></div>
            <div class="faq-deco-circle-1"></div>
            <div class="faq-deco-circle-2"></div>

            {{-- HERO --}}
            <div class="faq-hero">
                <span class="faq-badge">
                    FREQUENTLY ASKED QUESTION
                </span>

                <h1 class="faq-heading">
                    Pertanyaan yang Sering Ditanyakan
                </h1>

                <p class="faq-subtext">
                    Temukan jawaban tentang cara kerja SkillNest untuk mahasiswa dan UMKM.
                </p>
            </div>

            {{-- ACCORDION CARD --}}
            <div class="faq-card">

                @php
                    $faqs = [
                        [
                            'question' => 'Apa itu SkillNest?',
                            'answer'   => 'SkillNest adalah platform yang menghubungkan mahasiswa berbakat dengan UMKM yang membutuhkan jasa kreatif dan profesional. Mahasiswa dapat menawarkan keahlian mereka, sementara UMKM mendapatkan akses ke talenta berkualitas dengan harga terjangkau.',
                        ],
                        [
                            'question' => 'Siapa yang bisa menggunakan SkillNest?',
                            'answer'   => 'SkillNest dapat digunakan oleh mahasiswa aktif yang ingin menawarkan jasa dan membangun portofolio, serta oleh pelaku UMKM yang membutuhkan bantuan desain, pemasaran, teknologi, dan berbagai layanan lainnya.',
                        ],
                        [
                            'question' => 'Apakah SkillNest gratis?',
                            'answer'   => 'SkillNest menyediakan akses awal gratis. Fitur premium dapat ditambahkan untuk kebutuhan promosi dan rekomendasi lanjutan.',
                        ],
                        [
                            'question' => 'Bagaimana UMKM memesan jasa mahasiswa?',
                            'answer'   => 'UMKM cukup mendaftar, browse layanan yang tersedia, pilih penyedia jasa yang sesuai, lalu lakukan pemesanan melalui platform. Tim SkillNest akan memandu prosesnya hingga pekerjaan selesai.',
                        ],
                        [
                            'question' => 'Bagaimana sistem rating dan ulasan bekerja?',
                            'answer'   => 'Setelah setiap proyek selesai, UMKM dapat memberikan rating bintang dan ulasan tertulis kepada mahasiswa. Rating ini membantu membangun reputasi penyedia jasa dan membantu UMKM lain dalam memilih mitra terbaik.',
                        ],
                    ];
                @endphp

                @foreach ($faqs as $index => $faq)
                    <div class="faq-item {{ $index === 2 ? 'faq-item--active' : '' }}" data-faq="{{ $index }}">

                        <button class="faq-question" aria-expanded="{{ $index === 2 ? 'true' : 'false' }}">

                            <div class="faq-icon {{ $index === 2 ? 'faq-icon--active' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <line x1="12" y1="5" x2="12" y2="19" class="faq-plus-v"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                            </div>

                            <span class="faq-question-text">
                                {{ $faq['question'] }}
                            </span>

                        </button>

                        <div class="faq-answer {{ $index === 2 ? 'faq-answer--open' : '' }}">
                            <p class="faq-answer-text">
                                {{ $faq['answer'] }}
                            </p>
                        </div>

                    </div>
                @endforeach

            </div>

            {{-- CTA BANNER --}}
            <div class="faq-cta">

                <div class="faq-cta-content">
                    <div>
                        <h3 class="faq-cta-title">Masih punya pertanyaan?</h3>
                        <p class="faq-cta-sub">Hubungi tim SkillNest untuk bantuan lebih lanjut.</p>
                    </div>

                    <a href="{{ route('contact') }}" class="faq-cta-btn">
                        Contact Us
                    </a>
                </div>

            </div>

        </section>

    </main>

    @include('partials.footer')

    <script>
        document.querySelectorAll('.faq-question').forEach(function (btn) {
            btn.addEventListener('click', function () {
                const item   = this.closest('.faq-item');
                const answer = item.querySelector('.faq-answer');
                const icon   = item.querySelector('.faq-icon');
                const plusV  = item.querySelector('.faq-plus-v');
                const isOpen = item.classList.contains('faq-item--active');

                // Close all
                document.querySelectorAll('.faq-item').forEach(function (el) {
                    el.classList.remove('faq-item--active');
                    el.querySelector('.faq-answer').classList.remove('faq-answer--open');
                    el.querySelector('.faq-icon').classList.remove('faq-icon--active');
                    el.querySelector('.faq-question').setAttribute('aria-expanded', 'false');
                });

                // Open clicked (if it was closed)
                if (!isOpen) {
                    item.classList.add('faq-item--active');
                    answer.classList.add('faq-answer--open');
                    icon.classList.add('faq-icon--active');
                    this.setAttribute('aria-expanded', 'true');
                }
            });
        });
    </script>

</body>
</html>
