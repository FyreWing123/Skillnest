@extends('admin.layout')
@section('title', 'Semua Pesanan')
@section('heading', 'Semua Pesanan')

@section('content')

{{-- STATS --}}
<div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6">
    <div class="rounded-2xl bg-slate-50 border border-slate-100 p-4">
        <p class="text-xs font-semibold text-slate-500">Total</p>
        <p class="text-3xl font-bold text-slate-700 mt-1">{{ $counts['all'] }}</p>
    </div>
    <div class="rounded-2xl bg-yellow-50 border border-yellow-100 p-4">
        <p class="text-xs font-semibold text-yellow-600">Menunggu</p>
        <p class="text-3xl font-bold text-yellow-700 mt-1">{{ $counts['menunggu_verifikasi'] }}</p>
    </div>
    <div class="rounded-2xl bg-purple-50 border border-purple-100 p-4">
        <p class="text-xs font-semibold text-purple-600">On-going</p>
        <p class="text-3xl font-bold text-purple-700 mt-1">{{ $counts['on_going'] }}</p>
    </div>
    <div class="rounded-2xl bg-green-50 border border-green-100 p-4">
        <p class="text-xs font-semibold text-green-600">Selesai</p>
        <p class="text-3xl font-bold text-green-700 mt-1">{{ $counts['selesai'] }}</p>
    </div>
    <div class="rounded-2xl bg-red-50 border border-red-100 p-4">
        <p class="text-xs font-semibold text-red-600">Ditolak</p>
        <p class="text-3xl font-bold text-red-700 mt-1">{{ $counts['ditolak'] }}</p>
    </div>
</div>

{{-- FILTER --}}
<form method="GET" action="{{ route('admin.pesanans') }}"
      class="mb-6 flex flex-wrap gap-3">
    <div class="flex flex-1 min-w-[220px] items-center gap-3 rounded-2xl border border-[#E2E8F0] bg-white px-4 py-3 shadow-sm">
        <svg class="h-4 w-4 text-slate-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/>
        </svg>
        <input type="search" name="q" value="{{ $q }}"
               placeholder="Cari UMKM atau nama layanan..."
               class="flex-1 bg-transparent text-sm text-slate-700 outline-none placeholder:text-slate-400">
    </div>
    <select name="status" onchange="this.form.submit()"
            class="rounded-2xl border border-[#E2E8F0] bg-white px-4 py-3 text-sm text-slate-700 outline-none shadow-sm">
        <option value="">Semua Status</option>
        <option value="menunggu_verifikasi" {{ $status === 'menunggu_verifikasi' ? 'selected' : '' }}>Menunggu</option>
        <option value="diterima" {{ $status === 'diterima' ? 'selected' : '' }}>Diterima</option>
        <option value="on_going" {{ $status === 'on_going' ? 'selected' : '' }}>On-going</option>
        <option value="selesai" {{ $status === 'selesai' ? 'selected' : '' }}>Selesai</option>
        <option value="ditolak" {{ $status === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
    </select>
    <button type="submit"
            class="rounded-2xl bg-[#1846A3] px-5 py-3 text-sm font-semibold text-white hover:bg-[#2563EB] transition">
        Cari
    </button>
    @if($q || $status)
        <a href="{{ route('admin.pesanans') }}"
           class="rounded-2xl border border-[#E2E8F0] bg-white px-5 py-3 text-sm font-semibold text-slate-500 hover:bg-slate-50 transition">
            Reset
        </a>
    @endif
</form>

{{-- TABLE --}}
<div class="rounded-2xl bg-white border border-[#E2E8F0] shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-[#F1F5F9] flex items-center justify-between">
        <h2 class="font-bold text-[#0F172A]">Daftar Pesanan</h2>
        <span class="text-xs text-slate-400">{{ $pesanans->total() }} pesanan ditemukan</span>
    </div>

    @if($pesanans->isEmpty())
        <div class="px-6 py-16 text-center text-slate-400 text-sm">Tidak ada pesanan ditemukan.</div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-[#F8FAFC] border-b border-[#E2E8F0]">
                    <tr>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">UMKM</th>
                        <th class="text-left px-4 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">Layanan</th>
                        <th class="text-left px-4 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">Mahasiswa</th>
                        <th class="text-center px-4 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">Status</th>
                        <th class="text-left px-4 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#F1F5F9]">
                    @foreach($pesanans as $p)
                    <tr class="hover:bg-[#FAFBFC] transition">
                        <td class="px-6 py-4">
                            <p class="font-semibold text-[#0F172A] truncate max-w-[150px]">
                                {{ $p->user->nama_usaha ?? $p->user->name ?? '—' }}
                            </p>
                            <p class="text-xs text-slate-400 truncate">{{ $p->user->email ?? '' }}</p>
                        </td>
                        <td class="px-4 py-4">
                            <p class="font-semibold text-[#0F172A] truncate max-w-[150px]">{{ $p->layanan->nama ?? '—' }}</p>
                            <p class="text-xs text-slate-400">{{ $p->layanan->formatHarga() ?? '' }}</p>
                        </td>
                        <td class="px-4 py-4">
                            <p class="font-semibold text-[#0F172A] truncate max-w-[120px]">{{ $p->layanan->user->name ?? '—' }}</p>
                        </td>
                        <td class="px-4 py-4 text-center">
                            <span class="rounded-lg px-2.5 py-1 text-xs font-bold {{ $p->statusColor() }}">
                                {{ $p->statusLabel() }}
                            </span>
                        </td>
                        <td class="px-4 py-4 text-sm text-slate-500">
                            {{ $p->created_at->format('d M Y') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if($pesanans->hasPages())
        <div class="px-6 py-4 border-t border-[#F1F5F9] flex items-center justify-between">
            <p class="text-xs text-slate-400">
                Menampilkan {{ $pesanans->firstItem() }}–{{ $pesanans->lastItem() }} dari {{ $pesanans->total() }}
            </p>
            <div class="flex gap-2">
                @if($pesanans->onFirstPage())
                    <span class="rounded-lg border border-[#E2E8F0] px-3 py-1.5 text-xs text-slate-300 cursor-not-allowed">← Prev</span>
                @else
                    <a href="{{ $pesanans->previousPageUrl() }}"
                       class="rounded-lg border border-[#E2E8F0] px-3 py-1.5 text-xs font-semibold text-slate-600 hover:bg-slate-50 transition">← Prev</a>
                @endif
                <span class="rounded-lg border border-[#1846A3] bg-[#1846A3] px-3 py-1.5 text-xs font-semibold text-white">
                    {{ $pesanans->currentPage() }} / {{ $pesanans->lastPage() }}
                </span>
                @if($pesanans->hasMorePages())
                    <a href="{{ $pesanans->nextPageUrl() }}"
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
