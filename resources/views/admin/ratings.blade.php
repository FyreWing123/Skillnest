@extends('admin.layout')
@section('title', 'Moderasi Ulasan')
@section('heading', 'Moderasi Ulasan')

@section('content')

{{-- FILTER --}}
<form method="GET" action="{{ route('admin.ratings') }}"
      class="mb-6 flex flex-wrap gap-3">
    <div class="flex flex-1 min-w-[220px] items-center gap-3 rounded-2xl border border-[#E2E8F0] bg-white px-4 py-3 shadow-sm">
        <svg class="h-4 w-4 text-slate-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/>
        </svg>
        <input type="search" name="q" value="{{ $q }}"
               placeholder="Cari isi ulasan..."
               class="flex-1 bg-transparent text-sm text-slate-700 outline-none placeholder:text-slate-400">
    </div>
    <button type="submit"
            class="rounded-2xl bg-[#1846A3] px-5 py-3 text-sm font-semibold text-white hover:bg-[#2563EB] transition">
        Cari
    </button>
    @if($q)
        <a href="{{ route('admin.ratings') }}"
           class="rounded-2xl border border-[#E2E8F0] bg-white px-5 py-3 text-sm font-semibold text-slate-500 hover:bg-slate-50 transition">
            Reset
        </a>
    @endif
</form>

{{-- TABLE --}}
<div class="rounded-2xl bg-white border border-[#E2E8F0] shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-[#F1F5F9] flex items-center justify-between">
        <h2 class="font-bold text-[#0F172A]">Daftar Ulasan</h2>
        <span class="text-xs text-slate-400">{{ $ratings->total() }} ulasan ditemukan</span>
    </div>

    @if($ratings->isEmpty())
        <div class="px-6 py-16 text-center text-slate-400 text-sm">Tidak ada ulasan ditemukan.</div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-[#F8FAFC] border-b border-[#E2E8F0]">
                    <tr>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">Rating & Ulasan</th>
                        <th class="text-left px-4 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">Reviewer (UMKM)</th>
                        <th class="text-left px-4 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">Diulas (Mahasiswa)</th>
                        <th class="text-left px-4 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">Tanggal</th>
                        <th class="text-center px-4 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#F1F5F9]">
                    @foreach($ratings as $r)
                    <tr class="hover:bg-[#FAFBFC] transition">
                        <td class="px-6 py-4 max-w-[280px]">
                            <div class="flex items-center gap-1.5 mb-1">
                                <span class="text-yellow-400 text-base leading-none">
                                    @for($i = 1; $i <= 5; $i++){{ $i <= $r->stars ? '★' : '☆' }}@endfor
                                </span>
                                <span class="text-xs font-bold text-slate-600">{{ $r->stars }}/5</span>
                            </div>
                            @if($r->ulasan)
                                <p class="text-sm text-slate-600 line-clamp-2">"{{ $r->ulasan }}"</p>
                            @else
                                <p class="text-xs text-slate-400 italic">Tidak ada teks ulasan.</p>
                            @endif
                        </td>
                        <td class="px-4 py-4">
                            <p class="font-semibold text-[#0F172A] truncate max-w-[130px]">
                                {{ $r->umkm->nama_usaha ?? $r->umkm->name ?? '—' }}
                            </p>
                            <p class="text-xs text-slate-400 truncate">{{ $r->umkm->email ?? '' }}</p>
                        </td>
                        <td class="px-4 py-4">
                            <p class="font-semibold text-[#0F172A] truncate max-w-[130px]">{{ $r->mahasiswa->name ?? '—' }}</p>
                            <p class="text-xs text-slate-400 truncate">{{ $r->mahasiswa->email ?? '' }}</p>
                        </td>
                        <td class="px-4 py-4 text-sm text-slate-500 whitespace-nowrap">
                            {{ $r->created_at->format('d M Y') }}
                        </td>
                        <td class="px-4 py-4 text-center">
                            <form method="POST" action="{{ route('admin.ratings.delete', $r->id) }}"
                                  onsubmit="return confirm('Hapus ulasan ini secara permanen?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="rounded-lg bg-red-50 border border-red-200 px-3 py-1.5 text-xs font-semibold text-red-600 hover:bg-red-100 transition">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if($ratings->hasPages())
        <div class="px-6 py-4 border-t border-[#F1F5F9] flex items-center justify-between">
            <p class="text-xs text-slate-400">
                Menampilkan {{ $ratings->firstItem() }}–{{ $ratings->lastItem() }} dari {{ $ratings->total() }}
            </p>
            <div class="flex gap-2">
                @if($ratings->onFirstPage())
                    <span class="rounded-lg border border-[#E2E8F0] px-3 py-1.5 text-xs text-slate-300 cursor-not-allowed">← Prev</span>
                @else
                    <a href="{{ $ratings->previousPageUrl() }}"
                       class="rounded-lg border border-[#E2E8F0] px-3 py-1.5 text-xs font-semibold text-slate-600 hover:bg-slate-50 transition">← Prev</a>
                @endif
                <span class="rounded-lg border border-[#1846A3] bg-[#1846A3] px-3 py-1.5 text-xs font-semibold text-white">
                    {{ $ratings->currentPage() }} / {{ $ratings->lastPage() }}
                </span>
                @if($ratings->hasMorePages())
                    <a href="{{ $ratings->nextPageUrl() }}"
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
