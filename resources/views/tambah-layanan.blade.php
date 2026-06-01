<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tambah Layanan</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#F6FAFF]">

@include('partials.header')

<main class="px-6 py-16 md:px-10">

    <div class="mx-auto max-w-4xl">

        <div class="rounded-[2rem] border border-[#DCE7FB] bg-white p-10 shadow-sm">

            <h1 class="text-4xl font-bold text-[#0F172A]">
                Tambah Layanan
            </h1>

            <p class="mt-3 text-[#64748B]">
                Buat layanan baru yang akan tampil di marketplace SkillNest.
            </p>

            <form class="mt-10 space-y-6">

                <div>
                    <label class="mb-3 block font-semibold">
                        Nama Layanan
                    </label>

                    <input
                        type="text"
                        placeholder="Landing Page UMKM"
                        class="w-full rounded-2xl border border-[#DCE7FB] px-5 py-4"
                    >
                </div>

                <div>
                    <label class="mb-3 block font-semibold">
                        Kategori
                    </label>

                    <select
                        class="w-full rounded-2xl border border-[#DCE7FB] px-5 py-4">

                        <option>Web Development</option>
                        <option>Desain Grafis</option>
                        <option>Digital Marketing</option>
                        <option>Fotografi Produk</option>
                        <option>Content Creation</option>

                    </select>
                </div>

                <div class="grid gap-6 md:grid-cols-2">

                    <div>
                        <label class="mb-3 block font-semibold">
                            Harga
                        </label>

                        <input
                            type="text"
                            placeholder="500000"
                            class="w-full rounded-2xl border border-[#DCE7FB] px-5 py-4"
                        >
                    </div>

                    <div>
                        <label class="mb-3 block font-semibold">
                            Estimasi Pengerjaan
                        </label>

                        <input
                            type="text"
                            placeholder="3 Hari"
                            class="w-full rounded-2xl border border-[#DCE7FB] px-5 py-4"
                        >
                    </div>

                </div>

                <div>
                    <label class="mb-3 block font-semibold">
                        Thumbnail
                    </label>

                    <input
                        type="file"
                        class="w-full rounded-2xl border border-[#DCE7FB] px-5 py-4"
                    >
                </div>

                <div>
                    <label class="mb-3 block font-semibold">
                        Deskripsi
                    </label>

                    <textarea
                        rows="6"
                        class="w-full rounded-2xl border border-[#DCE7FB] px-5 py-4"
                    ></textarea>
                </div>

                <button
                    class="rounded-2xl bg-gradient-to-r from-[#2563EB] to-[#1149C7] px-8 py-4 font-semibold text-white">
                    Simpan Layanan
                </button>

            </form>

        </div>

    </div>

</main>

@include('partials.footer')

</body>
</html>