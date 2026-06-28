<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Layanan - SkillNest</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
            <a href="{{ route('profile.mahasiswa') }}" class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Profil Saya</a>
            <a href="{{ route('portfolio.mahasiswa') }}" class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Portfolio</a>
            <a href="{{ route('layanan.saya') }}" class="block rounded-xl bg-[#EAF2FF] px-4 py-3 font-semibold text-[#1846A3]">Layanan Saya</a>
            <a href="{{ route('chat') }}" class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">Pesan</a>
        </nav>

    </aside>

    {{-- CONTENT --}}
    <main class="flex-1 p-10">

        <div class="max-w-3xl">

            <div class="flex items-center gap-3 mb-8">
                <a href="{{ route('layanan.saya') }}" class="text-slate-400 hover:text-slate-600 transition">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
                <h1 class="text-4xl font-bold text-[#0F172A]">Tambah Layanan</h1>
            </div>

            <p class="text-slate-500 -mt-4 mb-8">Buat layanan baru yang akan tampil di marketplace SkillNest.</p>

            <div class="rounded-[2rem] border border-[#DCE7FB] bg-white p-8 shadow-sm">

                @if($errors->any())
                    <div class="mb-6 rounded-xl bg-red-50 border border-red-200 p-4">
                        <ul class="text-sm text-red-600 space-y-1 list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('layanan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                    <div>
                        <label class="mb-2 block text-sm font-semibold">Nama Layanan</label>
                        <input
                            type="text"
                            name="nama"
                            value="{{ old('nama') }}"
                            placeholder="Landing Page UMKM"
                            class="w-full rounded-xl border px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-300 {{ $errors->has('nama') ? 'border-red-400' : 'border-[#DCE7FB]' }}"
                        >
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold">Kategori</label>
                        <select name="kategori" class="w-full rounded-xl border border-[#DCE7FB] px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-300">
                            @foreach(['Web Development','UI/UX Design','Desain Grafis','Fotografi','Videografi','Copywriting','Social Media','Mobile App','Digital Marketing','Content Creation','Admin Support'] as $kat)
                                <option value="{{ $kat }}" {{ old('kategori') === $kat ? 'selected' : '' }}>{{ $kat }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid gap-6 md:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-semibold">Harga (Rp)</label>
                            <input
                                id="input-harga"
                                type="text"
                                name="harga"
                                placeholder="500000"
                                inputmode="numeric"
                                class="w-full rounded-xl border border-[#DCE7FB] px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-300"
                                oninput="updatePreviewHarga(this.value)"
                            >
                            <p class="mt-2 text-sm text-slate-400">
                                Akan ditampilkan sebagai:
                                <span id="preview-harga" class="font-bold text-[#1846A3]">—</span>
                            </p>
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-semibold">Estimasi Pengerjaan</label>
                            <input
                                type="text"
                                name="estimasi"
                                placeholder="3 Hari"
                                class="w-full rounded-xl border border-[#DCE7FB] px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-300"
                            >
                        </div>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold">Thumbnail</label>
                        <input
                            type="file"
                            name="thumbnail"
                            class="w-full rounded-xl border border-[#DCE7FB] px-4 py-3 text-sm text-slate-500 file:mr-4 file:rounded-lg file:border-0 file:bg-[#EAF2FF] file:px-4 file:py-2 file:text-sm file:font-semibold file:text-[#1846A3]"
                        >
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold">
                            Deskripsi Singkat
                            <span class="font-normal text-slate-400">(ditampilkan di card layanan)</span>
                        </label>
                        <textarea
                            id="deskripsi-singkat"
                            name="deskripsi_singkat"
                            rows="2"
                            maxlength="150"
                            placeholder="Contoh: Landing page profesional untuk UMKM, bisnis lokal, company profile, dan promosi digital."
                            class="w-full rounded-xl border border-[#DCE7FB] px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-300 resize-none"
                            oninput="updateCharCount(this)"
                        ></textarea>
                        <p class="mt-1 text-right text-xs text-slate-400">
                            <span id="char-count">0</span>/150 karakter
                        </p>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold">
                            Deskripsi Detail
                            <span class="font-normal text-slate-400">(ditampilkan di halaman detail layanan)</span>
                        </label>
                        <textarea
                            name="deskripsi_detail"
                            rows="6"
                            placeholder="Jelaskan layananmu secara lengkap: fitur yang disediakan, teknologi yang digunakan, proses pengerjaan, dan lain-lain..."
                            class="w-full rounded-xl border border-[#DCE7FB] px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-300 resize-none"
                        ></textarea>
                    </div>

                    <div class="flex gap-3">
                        <button type="submit"
                            class="rounded-2xl bg-gradient-to-r from-[#2563EB] to-[#1149C7] px-8 py-3 text-sm font-semibold text-white hover:opacity-90 transition">
                            Simpan Layanan
                        </button>
                        <a href="{{ route('layanan.saya') }}"
                            class="rounded-2xl border border-slate-300 bg-white px-8 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">
                            Batal
                        </a>
                    </div>

                </form>

            </div>

        </div>

    </main>

</div>

<script>
function formatHarga(raw) {
    const num = parseInt(raw.replace(/\D/g, '')) || 0;
    if (num === 0) return '—';
    if (num >= 1000000) {
        const jt = num / 1000000;
        const label = Number.isInteger(jt) ? jt : jt.toFixed(1).replace('.', ',');
        return 'Rp' + label + 'Jt';
    }
    if (num >= 1000) {
        return 'Rp' + Math.round(num / 1000) + 'K';
    }
    return 'Rp' + num;
}

function updatePreviewHarga(value) {
    document.getElementById('preview-harga').textContent = formatHarga(value);
}

function updateCharCount(el) {
    document.getElementById('char-count').textContent = el.value.length;
}
</script>

</body>
</html>
