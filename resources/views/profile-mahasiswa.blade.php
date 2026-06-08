<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Mahasiswa - SkillNest</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .skill-badge:hover .skill-remove { opacity: 1; }
        .skill-remove { opacity: 0; transition: opacity .15s; }
        #skills-dropdown::-webkit-scrollbar { width: 4px; }
        #skills-dropdown::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
    </style>
</head>

<body class="bg-[#F6FAFF]">

<div class="min-h-screen flex">

    {{-- SIDEBAR --}}
    <aside class="w-72 bg-white border-r border-[#E2E8F0] p-6 shrink-0">

        <a href="{{ route('home') }}" class="flex items-center gap-3 mb-10">
            <img src="{{ asset('images/skillnestlogo.png') }}" alt="SkillNest" class="h-10">
            <span class="text-xl font-bold text-[#0F172A]">SkillNest</span>
        </a>

        <nav class="space-y-2">
            <a href="{{ route('dashboard.mahasiswa') }}" class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Dashboard</a>
            <a href="{{ route('profile.mahasiswa') }}" class="block rounded-xl bg-[#EAF2FF] px-4 py-3 font-semibold text-[#1846A3]">Profil Saya</a>
            <a href="{{ route('portfolio.mahasiswa') }}" class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Portfolio</a>
            <a href="{{ route('layanan.saya') }}" class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Layanan Saya</a>
            <a href="{{ route('chat') }}" class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Pesan</a>
        </nav>

    </aside>

    {{-- CONTENT --}}
    <main class="flex-1 p-10">

        <h1 class="text-4xl font-bold text-[#0F172A]">Profil Saya</h1>
        <p class="mt-2 text-slate-500">Lengkapi informasi profil agar lebih mudah ditemukan UMKM.</p>

        @if(session('success'))
            <div class="mt-6 rounded-xl bg-green-50 border border-green-200 px-5 py-3 text-sm font-semibold text-green-700">
                ✓ {{ session('success') }}
            </div>
        @endif

        {{-- PROFILE CARD --}}
        <div class="mt-8 rounded-[2rem] bg-white p-8 shadow-sm">

            <form action="{{ route('profile.mahasiswa.update') }}" method="POST">
                @csrf

                <div class="flex flex-col gap-8 lg:flex-row">

                    {{-- PHOTO --}}
                    <div class="flex flex-col items-center shrink-0">
                        <img
                            src="https://i.pravatar.cc/300?u={{ auth()->user()->email }}"
                            alt="profile"
                            class="h-40 w-40 rounded-full object-cover"
                        >
                        <button type="button" class="mt-4 rounded-xl bg-[#1846A3] px-5 py-2 text-sm font-semibold text-white">
                            Upload Foto
                        </button>
                    </div>

                    {{-- FORM --}}
                    <div class="flex-1">

                        <div class="grid gap-6 md:grid-cols-2">

                            <div>
                                <label class="mb-2 block text-sm font-semibold" for="name">Nama Lengkap</label>
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    value="{{ old('name', auth()->user()->name) }}"
                                    class="w-full rounded-xl border border-[#DCE7FB] px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-300 {{ $errors->has('name') ? 'border-red-400' : '' }}"
                                >
                                @error('name')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-semibold" for="nickname">Nama Panggilan</label>
                                <input
                                    type="text"
                                    id="nickname"
                                    name="nickname"
                                    value="{{ old('nickname', auth()->user()->nickname) }}"
                                    placeholder="Nama singkat kamu"
                                    class="w-full rounded-xl border border-[#DCE7FB] px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-300"
                                >
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-semibold" for="universitas">Universitas</label>
                                <input
                                    type="text"
                                    id="universitas"
                                    name="universitas"
                                    value="{{ old('universitas', auth()->user()->universitas) }}"
                                    placeholder="Nama universitas kamu"
                                    class="w-full rounded-xl border border-[#DCE7FB] px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-300"
                                >
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-semibold" for="jurusan">Jurusan</label>
                                <input
                                    type="text"
                                    id="jurusan"
                                    name="jurusan"
                                    value="{{ old('jurusan', auth()->user()->jurusan) }}"
                                    placeholder="Jurusan kamu"
                                    class="w-full rounded-xl border border-[#DCE7FB] px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-300"
                                >
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-semibold" for="semester">Semester</label>
                                <input
                                    type="text"
                                    id="semester"
                                    name="semester"
                                    value="{{ old('semester', auth()->user()->semester) }}"
                                    placeholder="Semester sekarang"
                                    class="w-full rounded-xl border border-[#DCE7FB] px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-300"
                                >
                            </div>

                        </div>

                        {{-- BIO --}}
                        <div class="mt-6">
                            <label class="mb-2 block text-sm font-semibold" for="bio">Bio</label>
                            <textarea
                                id="bio"
                                name="bio"
                                rows="4"
                                placeholder="Ceritakan sedikit tentang dirimu dan keahlianmu..."
                                class="w-full rounded-xl border border-[#DCE7FB] px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-300 resize-none"
                            >{{ old('bio', auth()->user()->bio) }}</textarea>
                        </div>

                        {{-- SKILLS PICKER --}}
                        <div class="mt-6">
                            <label class="mb-2 block text-sm font-semibold">Skills</label>

                            <input type="hidden" name="skills" id="skills-input">

                            <div class="relative" id="skills-container">

                                {{-- Tag area --}}
                                <div
                                    id="skills-display"
                                    class="min-h-[48px] w-full rounded-xl border border-[#DCE7FB] px-3 py-2 flex flex-wrap gap-2 items-center cursor-text focus-within:ring-2 focus-within:ring-blue-300"
                                    onclick="document.getElementById('skill-search').focus()"
                                >
                                    {{-- Badges rendered by JS --}}
                                    <input
                                        type="text"
                                        id="skill-search"
                                        placeholder="Cari atau ketik skill..."
                                        autocomplete="off"
                                        class="flex-1 min-w-[160px] outline-none text-sm bg-transparent py-1"
                                    >
                                </div>

                                {{-- Dropdown --}}
                                <div
                                    id="skills-dropdown"
                                    class="hidden absolute left-0 right-0 top-full mt-1 rounded-xl border border-slate-200 bg-white shadow-lg z-20 max-h-56 overflow-y-auto"
                                >
                                    <div id="dropdown-list" class="py-1"></div>
                                    <div id="dropdown-custom" class="hidden border-t border-slate-100 px-4 py-2.5 text-sm text-slate-500 italic"></div>
                                </div>

                            </div>

                            <p class="mt-2 text-xs text-slate-400">Klik area di atas, pilih dari daftar, atau ketik skill sendiri lalu tekan Enter.</p>
                        </div>

                        {{-- SUBMIT --}}
                        <button
                            type="submit"
                            class="mt-8 rounded-2xl bg-gradient-to-r from-[#2563EB] to-[#1149C7] px-8 py-4 text-sm font-semibold text-white hover:opacity-90 transition"
                        >
                            Simpan Profil
                        </button>

                    </div>

                </div>

            </form>

        </div>

    </main>

</div>

<script>
const PREDEFINED = [
    'Backend Developer','Frontend Developer','Full Stack Developer','Mobile Developer',
    'UI/UX Designer','DevOps Engineer','Data Analyst','Data Scientist','QA Engineer',
    'HTML','CSS','JavaScript','TypeScript','PHP','Python','Java','Kotlin','Swift',
    'Go','Ruby','C++','C#','Dart',
    'React','Vue.js','Angular','Next.js','Nuxt.js','Laravel','Django','Node.js',
    'Express.js','Spring Boot','Flutter','React Native',
    'Figma','Adobe XD','Photoshop','Illustrator','After Effects','Premiere Pro','Canva',
    'MySQL','PostgreSQL','MongoDB','Redis','Firebase','Supabase',
    'Docker','Git','Linux','AWS','Google Cloud','Vercel',
    'Tailwind CSS','Bootstrap','SASS',
    'Copywriting','Content Writing','SEO','Social Media Marketing',
    'Video Editing','Motion Graphics','3D Modeling',
];

let selected = @json(auth()->user()->skills ? json_decode(auth()->user()->skills, true) : []);

const display    = document.getElementById('skills-display');
const searchInput = document.getElementById('skill-search');
const dropdown   = document.getElementById('skills-dropdown');
const dropList   = document.getElementById('dropdown-list');
const dropCustom = document.getElementById('dropdown-custom');
const hiddenInput = document.getElementById('skills-input');

function renderBadges() {
    // Remove old badges (keep the search input)
    display.querySelectorAll('.skill-badge').forEach(el => el.remove());

    selected.forEach(skill => {
        const badge = document.createElement('span');
        badge.className = 'skill-badge inline-flex items-center gap-1 rounded-full bg-[#EAF2FF] px-3 py-1 text-sm font-semibold text-[#1846A3] select-none';
        badge.innerHTML = `
            ${skill}
            <button type="button" class="skill-remove ml-1 flex h-4 w-4 items-center justify-center rounded-full bg-[#1846A3] text-white text-xs leading-none hover:bg-red-500 transition"
                data-skill="${skill}">×</button>
        `;
        badge.querySelector('button').addEventListener('click', (e) => {
            e.stopPropagation();
            removeSkill(skill);
        });
        display.insertBefore(badge, searchInput);
    });

    hiddenInput.value = selected.join(',');
}

function addSkill(skill) {
    const clean = skill.trim();
    if (!clean || selected.map(s => s.toLowerCase()).includes(clean.toLowerCase())) return;
    selected.push(clean);
    renderBadges();
    renderDropdown('');
    searchInput.value = '';
    searchInput.focus();
}

function removeSkill(skill) {
    selected = selected.filter(s => s !== skill);
    renderBadges();
}

function renderDropdown(query) {
    const q = query.toLowerCase().trim();
    const available = PREDEFINED.filter(s =>
        !selected.map(x => x.toLowerCase()).includes(s.toLowerCase()) &&
        (q === '' || s.toLowerCase().includes(q))
    );

    dropList.innerHTML = '';

    if (available.length === 0 && q === '') {
        dropList.innerHTML = '<p class="px-4 py-3 text-sm text-slate-400">Semua skill populer sudah dipilih.</p>';
    } else {
        available.slice(0, 30).forEach(skill => {
            const item = document.createElement('button');
            item.type = 'button';
            item.className = 'w-full text-left px-4 py-2.5 text-sm text-slate-700 hover:bg-[#EAF2FF] hover:text-[#1846A3] transition';
            item.textContent = skill;
            item.addEventListener('mousedown', (e) => {
                e.preventDefault();
                addSkill(skill);
            });
            dropList.appendChild(item);
        });
    }

    // Custom skill hint
    const exactMatch = PREDEFINED.some(s => s.toLowerCase() === q);
    if (q && !exactMatch && !selected.map(s => s.toLowerCase()).includes(q)) {
        dropCustom.classList.remove('hidden');
        dropCustom.innerHTML = `Tekan <kbd class="rounded bg-slate-100 px-1.5 py-0.5 text-xs font-mono not-italic text-slate-600">Enter</kbd> untuk menambahkan "<strong class="not-italic text-slate-700">${query.trim()}</strong>"`;
    } else {
        dropCustom.classList.add('hidden');
    }
}

function showDropdown() {
    renderDropdown(searchInput.value);
    dropdown.classList.remove('hidden');
}

function hideDropdown() {
    dropdown.classList.add('hidden');
}

searchInput.addEventListener('focus', showDropdown);
searchInput.addEventListener('input', () => renderDropdown(searchInput.value));
searchInput.addEventListener('keydown', (e) => {
    if (e.key === 'Enter') {
        e.preventDefault();
        const val = searchInput.value.trim();
        if (val) addSkill(val);
    }
    if (e.key === 'Backspace' && searchInput.value === '' && selected.length > 0) {
        removeSkill(selected[selected.length - 1]);
    }
    if (e.key === 'Escape') hideDropdown();
});

document.addEventListener('click', (e) => {
    if (!document.getElementById('skills-container').contains(e.target)) {
        hideDropdown();
    }
});

// Init
renderBadges();
</script>

</body>
</html>
