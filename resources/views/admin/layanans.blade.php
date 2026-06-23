@extends('admin.layout')
@section('title', 'Manajemen Layanan')
@section('heading', 'Manajemen Layanan')

@section('content')

{{-- HEADER ACTIONS --}}
<div class="flex items-center justify-between mb-6">
    <h2 class="text-lg font-bold text-[#0F172A]">Semua Layanan Terdaftar</h2>
    <a href="{{ route('admin.layanans.export') }}"
       class="flex items-center gap-2 rounded-2xl bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-emerald-700 transition shadow-sm">
        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
        </svg>
        Download Excel
    </a>
</div>

{{-- FILTER --}}
<form method="GET" action="{{ route('admin.layanans') }}"
      class="mb-6 flex flex-wrap gap-3">
    <div class="flex flex-1 min-w-[220px] items-center gap-3 rounded-2xl border border-[#E2E8F0] bg-white px-4 py-3 shadow-sm">
        <svg class="h-4 w-4 text-slate-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/>
        </svg>
        <input type="search" name="q" value="{{ $q }}"
               placeholder="Cari nama layanan..."
               class="flex-1 bg-transparent text-sm text-slate-700 outline-none placeholder:text-slate-400">
    </div>
    <select name="kategori" onchange="this.form.submit()"
            class="rounded-2xl border border-[#E2E8F0] bg-white px-4 py-3 text-sm text-slate-700 outline-none shadow-sm">
        <option value="">Semua Kategori</option>
        @foreach(['Web Development','UI/UX Design','Desain Grafis','Fotografi','Videografi','Copywriting','Social Media','Mobile App','Digital Marketing','Content Creation','Admin Support'] as $opt)
            <option value="{{ $opt }}" {{ $kategori === $opt ? 'selected' : '' }}>{{ $opt }}</option>
        @endforeach
    </select>
    <select name="status" onchange="this.form.submit()"
            class="rounded-2xl border border-[#E2E8F0] bg-white px-4 py-3 text-sm text-slate-700 outline-none shadow-sm">
        <option value="">Semua Status</option>
        <option value="open" {{ $status === 'open' ? 'selected' : '' }}>Open</option>
        <option value="closed" {{ $status === 'closed' ? 'selected' : '' }}>Closed</option>
    </select>
    <button type="submit"
            class="rounded-2xl bg-[#1846A3] px-5 py-3 text-sm font-semibold text-white hover:bg-[#2563EB] transition">
        Cari
    </button>
    @if($q || $kategori || $status)
        <a href="{{ route('admin.layanans') }}"
           class="rounded-2xl border border-[#E2E8F0] bg-white px-5 py-3 text-sm font-semibold text-slate-500 hover:bg-slate-50 transition">
            Reset
        </a>
    @endif
</form>

{{-- TABLE --}}
<div class="rounded-2xl bg-white border border-[#E2E8F0] shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-[#F1F5F9] flex items-center justify-between">
        <h2 class="font-bold text-[#0F172A]">Daftar Layanan</h2>
        <span class="text-xs text-slate-400">{{ $layanans->total() }} layanan ditemukan</span>
    </div>

    @if($layanans->isEmpty())
        <div class="px-6 py-16 text-center text-slate-400 text-sm">Tidak ada layanan ditemukan.</div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-[#F8FAFC] border-b border-[#E2E8F0]">
                    <tr>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">Layanan</th>
                        <th class="text-left px-4 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">Mahasiswa</th>
                        <th class="text-left px-4 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">Kategori</th>
                        <th class="text-right px-4 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">Harga</th>
                        <th class="text-center px-4 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">Pesanan</th>
                        <th class="text-center px-4 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">Status</th>
                        <th class="text-center px-4 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#F1F5F9]">
                    @foreach($layanans as $l)
                    <tr class="hover:bg-[#FAFBFC] transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                @if($l->thumbnail)
                                    <img src="{{ asset('storage/' . $l->thumbnail) }}"
                                         class="h-10 w-14 rounded-lg object-cover shrink-0" alt="">
                                @else
                                    <div class="h-10 w-14 rounded-lg bg-gradient-to-br from-[#2563EB] to-[#1149C7] shrink-0"></div>
                                @endif
                                <div class="min-w-0">
                                    <p class="font-semibold text-[#0F172A] truncate max-w-[160px]">{{ $l->nama }}</p>
                                    <p class="text-xs text-slate-400">{{ $l->estimasi }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-4">
                            <p class="text-sm font-semibold text-[#0F172A] truncate max-w-[120px]">{{ $l->user->name ?? '—' }}</p>
                            <p class="text-xs text-slate-400 truncate">{{ $l->user->email ?? '' }}</p>
                        </td>
                        <td class="px-4 py-4">
                            <span class="rounded-full bg-[#EAF2FF] px-2.5 py-1 text-xs font-semibold text-[#1846A3]">
                                {{ $l->kategori }}
                            </span>
                        </td>
                        <td class="px-4 py-4 text-right font-semibold text-[#1846A3]">
                            {{ $l->formatHarga() }}
                        </td>
                        <td class="px-4 py-4 text-center">
                            <span class="text-sm font-semibold text-slate-600">{{ $l->pesanans_count }}</span>
                        </td>
                        <td class="px-4 py-4 text-center">
                            @if($l->isOpen())
                                <span class="rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-bold text-emerald-700">Open</span>
                            @else
                                <span class="rounded-full bg-slate-100 px-2.5 py-1 text-xs font-bold text-slate-500">Closed</span>
                            @endif
                        </td>
                        <td class="px-4 py-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.layanans.show', $l->id) }}"
                                   class="rounded-lg bg-[#EAF2FF] border border-[#BFDBFE] px-3 py-1.5 text-xs font-semibold text-[#1846A3] hover:bg-[#DBEAFE] transition">
                                    Detail
                                </a>
                                <form method="POST" action="{{ route('admin.layanans.delete', $l->id) }}"
                                      onsubmit="return confirm('Hapus layanan {{ addslashes($l->nama) }}? Aksi ini tidak dapat dibatalkan.')">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                            class="rounded-lg bg-red-50 border border-red-200 px-3 py-1.5 text-xs font-semibold text-red-600 hover:bg-red-100 transition">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if($layanans->hasPages())
        <div class="px-6 py-4 border-t border-[#F1F5F9] flex items-center justify-between">
            <p class="text-xs text-slate-400">
                Menampilkan {{ $layanans->firstItem() }}–{{ $layanans->lastItem() }} dari {{ $layanans->total() }}
            </p>
            <div class="flex gap-2">
                @if($layanans->onFirstPage())
                    <span class="rounded-lg border border-[#E2E8F0] px-3 py-1.5 text-xs text-slate-300 cursor-not-allowed">← Prev</span>
                @else
                    <a href="{{ $layanans->previousPageUrl() }}"
                       class="rounded-lg border border-[#E2E8F0] px-3 py-1.5 text-xs font-semibold text-slate-600 hover:bg-slate-50 transition">← Prev</a>
                @endif
                <span class="rounded-lg border border-[#1846A3] bg-[#1846A3] px-3 py-1.5 text-xs font-semibold text-white">
                    {{ $layanans->currentPage() }} / {{ $layanans->lastPage() }}
                </span>
                @if($layanans->hasMorePages())
                    <a href="{{ $layanans->nextPageUrl() }}"
                       class="rounded-lg border border-[#E2E8F0] px-3 py-1.5 text-xs font-semibold text-slate-600 hover:bg-slate-50 transition">Next →</a>
                @else
                    <span class="rounded-lg border border-[#E2E8F0] px-3 py-1.5 text-xs text-slate-300 cursor-not-allowed">Next →</span>
                @endif
            </div>
        </div>
        @endif
    @endif
</div>

@endsection
