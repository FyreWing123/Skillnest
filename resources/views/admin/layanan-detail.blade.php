@extends('admin.layout')
@section('title', $layanan->nama . ' — Detail Layanan')
@section('heading', 'Detail Layanan')

@section('content')

{{-- BACK + HAPUS --}}
<div class="flex items-center justify-between mb-6">
    <a href="{{ route('admin.layanans') }}"
       class="text-sm font-semibold text-slate-500 hover:text-[#1846A3] transition">
        ← Kembali ke Manajemen Layanan
    </a>
    <form method="POST" action="{{ route('admin.layanans.delete', $layanan->id) }}"
          onsubmit="return confirm('Hapus layanan {{ addslashes($layanan->nama) }}? Aksi ini tidak dapat dibatalkan.')">
        @csrf @method('DELETE')
        <button type="submit"
                class="rounded-xl bg-red-50 border border-red-200 px-4 py-2 text-sm font-semibold text-red-600 hover:bg-red-100 transition">
            Hapus Layanan
        </button>
    </form>
</div>

<div class="grid gap-6 lg:grid-cols-3">

    {{-- LEFT: INFO + ULASAN --}}
    <div class="lg:col-span-2 space-y-6">

        {{-- Layanan Info --}}
        <div class="rounded-2xl bg-white border border-[#E2E8F0] shadow-sm overflow-hidden">
            @if($layanan->thumbnail)
                <img src="{{ asset('storage/' . $layanan->thumbnail) }}"
                     class="w-full h-52 object-cover" alt="">
            @else
                <div class="w-full h-52 bg-gradient-to-br from-[#2563EB] to-[#1149C7]"></div>
            @endif
            <div class="p-6">
                <div class="flex items-start justify-between gap-4">
                    <h2 class="text-xl font-bold text-[#0F172A] leading-tight">{{ $layanan->nama }}</h2>
                    @if($layanan->isOpen())
                        <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-bold text-emerald-700 shrink-0">Open</span>
                    @else
                        <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-bold text-slate-500 shrink-0">Closed</span>
                    @endif
                </div>
                <div class="flex flex-wrap items-center gap-3 mt-3">
                    <span class="rounded-full bg-[#EAF2FF] px-3 py-1 text-xs font-semibold text-[#1846A3]">
                        {{ $layanan->kategori }}
                    </span>
                    <span class="text-sm font-bold text-[#1846A3]">{{ $layanan->formatHarga() }}</span>
                    @if($layanan->estimasi)
                        <span class="text-sm text-slate-400">· {{ $layanan->estimasi }}</span>
                    @endif
                </div>
                @if($layanan->deskripsi_singkat)
                <p class="mt-4 text-sm text-slate-500">{{ $layanan->deskripsi_singkat }}</p>
                @endif
                @if($layanan->deskripsi_detail)
                <div class="mt-4 pt-4 border-t border-[#F1F5F9]">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400 mb-2">Deskripsi Detail</p>
                    <p class="text-sm text-slate-600 leading-relaxed whitespace-pre-line">{{ $layanan->deskripsi_detail }}</p>
                </div>
                @endif
            </div>
        </div>

        {{-- ULASAN & RATING --}}
        <div class="rounded-2xl bg-white border border-[#E2E8F0] shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-[#F1F5F9] flex items-center justify-between">
                <div>
                    <h3 class="font-bold text-[#0F172A]">Ulasan & Rating</h3>
                    @if($avgRating)
                        <p class="text-xs text-slate-400 mt-0.5">
                            Rata-rata
                            <span class="text-yellow-500 font-bold">★ {{ $avgRating }}</span>
                            dari {{ $ratingCount }} ulasan
                        </p>
                    @endif
                </div>
                <span class="text-xs text-slate-400">{{ $ratingCount }} ulasan</span>
            </div>

            @forelse($ratings as $r)
            <div class="px-6 py-5 border-b border-[#F1F5F9] last:border-0">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex items-start gap-3 min-w-0">
                        @if($r->umkm && $r->umkm->photo)
                            <img src="{{ asset('storage/' . $r->umkm->photo) }}"
                                 class="h-9 w-9 rounded-full object-cover shrink-0" alt="">
                        @else
                            @php $init = strtoupper(substr($r->umkm->name ?? 'U', 0, 2)); @endphp
                            <div class="h-9 w-9 rounded-full bg-purple-100 flex items-center justify-center text-purple-700 font-bold text-xs shrink-0">
                                {{ $init }}
                            </div>
                        @endif
                        <div class="min-w-0">
                            <div class="flex flex-wrap items-center gap-2">
                                <p class="text-sm font-semibold text-[#0F172A]">
                                    {{ $r->umkm->nama_usaha ?? $r->umkm->name ?? '—' }}
                                </p>
                                <span class="text-xs text-slate-400">{{ $r->created_at->format('d M Y') }}</span>
                            </div>
                            <div class="text-yellow-400 text-sm mt-0.5">
                                @for($i = 1; $i <= 5; $i++){{ $i <= $r->stars ? '★' : '☆' }}@endfor
                                <span class="text-xs text-slate-500 ml-1">{{ $r->stars }}/5</span>
                            </div>
                            @if($r->ulasan)
                                <p class="text-sm text-slate-600 mt-1.5 leading-relaxed">"{{ $r->ulasan }}"</p>
                            @else
                                <p class="text-xs text-slate-400 italic mt-1">Tidak ada teks ulasan.</p>
                            @endif
                        </div>
                    </div>
                    <form method="POST" action="{{ route('admin.ratings.delete', $r->id) }}"
                          onsubmit="return confirm('Hapus ulasan ini?')">
                        @csrf @method('DELETE')
                        <button type="submit"
                                class="rounded-lg bg-red-50 border border-red-200 px-3 py-1.5 text-xs font-semibold text-red-600 hover:bg-red-100 transition shrink-0">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
            @empty
            <div class="px-6 py-16 text-center text-sm text-slate-400">
                Belum ada ulasan untuk layanan ini.
            </div>
            @endforelse
        </div>

    </div>

    {{-- RIGHT SIDEBAR --}}
    <div class="space-y-6">

        {{-- Statistik --}}
        <div class="rounded-2xl bg-white border border-[#E2E8F0] shadow-sm p-6">
            <h3 class="font-bold text-[#0F172A] mb-4">Statistik Layanan</h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-slate-500">Total Pesanan</span>
                    <span class="text-sm font-bold text-[#0F172A]">{{ $totalPesanan }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-slate-500">Selesai</span>
                    <span class="text-sm font-bold text-green-600">{{ $pesananSelesai }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-slate-500">Rata-rata Rating</span>
                    <span class="text-sm font-bold text-yellow-500">
                        {{ $avgRating ? '★ ' . $avgRating : '—' }}
                    </span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-slate-500">Total Ulasan</span>
                    <span class="text-sm font-bold text-[#0F172A]">{{ $ratingCount }}</span>
                </div>
            </div>
        </div>

        {{-- Pemilik (Mahasiswa) --}}
        <div class="rounded-2xl bg-white border border-[#E2E8F0] shadow-sm p-6">
            <h3 class="font-bold text-[#0F172A] mb-4">Pemilik Layanan</h3>
            <div class="flex items-center gap-3">
                @if($layanan->user && $layanan->user->photo)
                    <img src="{{ asset('storage/' . $layanan->user->photo) }}"
                         class="h-11 w-11 rounded-full object-cover shrink-0" alt="">
                @else
                    @php $ownerInit = strtoupper(substr($layanan->user->name ?? 'M', 0, 2)); @endphp
                    <div class="h-11 w-11 rounded-full bg-[#EAF2FF] flex items-center justify-center text-[#1846A3] font-bold shrink-0">
                        {{ $ownerInit }}
                    </div>
                @endif
                <div class="min-w-0">
                    <p class="font-semibold text-[#0F172A] truncate">{{ $layanan->user->name ?? '—' }}</p>
                    <p class="text-xs text-slate-400 truncate">{{ $layanan->user->email ?? '' }}</p>
                    @if($layanan->user->jurusan)
                        <p class="text-xs text-slate-400 mt-0.5">{{ $layanan->user->jurusan }}</p>
                    @endif
                </div>
            </div>
            @if($layanan->user)
            <a href="{{ route('admin.users.show', $layanan->user->id) }}"
               class="mt-4 block w-full text-center rounded-xl bg-[#EAF2FF] px-4 py-2.5 text-sm font-semibold text-[#1846A3] hover:bg-[#DBEAFE] transition">
                Lihat Profil Mahasiswa
            </a>
            @endif
        </div>

    </div>

</div>

@endsection
