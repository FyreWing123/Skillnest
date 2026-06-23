@extends('admin.layout')
@section('title', 'Dashboard Admin')
@section('heading', 'Dashboard')

@section('content')

{{-- STATS GRID --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
    <div class="rounded-2xl bg-white border border-[#E2E8F0] p-6 shadow-sm">
        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide">Total User</p>
        <p class="mt-2 text-4xl font-bold text-[#1846A3]">{{ $stats['total_users'] }}</p>
        <div class="mt-2 flex gap-3 text-xs text-slate-400">
            <span>{{ $stats['total_mahasiswa'] }} mahasiswa</span>
            <span>·</span>
            <span>{{ $stats['total_umkm'] }} UMKM</span>
        </div>
    </div>
    <div class="rounded-2xl bg-white border border-[#E2E8F0] p-6 shadow-sm">
        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide">Total Layanan</p>
        <p class="mt-2 text-4xl font-bold text-[#1846A3]">{{ $stats['total_layanan'] }}</p>
    </div>
    <div class="rounded-2xl bg-white border border-[#E2E8F0] p-6 shadow-sm">
        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide">Total Pesanan</p>
        <p class="mt-2 text-4xl font-bold text-[#1846A3]">{{ $stats['total_pesanan'] }}</p>
        <p class="mt-2 text-xs text-slate-400">{{ $stats['total_selesai'] }} selesai</p>
    </div>
    <div class="rounded-2xl bg-white border border-[#E2E8F0] p-6 shadow-sm">
        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide">Total Ulasan</p>
        <p class="mt-2 text-4xl font-bold text-[#1846A3]">{{ $stats['total_ratings'] }}</p>
    </div>
</div>

{{-- SECONDARY STATS --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
    <div class="rounded-2xl bg-blue-50 border border-blue-100 p-5">
        <p class="text-xs font-semibold text-blue-600">Mahasiswa</p>
        <p class="text-3xl font-bold text-blue-700 mt-1">{{ $stats['total_mahasiswa'] }}</p>
    </div>
    <div class="rounded-2xl bg-purple-50 border border-purple-100 p-5">
        <p class="text-xs font-semibold text-purple-600">UMKM</p>
        <p class="text-3xl font-bold text-purple-700 mt-1">{{ $stats['total_umkm'] }}</p>
    </div>
    <div class="rounded-2xl bg-green-50 border border-green-100 p-5">
        <p class="text-xs font-semibold text-green-600">Pesanan Selesai</p>
        <p class="text-3xl font-bold text-green-700 mt-1">{{ $stats['total_selesai'] }}</p>
    </div>
    <div class="rounded-2xl bg-red-50 border border-red-100 p-5">
        <p class="text-xs font-semibold text-red-600">Akun Suspended</p>
        <p class="text-3xl font-bold text-red-700 mt-1">{{ $stats['suspended'] }}</p>
    </div>
</div>

<div class="grid gap-6 lg:grid-cols-2">

    {{-- RECENT USERS --}}
    <div class="rounded-2xl bg-white border border-[#E2E8F0] shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-[#F1F5F9] flex items-center justify-between">
            <h2 class="font-bold text-[#0F172A]">Registrasi Terbaru</h2>
            <a href="{{ route('admin.users') }}" class="text-xs font-semibold text-[#2563EB] hover:underline">Lihat Semua</a>
        </div>
        <div class="divide-y divide-[#F1F5F9]">
            @forelse($recentUsers as $u)
            @php
                $init = strtoupper(substr($u->name, 0, 2));
                $roleColor = $u->role === 'mahasiswa'
                    ? 'bg-blue-100 text-blue-700'
                    : 'bg-purple-100 text-purple-700';
            @endphp
            <div class="px-6 py-3 flex items-center gap-3">
                @if($u->photo)
                    <img src="{{ asset('storage/' . $u->photo) }}" class="h-9 w-9 rounded-full object-cover shrink-0" alt="">
                @else
                    <div class="h-9 w-9 rounded-full bg-[#EAF2FF] flex items-center justify-center text-[#1846A3] font-bold text-xs shrink-0">
                        {{ $init }}
                    </div>
                @endif
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-[#0F172A] truncate">{{ $u->name }}</p>
                    <p class="text-xs text-slate-400 truncate">{{ $u->email }}</p>
                </div>
                <div class="flex items-center gap-2 shrink-0">
                    <span class="rounded-full px-2 py-0.5 text-xs font-bold {{ $roleColor }}">
                        {{ ucfirst($u->role) }}
                    </span>
                    <span class="text-xs text-slate-400">{{ $u->created_at->format('d M') }}</span>
                </div>
            </div>
            @empty
            <div class="px-6 py-8 text-center text-sm text-slate-400">Belum ada user.</div>
            @endforelse
        </div>
    </div>

    {{-- RECENT PESANANS --}}
    <div class="rounded-2xl bg-white border border-[#E2E8F0] shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-[#F1F5F9] flex items-center justify-between">
            <h2 class="font-bold text-[#0F172A]">Pesanan Terbaru</h2>
            <a href="{{ route('admin.pesanans') }}" class="text-xs font-semibold text-[#2563EB] hover:underline">Lihat Semua</a>
        </div>
        <div class="divide-y divide-[#F1F5F9]">
            @forelse($recentPesanans as $p)
            <div class="px-6 py-3 flex items-center gap-3">
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-[#0F172A] truncate">{{ $p->layanan->nama ?? '—' }}</p>
                    <p class="text-xs text-slate-400 truncate">
                        {{ $p->user->nama_usaha ?? $p->user->name }}
                        → {{ $p->layanan->user->name ?? '—' }}
                    </p>
                </div>
                <div class="flex items-center gap-2 shrink-0">
                    <span class="rounded-lg px-2 py-0.5 text-xs font-bold {{ $p->statusColor() }}">
                        {{ $p->statusLabel() }}
                    </span>
                    <span class="text-xs text-slate-400">{{ $p->created_at->format('d M') }}</span>
                </div>
            </div>
            @empty
            <div class="px-6 py-8 text-center text-sm text-slate-400">Belum ada pesanan.</div>
            @endforelse
        </div>
    </div>

</div>

@endsection
