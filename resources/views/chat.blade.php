<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan - SkillNest</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        html, body { height: 100%; overflow: hidden; }

        #chat-messages::-webkit-scrollbar,
        #contact-list::-webkit-scrollbar { width: 4px; }
        #chat-messages::-webkit-scrollbar-track,
        #contact-list::-webkit-scrollbar-track { background: transparent; }
        #chat-messages::-webkit-scrollbar-thumb,
        #contact-list::-webkit-scrollbar-thumb { background: #DCE7FB; border-radius: 99px; }

        @keyframes msgIn {
            from { opacity: 0; transform: translateY(6px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .msg-bubble { animation: msgIn 0.18s ease-out; }

        @keyframes bounce {
            0%, 80%, 100% { transform: translateY(0); }
            40%            { transform: translateY(-4px); }
        }
        .dot { animation: bounce 1.2s infinite; }
        .dot:nth-child(2) { animation-delay: 0.2s; }
        .dot:nth-child(3) { animation-delay: 0.4s; }
    </style>
</head>

<body class="bg-[#F6FAFF]">

<div class="flex h-screen overflow-hidden">

    {{-- ══════════════════════════════════════════
         PANEL 1 — NAVIGASI SIDEBAR
    ══════════════════════════════════════════ --}}
    <aside class="w-64 flex-shrink-0 bg-white border-r border-[#E2E8F0] flex flex-col p-6">

        <a href="{{ route('home') }}" class="flex items-center gap-3 mb-10">
            <img src="{{ asset('images/skillnestlogo.png') }}" class="h-10" alt="SkillNest">
            <span class="text-xl font-bold text-[#0F172A]">SkillNest</span>
        </a>

        <nav class="space-y-2 flex-1">
            <a href="{{ route('dashboard.mahasiswa') }}"
               class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Dashboard</a>
            <a href="{{ route('profile.mahasiswa') }}"
               class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Profil Saya</a>
            <a href="{{ route('portfolio.mahasiswa') }}"
               class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Portfolio</a>
            <a href="{{ route('layanan.saya') }}"
               class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Layanan Saya</a>
            <a href="{{ route('chat') }}"
               class="block rounded-xl bg-[#EAF2FF] px-4 py-3 font-semibold text-[#1846A3]">Pesan</a>
        </nav>

    </aside>

    {{-- ══════════════════════════════════════════
         PANEL 2 — DAFTAR CHAT
    ══════════════════════════════════════════ --}}
    <div class="w-80 flex-shrink-0 bg-white border-r border-[#E2E8F0] flex flex-col">

        {{-- Header --}}
        <div class="p-5 border-b border-[#E2E8F0]">
            <h2 class="text-lg font-bold text-[#0F172A]">Pesan</h2>
            <p class="text-xs text-slate-400 mt-0.5">{{ auth()->user()->name }}</p>
        </div>

        {{-- Search --}}
        <div class="px-4 py-3 border-b border-[#E2E8F0]">
            <div class="relative">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input
                    type="text"
                    placeholder="Cari percakapan..."
                    class="w-full rounded-xl bg-[#F6FAFF] border border-[#E2E8F0] pl-9 pr-4 py-2.5 text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:border-[#2563EB]"
                    oninput="filterContacts(this.value)"
                >
            </div>
        </div>

        {{-- Contact list --}}
        <div id="contact-list" class="flex-1 overflow-y-auto">

            @php
            $contacts = [
                [
                    'id'       => 1,
                    'name'     => 'Bambang Ronaldo',
                    'role'     => 'Web Designer',
                    'avatar'   => 'https://i.pravatar.cc/150?u=bambang',
                    'last_msg' => 'Apakah harga Rp100.000 sesuai budget Anda?',
                    'time'     => '09.10',
                    'unread'   => 1,
                    'online'   => true,
                ],
                [
                    'id'       => 2,
                    'name'     => 'Siti Rahayu',
                    'role'     => 'UI/UX Designer',
                    'avatar'   => 'https://i.pravatar.cc/150?u=siti',
                    'last_msg' => 'Siap kak, nanti saya kirim draftnya!',
                    'time'     => 'Kemarin',
                    'unread'   => 0,
                    'online'   => false,
                ],
                [
                    'id'       => 3,
                    'name'     => 'Dito Prasetyo',
                    'role'     => 'Content Creator',
                    'avatar'   => 'https://i.pravatar.cc/150?u=dito',
                    'last_msg' => 'Baik, terima kasih sudah mempercayai saya 🙏',
                    'time'     => 'Sen',
                    'unread'   => 0,
                    'online'   => true,
                ],
                [
                    'id'       => 4,
                    'name'     => 'Mega Wulandari',
                    'role'     => 'Fotografer',
                    'avatar'   => 'https://i.pravatar.cc/150?u=mega',
                    'last_msg' => 'Foto produknya sudah saya edit semua kak',
                    'time'     => 'Ming',
                    'unread'   => 3,
                    'online'   => false,
                ],
            ];
            @endphp

            @foreach($contacts as $c)
            <button
                id="contact-{{ $c['id'] }}"
                onclick="openChat({{ $c['id'] }})"
                class="contact-item w-full flex items-center gap-3 px-4 py-3.5 hover:bg-[#F6FAFF] transition text-left border-b border-[#F1F5F9]
                       {{ $c['id'] === 1 ? 'bg-[#EAF2FF] border-l-2 border-l-[#2563EB]' : '' }}"
                data-name="{{ strtolower($c['name']) }}"
            >
                {{-- Avatar --}}
                <div class="relative flex-shrink-0">
                    <img src="{{ $c['avatar'] }}" alt="{{ $c['name'] }}"
                         class="h-12 w-12 rounded-full object-cover">
                    @if($c['online'])
                        <span class="absolute bottom-0 right-0 h-3 w-3 rounded-full border-2 border-white bg-emerald-400"></span>
                    @endif
                </div>

                {{-- Info --}}
                <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-semibold text-[#0F172A] truncate">{{ $c['name'] }}</p>
                        <span class="text-[10px] text-slate-400 flex-shrink-0 ml-2">{{ $c['time'] }}</span>
                    </div>
                    <div class="flex items-center justify-between mt-0.5">
                        <p class="text-xs text-slate-500 truncate pr-2">{{ $c['last_msg'] }}</p>
                        @if($c['unread'] > 0)
                            <span class="flex-shrink-0 h-5 w-5 rounded-full bg-[#2563EB] text-white text-[10px] font-bold flex items-center justify-center">
                                {{ $c['unread'] }}
                            </span>
                        @endif
                    </div>
                </div>
            </button>
            @endforeach

        </div>

    </div>

    {{-- ══════════════════════════════════════════
         PANEL 3 — RUANG CHAT
    ══════════════════════════════════════════ --}}
    <div class="flex-1 flex flex-col overflow-hidden">

        {{-- TOP BAR --}}
        <header class="flex-shrink-0 flex items-center gap-4 border-b border-[#E2E8F0] bg-white px-6 py-4">
            <div class="relative flex-shrink-0">
                <img id="chat-avatar" src="https://i.pravatar.cc/150?u=bambang"
                     class="h-11 w-11 rounded-full object-cover">
                <span id="chat-online-dot" class="absolute bottom-0 right-0 h-3 w-3 rounded-full border-2 border-white bg-emerald-400"></span>
            </div>
            <div class="flex-1 min-w-0">
                <p id="chat-name" class="text-sm font-bold text-[#0F172A]">Bambang Ronaldo</p>
                <p id="chat-status" class="text-xs text-emerald-500 font-semibold">Online</p>
            </div>
            <div class="flex-shrink-0 hidden sm:flex items-center gap-2 rounded-2xl border border-[#DCE7FB] bg-[#F6FAFF] px-4 py-2">
                <span id="chat-role" class="text-xs font-semibold text-[#64748B]">Web Designer</span>
                <span class="h-1 w-1 rounded-full bg-[#CBD5E1]"></span>
                <span class="text-xs font-bold text-[#1846A3]">Rp50.000+</span>
            </div>
        </header>

        {{-- NOTICE BANNER --}}
        <div class="flex-shrink-0 bg-[#FFF8E7] border-b border-[#FDE68A] px-6 py-2.5">
            <p class="text-xs text-[#92400E] text-center font-medium">
                💡 Gunakan chat ini untuk negosiasi & diskusi. Pembayaran di luar platform? Bisa juga via WhatsApp setelah deal.
            </p>
        </div>

        {{-- MESSAGES --}}
        <div id="chat-messages" class="flex-1 overflow-y-auto px-6 py-5 space-y-4 bg-[#F6FAFF]">

            <div class="flex items-center gap-3">
                <div class="flex-1 h-px bg-[#E2E8F0]"></div>
                <span class="text-xs font-semibold text-[#94A3B8]">Hari ini</span>
                <div class="flex-1 h-px bg-[#E2E8F0]"></div>
            </div>

            {{-- Incoming --}}
            <div class="flex items-end gap-2.5 msg-bubble">
                <img src="https://i.pravatar.cc/150?u=bambang" class="h-8 w-8 rounded-full object-cover flex-shrink-0 mb-1">
                <div class="max-w-[65%]">
                    <div class="rounded-3xl rounded-bl-lg bg-white border border-[#DCE7FB] px-4 py-3 shadow-sm">
                        <p class="text-sm leading-6 text-[#0F172A]">Halo! Saya Bambang 👋 Ada yang bisa saya bantu untuk kebutuhan desain website Anda?</p>
                    </div>
                    <p class="mt-1 ml-2 text-[10px] text-[#94A3B8]">09.00</p>
                </div>
            </div>

            {{-- Outgoing --}}
            <div class="flex items-end justify-end gap-2.5 msg-bubble">
                <div class="max-w-[65%]">
                    <div class="rounded-3xl rounded-br-lg bg-gradient-to-br from-[#2563EB] to-[#1149C7] px-4 py-3 shadow-lg shadow-blue-500/20">
                        <p class="text-sm leading-6 text-white">Halo Bambang! Saya butuh landing page untuk toko online saya. Kira-kira berapa estimasi biayanya?</p>
                    </div>
                    <p class="mt-1 mr-2 text-right text-[10px] text-[#94A3B8]">09.02</p>
                </div>
            </div>

            {{-- Incoming --}}
            <div class="flex items-end gap-2.5 msg-bubble">
                <img src="https://i.pravatar.cc/150?u=bambang" class="h-8 w-8 rounded-full object-cover flex-shrink-0 mb-1">
                <div class="max-w-[65%]">
                    <div class="rounded-3xl rounded-bl-lg bg-white border border-[#DCE7FB] px-4 py-3 shadow-sm">
                        <p class="text-sm leading-6 text-[#0F172A]">Untuk landing page toko online, mulai dari <strong class="text-[#2563EB]">Rp75.000 – Rp150.000</strong> tergantung kompleksitas fiturnya. Bisa ceritakan lebih detail? 😊</p>
                    </div>
                    <p class="mt-1 ml-2 text-[10px] text-[#94A3B8]">09.04</p>
                </div>
            </div>

            {{-- Outgoing --}}
            <div class="flex items-end justify-end gap-2.5 msg-bubble">
                <div class="max-w-[65%]">
                    <div class="rounded-3xl rounded-br-lg bg-gradient-to-br from-[#2563EB] to-[#1149C7] px-4 py-3 shadow-lg shadow-blue-500/20">
                        <p class="text-sm leading-6 text-white">Saya jual produk makanan ringan. Butuh tampilan yang menarik, ada section produk, testimoni, dan kontak. Estimasi berapa hari?</p>
                    </div>
                    <p class="mt-1 mr-2 text-right text-[10px] text-[#94A3B8]">09.07</p>
                </div>
            </div>

            {{-- Incoming --}}
            <div class="flex items-end gap-2.5 msg-bubble">
                <img src="https://i.pravatar.cc/150?u=bambang" class="h-8 w-8 rounded-full object-cover flex-shrink-0 mb-1">
                <div class="max-w-[65%]">
                    <div class="rounded-3xl rounded-bl-lg bg-white border border-[#DCE7FB] px-4 py-3 shadow-sm">
                        <p class="text-sm leading-6 text-[#0F172A]">Kebutuhan Anda cukup jelas! Estimasi pengerjaan sekitar <strong>3-4 hari kerja</strong>. Saya bisa mulai secepatnya setelah deal. Apakah harga <strong class="text-[#2563EB]">Rp100.000</strong> sesuai budget Anda? 🙏</p>
                    </div>
                    <p class="mt-1 ml-2 text-[10px] text-[#94A3B8]">09.10</p>
                </div>
            </div>

            {{-- Typing indicator --}}
            <div id="typing-indicator" class="items-end gap-2.5" style="display:none">
                <img id="typing-avatar" src="https://i.pravatar.cc/150?u=bambang"
                     class="h-8 w-8 rounded-full object-cover flex-shrink-0 mb-1">
                <div class="rounded-3xl rounded-bl-lg bg-white border border-[#DCE7FB] px-4 py-3 shadow-sm">
                    <div class="flex items-center gap-1.5">
                        <span class="dot h-2 w-2 rounded-full bg-[#94A3B8]"></span>
                        <span class="dot h-2 w-2 rounded-full bg-[#94A3B8]"></span>
                        <span class="dot h-2 w-2 rounded-full bg-[#94A3B8]"></span>
                    </div>
                </div>
            </div>

        </div>

        {{-- INPUT AREA --}}
        <div class="flex-shrink-0 border-t border-[#E2E8F0] bg-white px-6 py-4">
            <div class="flex items-end gap-3">

                <button class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-xl border border-[#DCE7FB] bg-[#F6FAFF] text-slate-500 hover:bg-[#EAF2FF] transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                    </svg>
                </button>

                <div class="flex-1">
                    <textarea
                        id="message-input"
                        rows="1"
                        placeholder="Tulis pesan..."
                        class="w-full resize-none rounded-2xl border border-[#DCE7FB] bg-[#F6FAFF] px-5 py-3 text-sm text-[#0F172A] placeholder-slate-400 outline-none focus:border-[#2563EB] focus:bg-white transition"
                        style="max-height: 100px; overflow-y: auto;"
                        oninput="autoResize(this)"
                        onkeydown="handleEnter(event)"
                    ></textarea>
                </div>

                <button onclick="sendMessage()"
                    class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-[#2563EB] to-[#1149C7] text-white shadow-lg shadow-blue-500/20 hover:opacity-90 active:scale-95 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M3.478 2.405a.75.75 0 00-.926.94l2.432 7.905H13.5a.75.75 0 010 1.5H4.984l-2.432 7.905a.75.75 0 00.926.94 60.519 60.519 0 0018.445-8.986.75.75 0 000-1.218A60.517 60.517 0 003.478 2.405z"/>
                    </svg>
                </button>

            </div>

            <div class="mt-2.5 flex items-center justify-center gap-2">
                <p class="text-[11px] text-slate-400">Lebih nyaman di luar platform?</p>
                <a href="https://wa.me/" target="_blank"
                   class="inline-flex items-center gap-1 rounded-lg bg-emerald-50 px-2.5 py-1 text-[11px] font-semibold text-emerald-600 hover:bg-emerald-100 transition">
                    <svg class="h-3 w-3" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    Lanjut di WhatsApp
                </a>
            </div>
        </div>

    </div>{{-- end panel 3 --}}

</div>{{-- end flex wrapper --}}

<script>
// ── Data kontak (sinkron dengan PHP di atas) ──────────────────────────────
const contacts = {
    1: { name: 'Bambang Ronaldo', role: 'Web Designer',    avatar: 'https://i.pravatar.cc/150?u=bambang', online: true  },
    2: { name: 'Siti Rahayu',    role: 'UI/UX Designer',   avatar: 'https://i.pravatar.cc/150?u=siti',    online: false },
    3: { name: 'Dito Prasetyo',  role: 'Content Creator',  avatar: 'https://i.pravatar.cc/150?u=dito',    online: true  },
    4: { name: 'Mega Wulandari', role: 'Fotografer',        avatar: 'https://i.pravatar.cc/150?u=mega',    online: false },
};

let activeId = 1;

function openChat(id) {
    // Hapus highlight semua kontak
    document.querySelectorAll('.contact-item').forEach(el => {
        el.classList.remove('bg-[#EAF2FF]', 'border-l-2', 'border-l-[#2563EB]');
    });

    // Highlight kontak terpilih
    const btn = document.getElementById('contact-' + id);
    if (btn) {
        btn.classList.add('bg-[#EAF2FF]', 'border-l-2', 'border-l-[#2563EB]');
        // Hapus badge unread
        const badge = btn.querySelector('span.bg-\\[\\#2563EB\\]');
        if (badge) badge.remove();
    }

    // Update header chat
    const c = contacts[id];
    if (!c) return;
    activeId = id;

    document.getElementById('chat-avatar').src     = c.avatar;
    document.getElementById('chat-name').textContent  = c.name;
    document.getElementById('chat-role').textContent  = c.role;
    document.getElementById('typing-avatar').src      = c.avatar;

    const onlineDot    = document.getElementById('chat-online-dot');
    const statusText   = document.getElementById('chat-status');
    if (c.online) {
        onlineDot.classList.remove('hidden');
        statusText.textContent  = 'Online';
        statusText.className    = 'text-xs text-emerald-500 font-semibold';
    } else {
        onlineDot.classList.add('hidden');
        statusText.textContent  = 'Offline';
        statusText.className    = 'text-xs text-slate-400 font-semibold';
    }
}

// ── Filter kontak ────────────────────────────────────────────────────────
function filterContacts(query) {
    const q = query.toLowerCase();
    document.querySelectorAll('.contact-item').forEach(el => {
        const match = el.dataset.name.includes(q);
        el.style.display = match ? '' : 'none';
    });
}

// ── Chat functions ───────────────────────────────────────────────────────
function autoResize(el) {
    el.style.height = 'auto';
    el.style.height = Math.min(el.scrollHeight, 100) + 'px';
}

function handleEnter(e) {
    if (e.key === 'Enter' && !e.shiftKey) {
        e.preventDefault();
        sendMessage();
    }
}

function sendMessage() {
    const input = document.getElementById('message-input');
    const text  = input.value.trim();
    if (!text) return;

    const container = document.getElementById('chat-messages');
    const now  = new Date();
    const time = now.getHours().toString().padStart(2,'0') + '.' + now.getMinutes().toString().padStart(2,'0');

    const wrap = document.createElement('div');
    wrap.className = 'flex items-end justify-end gap-2.5 msg-bubble';
    wrap.innerHTML = `
        <div class="max-w-[65%]">
            <div class="rounded-3xl rounded-br-lg bg-gradient-to-br from-[#2563EB] to-[#1149C7] px-4 py-3 shadow-lg shadow-blue-500/20">
                <p class="text-sm leading-6 text-white whitespace-pre-wrap">${escapeHtml(text)}</p>
            </div>
            <p class="mt-1 mr-2 text-right text-[10px] text-[#94A3B8]">${time}</p>
        </div>`;

    const typing = document.getElementById('typing-indicator');
    container.insertBefore(wrap, typing);
    input.value = '';
    input.style.height = 'auto';
    scrollToBottom();

    setTimeout(() => { typing.style.display = 'flex'; scrollToBottom(); }, 500);
    setTimeout(() => { typing.style.display = 'none'; }, 2400);
}

function escapeHtml(text) {
    return text
        .replace(/&/g, '&amp;').replace(/</g, '&lt;')
        .replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}

function scrollToBottom() {
    const el = document.getElementById('chat-messages');
    el.scrollTop = el.scrollHeight;
}

scrollToBottom();
</script>

</body>
</html>
