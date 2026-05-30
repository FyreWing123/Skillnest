<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Chat - SkillNest</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>
        /* Scrollbar styling for chat area */
        #chat-messages::-webkit-scrollbar {
            width: 4px;
        }
        #chat-messages::-webkit-scrollbar-track {
            background: transparent;
        }
        #chat-messages::-webkit-scrollbar-thumb {
            background: #DCE7FB;
            border-radius: 99px;
        }

        /* Smooth message pop-in */
        @keyframes msgIn {
            from { opacity: 0; transform: translateY(8px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .msg-bubble {
            animation: msgIn 0.2s ease-out;
        }

        /* Typing indicator dots */
        @keyframes bounce {
            0%, 80%, 100% { transform: translateY(0); }
            40%            { transform: translateY(-5px); }
        }
        .dot { animation: bounce 1.2s infinite; }
        .dot:nth-child(2) { animation-delay: 0.2s; }
        .dot:nth-child(3) { animation-delay: 0.4s; }
    </style>
</head>

<body class="bg-[#F6FAFF] font-[instrument-sans] min-h-screen flex items-center justify-center p-6">

<div class="w-full max-w-xl h-[85vh] flex flex-col rounded-[2rem] border border-[#DCE7FB] bg-white shadow-xl overflow-hidden">

    {{-- TOP BAR --}}
    <header class="flex-shrink-0 flex items-center gap-4 border-b border-[#DCE7FB] bg-white px-6 py-4">

        {{-- Back --}}
        <a href="{{ route('service.detail') }}"
            class="flex h-9 w-9 items-center justify-center rounded-xl border border-[#DCE7FB] bg-[#F6FAFF] text-[#64748B] transition hover:bg-[#EAF2FF] flex-shrink-0">
            ←
        </a>

        {{-- Avatar + Info --}}
        <div class="flex items-center gap-3 flex-1 min-w-0">
            <div class="relative flex-shrink-0">
                <img
                    src="https://i.pravatar.cc/150?u=BambangRonaldo"
                    alt="Bambang Ronaldo"
                    class="h-11 w-11 rounded-full object-cover"
                >
                {{-- Online indicator --}}
                <span class="absolute bottom-0 right-0 h-3 w-3 rounded-full border-2 border-white bg-emerald-400"></span>
            </div>

            <div class="min-w-0">
                <p class="text-sm font-bold text-[#0F172A] truncate">Bambang Ronaldo</p>
                <p class="text-xs text-emerald-500 font-semibold">Online</p>
            </div>
        </div>

        {{-- Info badge --}}
        <div class="flex-shrink-0 hidden sm:flex items-center gap-2 rounded-2xl border border-[#DCE7FB] bg-[#F6FAFF] px-4 py-2">
            <span class="text-xs font-semibold text-[#64748B]">Web Designer</span>
            <span class="h-1 w-1 rounded-full bg-[#CBD5E1]"></span>
            <span class="text-xs font-bold text-[#1846A3]">Rp50.000+</span>
        </div>

    </header>

    {{-- NOTICE BANNER --}}
    <div class="flex-shrink-0 bg-[#FFF8E7] border-b border-[#FDE68A] px-6 py-3">
        <p class="text-xs text-[#92400E] text-center font-medium">
            💡 Gunakan chat ini untuk negosiasi & diskusi. Pembayaran di luar platform? Bisa juga via WhatsApp setelah deal.
        </p>
    </div>

    {{-- CHAT MESSAGES --}}
    <div id="chat-messages" class="flex-1 overflow-y-auto px-6 py-6 space-y-5">

        {{-- Date separator --}}
        <div class="flex items-center gap-3">
            <div class="flex-1 h-px bg-[#E2E8F0]"></div>
            <span class="text-xs font-semibold text-[#94A3B8]">Hari ini</span>
            <div class="flex-1 h-px bg-[#E2E8F0]"></div>
        </div>

        {{-- Message from freelancer --}}
        <div class="flex items-end gap-3 msg-bubble">
            <img src="https://i.pravatar.cc/150?u=BambangRonaldo" alt="Bambang"
                class="h-8 w-8 rounded-full object-cover flex-shrink-0 mb-1">
            <div class="max-w-[70%]">
                <div class="rounded-3xl rounded-bl-lg bg-white border border-[#DCE7FB] px-5 py-3 shadow-sm">
                    <p class="text-sm leading-6 text-[#0F172A]">
                        Halo! Saya Bambang 👋 Ada yang bisa saya bantu untuk kebutuhan desain website Anda?
                    </p>
                </div>
                <p class="mt-1.5 ml-2 text-[10px] text-[#94A3B8]">09.00</p>
            </div>
        </div>

        {{-- Message from client --}}
        <div class="flex items-end justify-end gap-3 msg-bubble">
            <div class="max-w-[70%]">
                <div class="rounded-3xl rounded-br-lg bg-gradient-to-br from-[#2563EB] to-[#1149C7] px-5 py-3 shadow-lg shadow-blue-500/20">
                    <p class="text-sm leading-6 text-white">
                        Halo Bambang! Saya butuh landing page untuk toko online saya. Kira-kira berapa estimasi biayanya?
                    </p>
                </div>
                <p class="mt-1.5 mr-2 text-right text-[10px] text-[#94A3B8]">09.02</p>
            </div>
        </div>

        {{-- Message from freelancer --}}
        <div class="flex items-end gap-3 msg-bubble">
            <img src="https://i.pravatar.cc/150?u=BambangRonaldo" alt="Bambang"
                class="h-8 w-8 rounded-full object-cover flex-shrink-0 mb-1">
            <div class="max-w-[70%]">
                <div class="rounded-3xl rounded-bl-lg bg-white border border-[#DCE7FB] px-5 py-3 shadow-sm">
                    <p class="text-sm leading-6 text-[#0F172A]">
                        Untuk landing page toko online, biasanya mulai dari <strong class="text-[#2563EB]">Rp75.000 - Rp150.000</strong> tergantung kompleksitas fiturnya. Bisa ceritakan lebih detail kebutuhannya? 😊
                    </p>
                </div>
                <p class="mt-1.5 ml-2 text-[10px] text-[#94A3B8]">09.04</p>
            </div>
        </div>

        {{-- Message from client --}}
        <div class="flex items-end justify-end gap-3 msg-bubble">
            <div class="max-w-[70%]">
                <div class="rounded-3xl rounded-br-lg bg-gradient-to-br from-[#2563EB] to-[#1149C7] px-5 py-3 shadow-lg shadow-blue-500/20">
                    <p class="text-sm leading-6 text-white">
                        Saya jual produk makanan ringan. Butuh tampilan yang menarik, ada section produk, testimoni, dan kontak. Estimasi berapa hari?
                    </p>
                </div>
                <p class="mt-1.5 mr-2 text-right text-[10px] text-[#94A3B8]">09.07</p>
            </div>
        </div>

        {{-- Message from freelancer --}}
        <div class="flex items-end gap-3 msg-bubble">
            <img src="https://i.pravatar.cc/150?u=BambangRonaldo" alt="Bambang"
                class="h-8 w-8 rounded-full object-cover flex-shrink-0 mb-1">
            <div class="max-w-[70%]">
                <div class="rounded-3xl rounded-bl-lg bg-white border border-[#DCE7FB] px-5 py-3 shadow-sm">
                    <p class="text-sm leading-6 text-[#0F172A]">
                        Kebutuhan Anda cukup jelas! Estimasi pengerjaan sekitar <strong class="text-[#0F172A]">3-4 hari kerja</strong>. Saya bisa mulai secepatnya setelah deal. Apakah harga <strong class="text-[#2563EB]">Rp100.000</strong> sesuai budget Anda? 🙏
                    </p>
                </div>
                <p class="mt-1.5 ml-2 text-[10px] text-[#94A3B8]">09.10</p>
            </div>
        </div>

        {{-- Typing indicator (hidden by default) --}}
        <div id="typing-indicator" class="flex items-end gap-3 hidden">
            <img src="https://i.pravatar.cc/150?u=BambangRonaldo" alt="Bambang"
                class="h-8 w-8 rounded-full object-cover flex-shrink-0 mb-1">
            <div class="rounded-3xl rounded-bl-lg bg-white border border-[#DCE7FB] px-5 py-3 shadow-sm">
                <div class="flex items-center gap-1.5">
                    <span class="dot h-2 w-2 rounded-full bg-[#94A3B8]"></span>
                    <span class="dot h-2 w-2 rounded-full bg-[#94A3B8]"></span>
                    <span class="dot h-2 w-2 rounded-full bg-[#94A3B8]"></span>
                </div>
            </div>
        </div>

    </div>

    {{-- INPUT AREA --}}
    <div class="flex-shrink-0 border-t border-[#DCE7FB] bg-white px-6 py-4">
        <div class="flex items-end gap-3">

            {{-- Attachment button --}}
            <button
                class="flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-2xl border border-[#DCE7FB] bg-[#F6FAFF] text-[#64748B] transition hover:bg-[#EAF2FF]"
                title="Lampirkan file"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                </svg>
            </button>

            {{-- Text input --}}
            <div class="flex-1 relative">
                <textarea
                    id="message-input"
                    rows="1"
                    placeholder="Tulis pesan..."
                    class="w-full resize-none rounded-2xl border border-[#DCE7FB] bg-[#F6FAFF] px-5 py-3 text-sm text-[#0F172A] placeholder-[#94A3B8] outline-none transition focus:border-[#2563EB] focus:bg-white"
                    style="max-height: 120px; overflow-y: auto;"
                    onInput="autoResize(this)"
                    onKeydown="handleEnter(event)"
                ></textarea>
            </div>

            {{-- Send button --}}
            <button
                id="send-btn"
                onclick="sendMessage()"
                class="flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-[#2563EB] to-[#1149C7] text-white shadow-lg shadow-blue-500/20 transition hover:opacity-90 active:scale-95"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M3.478 2.405a.75.75 0 00-.926.94l2.432 7.905H13.5a.75.75 0 010 1.5H4.984l-2.432 7.905a.75.75 0 00.926.94 60.519 60.519 0 0018.445-8.986.75.75 0 000-1.218A60.517 60.517 0 003.478 2.405z"/>
                </svg>
            </button>

        </div>

        {{-- WhatsApp shortcut --}}
        <div class="mt-3 flex items-center justify-center gap-2">
            <p class="text-[11px] text-[#94A3B8]">Lebih nyaman di luar platform?</p>
            <a href="https://wa.me/6281234567890" target="_blank"
                class="inline-flex items-center gap-1 rounded-lg bg-emerald-50 px-2.5 py-1 text-[11px] font-semibold text-emerald-600 transition hover:bg-emerald-100">
                <svg class="h-3 w-3" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                </svg>
                Lanjut di WhatsApp
            </a>
        </div>
    </div>

</div>{{-- end card --}}

<script>
        // Auto-resize textarea
        function autoResize(el) {
            el.style.height = 'auto';
            el.style.height = Math.min(el.scrollHeight, 120) + 'px';
        }

        // Send on Enter (Shift+Enter = new line)
        function handleEnter(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendMessage();
            }
        }

        function sendMessage() {
            const input = document.getElementById('message-input');
            const text = input.value.trim();
            if (!text) return;

            const container = document.getElementById('chat-messages');

            // Build outgoing bubble
            const now = new Date();
            const time = now.getHours().toString().padStart(2,'0') + '.' + now.getMinutes().toString().padStart(2,'0');

            const wrapper = document.createElement('div');
            wrapper.className = 'flex items-end justify-end gap-3 msg-bubble';
            wrapper.innerHTML = `
                <div class="max-w-[70%]">
                    <div class="rounded-3xl rounded-br-lg bg-gradient-to-br from-[#2563EB] to-[#1149C7] px-5 py-3 shadow-lg shadow-blue-500/20">
                        <p class="text-sm leading-6 text-white whitespace-pre-wrap">${escapeHtml(text)}</p>
                    </div>
                    <p class="mt-1.5 mr-2 text-right text-[10px] text-[#94A3B8]">${time}</p>
                </div>
            `;

            // Insert before typing indicator
            const typing = document.getElementById('typing-indicator');
            container.insertBefore(wrapper, typing);

            // Clear input
            input.value = '';
            input.style.height = 'auto';

            // Scroll to bottom
            scrollToBottom();

            // Show typing indicator after short delay
            setTimeout(() => {
                typing.classList.remove('hidden');
                scrollToBottom();
            }, 600);

            // Hide typing after 2s (simulate reply)
            setTimeout(() => {
                typing.classList.add('hidden');
            }, 2600);
        }

        function escapeHtml(text) {
            return text
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;');
        }

        function scrollToBottom() {
            const container = document.getElementById('chat-messages');
            container.scrollTop = container.scrollHeight;
        }

        // Scroll to bottom on load
        scrollToBottom();
    </script>

</body>
</html>