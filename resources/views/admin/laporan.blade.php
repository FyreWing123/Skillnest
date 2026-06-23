@extends('admin.layout')
@section('title', 'Laporan')
@section('heading', 'Laporan & Statistik')

@section('content')

{{-- HEADER ACTIONS --}}
<div class="flex items-center justify-between mb-6">
    <h2 class="text-lg font-bold text-[#0F172A]">Laporan Tahun {{ now()->year }}</h2>
    <a href="{{ route('admin.laporan.export') }}"
       class="flex items-center gap-2 rounded-2xl bg-red-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-red-700 transition shadow-sm">
        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
        </svg>
        Download PDF
    </a>
</div>

{{-- MONTHLY CHART --}}
<div class="rounded-2xl bg-white border border-[#E2E8F0] shadow-sm p-6 mb-6">
    <h2 class="font-bold text-[#0F172A] mb-1">Pesanan per Bulan</h2>
    <p class="text-xs text-slate-400 mb-6">Tahun {{ now()->year }}</p>
    <div class="flex items-end gap-2 h-40">
        @foreach($monthlyStats as $m)
        @php $pct = $maxMonthly > 0 ? ($m['count'] / $maxMonthly) * 100 : 0; @endphp
        <div class="flex-1 flex flex-col items-center gap-1">
            <span class="text-xs font-bold text-slate-600">{{ $m['count'] > 0 ? $m['count'] : '' }}</span>
            <div class="w-full rounded-t-lg transition-all"
                 style="height: {{ max($pct, 4) }}%; background: {{ $m['count'] > 0 ? '#1846A3' : '#E2E8F0' }}">
            </div>
            <span class="text-[10px] text-slate-400">{{ $m['label'] }}</span>
        </div>
        @endforeach
    </div>
</div>

<div class="grid gap-6 lg:grid-cols-3">

    {{-- TOP LAYANAN --}}
    <div class="rounded-2xl bg-white border border-[#E2E8F0] shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-[#F1F5F9]">
            <h2 class="font-bold text-[#0F172A]">Top Layanan</h2>
            <p class="text-xs text-slate-400 mt-0.5">Berdasarkan jumlah pesanan</p>
        </div>
        <div class="divide-y divide-[#F1F5F9]">
            @forelse($topLayanan as $i => $l)
            <div class="px-6 py-4">
                <div class="flex items-start gap-3">
                    <span class="text-lg font-bold text-slate-200 shrink-0 w-6 text-center">{{ $i + 1 }}</span>
                    <div class="flex-1 min-w-0">
                        <p class="font-semibold text-[#0F172A] text-sm truncate">{{ $l->nama }}</p>
                        <p class="text-xs text-slate-400 truncate">{{ $l->user->name ?? '—' }}</p>
                        <div class="mt-1.5 flex items-center gap-2">
                            <div class="h-1.5 rounded-full bg-[#EAF2FF] flex-1">
                                @php $barW = $topLayanan->max('pesanans_count') > 0 ? ($l->pesanans_count / $topLayanan->max('pesanans_count')) * 100 : 0 @endphp
                                <div class="h-1.5 rounded-full bg-[#1846A3]" style="width: {{ $barW }}%"></div>
                            </div>
                            <span class="text-xs font-bold text-[#1846A3] shrink-0">{{ $l->pesanans_count }} pesanan</span>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="px-6 py-8 text-center text-sm text-slate-400">Belum ada data.</div>
            @endforelse
        </div>
    </div>

    {{-- TOP MAHASISWA --}}
    <div class="rounded-2xl bg-white border border-[#E2E8F0] shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-[#F1F5F9]">
            <h2 class="font-bold text-[#0F172A]">Top Mahasiswa</h2>
            <p class="text-xs text-slate-400 mt-0.5">Berdasarkan rata-rata rating</p>
        </div>
        <div class="divide-y divide-[#F1F5F9]">
            @forelse($topMahasiswa as $i => $u)
            @php
                $avg   = $u->avgRating();
                $count = $u->ratingCount();
                $init  = strtoupper(substr($u->name, 0, 2));
            @endphp
            <div class="px-6 py-4 flex items-center gap-3">
                <span class="text-lg font-bold text-slate-200 shrink-0 w-6 text-center">{{ $i + 1 }}</span>
                @if($u->photo)
                    <img src="{{ asset('storage/' . $u->photo) }}" class="h-9 w-9 rounded-full object-cover shrink-0" alt="">
                @else
                    <div class="h-9 w-9 rounded-full bg-[#EAF2FF] flex items-center justify-center text-[#1846A3] font-bold text-xs shrink-0">
                        {{ $init }}
                    </div>
                @endif
                <div class="flex-1 min-w-0">
                    <p class="font-semibold text-[#0F172A] text-sm truncate">{{ $u->name }}</p>
                    <p class="text-xs text-slate-400">{{ $u->jurusan ?? '—' }}</p>
                </div>
                <div class="text-right shrink-0">
                    <p class="text-sm font-bold text-yellow-500">★ {{ number_format($avg, 1) }}</p>
                    <p class="text-xs text-slate-400">{{ $count }} ulasan</p>
                </div>
            </div>
            @empty
            <div class="px-6 py-8 text-center text-sm text-slate-400">Belum ada data.</div>
            @endforelse
        </div>
    </div>

    {{-- TOP UMKM --}}
    <div class="rounded-2xl bg-white border border-[#E2E8F0] shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-[#F1F5F9]">
            <h2 class="font-bold text-[#0F172A]">Top UMKM</h2>
            <p class="text-xs text-slate-400 mt-0.5">Berdasarkan jumlah pesanan dibuat</p>
        </div>
        <div class="divide-y divide-[#F1F5F9]">
            @forelse($topUmkm as $i => $u)
            @php $init = strtoupper(substr($u->nama_usaha ?? $u->name, 0, 2)); @endphp
            <div class="px-6 py-4 flex items-center gap-3">
                <span class="text-lg font-bold text-slate-200 shrink-0 w-6 text-center">{{ $i + 1 }}</span>
                @if($u->photo)
                    <img src="{{ asset('storage/' . $u->photo) }}" class="h-9 w-9 rounded-full object-cover shrink-0" alt="">
                @else
                    <div class="h-9 w-9 rounded-full bg-purple-100 flex items-center justify-center text-purple-700 font-bold text-xs shrink-0">
                        {{ $init }}
                    </div>
                @endif
                <div class="flex-1 min-w-0">
                    <p class="font-semibold text-[#0F172A] text-sm truncate">{{ $u->nama_usaha ?? $u->name }}</p>
                    <p class="text-xs text-slate-400">{{ $u->kategori_usaha ?? '—' }}</p>
                </div>
                <div class="text-right shrink-0">
                    <p class="text-sm font-bold text-[#1846A3]">{{ $u->pesanans_count }}</p>
                    <p class="text-xs text-slate-400">pesanan</p>
                </div>
            </div>
            @empty
            <div class="px-6 py-8 text-center text-sm text-slate-400">Belum ada data.</div>
            @endforelse
        </div>
    </div>

</div>

@endsection
