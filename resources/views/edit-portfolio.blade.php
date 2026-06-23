<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Portfolio - SkillNest</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#F6FAFF]">

<div class="min-h-screen flex">

    {{-- SIDEBAR --}}
    <aside class="w-72 bg-white border-r border-[#E2E8F0] p-6">

        <a href="{{ route('home') }}" class="flex items-center gap-3 mb-10">
            <img src="{{ asset('images/skillnestlogo.png') }}" class="h-10" alt="SkillNest">
            <span class="text-xl font-bold text-[#0F172A]">SkillNest</span>
        </a>

        <nav class="space-y-2">
            <a href="{{ route('dashboard.mahasiswa') }}"
                class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">
                Dashboard
            </a>
            <a href="{{ route('profile.mahasiswa') }}"
                class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">
                Profil Saya
            </a>
            <a href="{{ route('portfolio.mahasiswa') }}"
                class="block rounded-xl bg-[#EAF2FF] px-4 py-3 font-semibold text-[#1846A3]">
                Portfolio
            </a>
            <a href="{{ route('layanan.saya') }}"
                class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">
                Layanan Saya
            </a>
            <a href="{{ route('chat') }}"
                class="block rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100">
                Pesan
            </a>
        </nav>

    </aside>

    {{-- CONTENT --}}
    <main class="flex-1 p-10">

        {{-- HEADER --}}
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('portfolio.mahasiswa') }}"
                class="flex items-center justify-center w-10 h-10 rounded-xl bg-white border border-[#E2E8F0] text-slate-500 hover:bg-slate-50 shadow-sm">
                &#8592;
            </a>
            <div>
                <h1 class="text-3xl font-bold text-[#0F172A]">Edit Portfolio</h1>
                <p class="mt-1 text-slate-500 text-sm">Perbarui informasi portfolio kamu.</p>
            </div>
        </div>

        {{-- FORM CARD --}}
        <div class="max-w-2xl bg-white rounded-4xl shadow-sm p-8">

            @if($errors->any())
                <div class="mb-6 rounded-xl bg-red-50 border border-red-200 p-4">
                    <ul class="text-sm text-red-600 space-y-1 list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('portfolio.update', $portfolio->id) }}" method="POST" enctype="multipart/form-data"
                  class="space-y-6">
                @csrf
                @method('PUT')

                {{-- JUDUL --}}
                <div>
                    <label class="block text-sm font-semibold text-[#0F172A] mb-2">
                        Judul Portfolio <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        name="judul"
                        value="{{ old('judul', $portfolio->judul) }}"
                        placeholder="Contoh: Landing Page UMKM Kopi Nusantara"
                        class="w-full rounded-xl border px-4 py-3 text-sm text-slate-700 placeholder-slate-400 focus:border-[#2563EB] focus:outline-none focus:ring-2 focus:ring-blue-100 {{ $errors->has('judul') ? 'border-red-400' : 'border-[#E2E8F0]' }}"
                    >
                </div>

                {{-- DESKRIPSI --}}
                <div>
                    <label class="block text-sm font-semibold text-[#0F172A] mb-2">
                        Deskripsi <span class="text-red-500">*</span>
                    </label>
                    <textarea
                        name="deskripsi"
                        rows="5"
                        placeholder="Ceritakan detail project ini..."
                        class="w-full rounded-xl border px-4 py-3 text-sm text-slate-700 placeholder-slate-400 focus:border-[#2563EB] focus:outline-none focus:ring-2 focus:ring-blue-100 resize-none {{ $errors->has('deskripsi') ? 'border-red-400' : 'border-[#E2E8F0]' }}"
                    >{{ old('deskripsi', $portfolio->deskripsi) }}</textarea>
                </div>

                {{-- FOTO --}}
                <div>
                    <label class="block text-sm font-semibold text-[#0F172A] mb-2">
                        Foto Bukti <span class="text-slate-400 font-normal">(kosongkan jika tidak ingin mengubah foto)</span>
                    </label>

                    {{-- Preview foto lama --}}
                    @if($portfolio->foto)
                        <div class="mb-3 flex items-center gap-3 rounded-xl bg-slate-50 border border-[#E2E8F0] p-3">
                            <img src="{{ asset('storage/' . $portfolio->foto) }}"
                                 alt="Foto saat ini"
                                 class="h-16 w-24 object-cover rounded-lg">
                            <span class="text-xs text-slate-500">Foto saat ini. Unggah baru untuk mengganti.</span>
                        </div>
                    @endif

                    <label for="foto"
                        class="flex flex-col items-center justify-center w-full h-36 border-2 border-dashed border-[#CBD5E1] rounded-xl cursor-pointer bg-slate-50 hover:bg-blue-50 hover:border-[#2563EB] transition-colors">

                        <div id="upload-placeholder" class="flex flex-col items-center gap-2 text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-9 h-9" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/>
                            </svg>
                            <span class="text-sm">Klik untuk unggah foto baru</span>
                            <span class="text-xs">JPG, PNG, WEBP — maks. 2MB</span>
                        </div>

                        <img id="preview-img" src="#" alt="Preview" class="hidden h-28 object-contain rounded-lg">

                        <input id="foto" type="file" name="foto" accept="image/*" class="hidden"
                               onchange="previewFoto(this)">
                    </label>
                </div>

                {{-- BUTTONS --}}
                <div class="flex gap-4 pt-2">
                    <a href="{{ route('portfolio.mahasiswa') }}"
                        class="flex-1 text-center rounded-xl border border-[#DCE7FB] py-3 text-sm font-semibold text-[#1846A3] hover:bg-[#F8FAFF]">
                        Batal
                    </a>
                    <button type="submit"
                        class="flex-1 rounded-xl bg-linear-to-r from-[#2563EB] to-[#1149C7] py-3 text-sm font-semibold text-white shadow-lg shadow-blue-500/20 hover:opacity-90 transition-opacity">
                        Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>

    </main>
</div>

<script>
function previewFoto(input) {
    const placeholder = document.getElementById('upload-placeholder');
    const preview = document.getElementById('preview-img');

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = (e) => {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
            placeholder.classList.add('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

</body>
</html>
