@extends('admin.layout')
@section('title', 'Manajemen User')
@section('heading', 'Manajemen User')

@section('content')

{{-- HEADER ACTIONS --}}
<div class="flex items-center justify-between mb-6">
    <h2 class="text-lg font-bold text-[#0F172A]">Semua User Terdaftar</h2>
    <a href="{{ route('admin.users.export') }}"
       class="flex items-center gap-2 rounded-2xl bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-emerald-700 transition shadow-sm">
        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
        </svg>
        Download Excel
    </a>
</div>

{{-- FILTER --}}
<form method="GET" action="{{ route('admin.users') }}"
      class="mb-6 flex flex-wrap gap-3">
    <div class="flex flex-1 min-w-[220px] items-center gap-3 rounded-2xl border border-[#E2E8F0] bg-white px-4 py-3 shadow-sm">
        <svg class="h-4 w-4 text-slate-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/>
        </svg>
        <input type="search" name="q" value="{{ $q }}"
               placeholder="Cari nama, email, usaha..."
               class="flex-1 bg-transparent text-sm text-slate-700 outline-none placeholder:text-slate-400">
    </div>
    <select name="role" onchange="this.form.submit()"
            class="rounded-2xl border border-[#E2E8F0] bg-white px-4 py-3 text-sm text-slate-700 outline-none shadow-sm">
        <option value="">Semua Role</option>
        <option value="mahasiswa" {{ $role === 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
        <option value="umkm" {{ $role === 'umkm' ? 'selected' : '' }}>UMKM</option>
    </select>
    <button type="submit"
            class="rounded-2xl bg-[#1846A3] px-5 py-3 text-sm font-semibold text-white hover:bg-[#2563EB] transition">
        Cari
    </button>
    @if($q || $role)
        <a href="{{ route('admin.users') }}"
           class="rounded-2xl border border-[#E2E8F0] bg-white px-5 py-3 text-sm font-semibold text-slate-500 hover:bg-slate-50 transition">
            Reset
        </a>
    @endif
</form>

{{-- TABLE --}}
<div class="rounded-2xl bg-white border border-[#E2E8F0] shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-[#F1F5F9] flex items-center justify-between">
        <h2 class="font-bold text-[#0F172A]">Daftar User</h2>
        <span class="text-xs text-slate-400">{{ $users->total() }} user ditemukan</span>
    </div>

    @if($users->isEmpty())
        <div class="px-6 py-16 text-center text-slate-400 text-sm">Tidak ada user ditemukan.</div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-[#F8FAFC] border-b border-[#E2E8F0]">
                    <tr>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">User</th>
                        <th class="text-left px-4 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">Role</th>
                        <th class="text-center px-4 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">Layanan</th>
                        <th class="text-center px-4 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">Pesanan</th>
                        <th class="text-left px-4 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">Bergabung</th>
                        <th class="text-center px-4 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">Status</th>
                        <th class="text-center px-4 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#F1F5F9]">
                    @foreach($users as $u)
                    @php
                        $init = strtoupper(substr($u->name, 0, 2));
                        $roleColor = $u->role === 'mahasiswa'
                            ? 'bg-blue-100 text-blue-700'
                            : 'bg-purple-100 text-purple-700';
                    @endphp
                    <tr class="hover:bg-[#FAFBFC] transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                @if($u->photo)
                                    <img src="{{ asset('storage/' . $u->photo) }}" class="h-9 w-9 rounded-full object-cover shrink-0" alt="">
                                @else
                                    <div class="h-9 w-9 rounded-full bg-[#EAF2FF] flex items-center justify-center text-[#1846A3] font-bold text-xs shrink-0">
                                        {{ $init }}
                                    </div>
                                @endif
                                <div class="min-w-0">
                                    <p class="font-semibold text-[#0F172A] truncate">{{ $u->name }}</p>
                                    <p class="text-xs text-slate-400 truncate">{{ $u->email }}</p>
                                    @if($u->nama_usaha)
                                        <p class="text-xs text-slate-400 truncate">{{ $u->nama_usaha }}</p>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-4">
                            <span class="rounded-full px-2.5 py-1 text-xs font-bold {{ $roleColor }}">
                                {{ ucfirst($u->role) }}
                            </span>
                        </td>
                        <td class="px-4 py-4 text-center">
                            <span class="text-sm font-semibold text-slate-600">{{ $u->layanans_count }}</span>
                        </td>
                        <td class="px-4 py-4 text-center">
                            <span class="text-sm font-semibold text-slate-600">{{ $u->pesanans_count }}</span>
                        </td>
                        <td class="px-4 py-4 text-sm text-slate-500">
                            {{ $u->created_at->format('d M Y') }}
                        </td>
                        <td class="px-4 py-4 text-center">
                            @if($u->is_active)
                                <span class="rounded-full bg-green-100 px-2.5 py-1 text-xs font-bold text-green-700">Aktif</span>
                            @else
                                <span class="rounded-full bg-red-100 px-2.5 py-1 text-xs font-bold text-red-700">Suspended</span>
                            @endif
                        </td>
                        <td class="px-4 py-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.users.show', $u->id) }}"
                                   class="rounded-lg bg-[#EAF2FF] border border-[#BFDBFE] px-3 py-1.5 text-xs font-semibold text-[#1846A3] hover:bg-[#DBEAFE] transition">
                                    Detail
                                </a>
                                <form method="POST" action="{{ route('admin.users.toggle', $u->id) }}">
                                    @csrf @method('PATCH')
                                    <button type="submit"
                                            onclick="return confirm('{{ $u->is_active ? 'Suspend' : 'Aktifkan' }} akun {{ $u->name }}?')"
                                            class="rounded-lg px-3 py-1.5 text-xs font-semibold transition
                                                   {{ $u->is_active
                                                        ? 'bg-red-50 text-red-600 border border-red-200 hover:bg-red-100'
                                                        : 'bg-green-50 text-green-700 border border-green-200 hover:bg-green-100' }}">
                                        {{ $u->is_active ? 'Suspend' : 'Aktifkan' }}
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
        @if($users->hasPages())
        <div class="px-6 py-4 border-t border-[#F1F5F9] flex items-center justify-between">
            <p class="text-xs text-slate-400">
                Menampilkan {{ $users->firstItem() }}–{{ $users->lastItem() }} dari {{ $users->total() }}
            </p>
            <div class="flex gap-2">
                @if($users->onFirstPage())
                    <span class="rounded-lg border border-[#E2E8F0] px-3 py-1.5 text-xs text-slate-300 cursor-not-allowed">← Prev</span>
                @else
                    <a href="{{ $users->previousPageUrl() }}"
                       class="rounded-lg border border-[#E2E8F0] px-3 py-1.5 text-xs font-semibold text-slate-600 hover:bg-slate-50 transition">← Prev</a>
                @endif
                <span class="rounded-lg border border-[#1846A3] bg-[#1846A3] px-3 py-1.5 text-xs font-semibold text-white">
                    {{ $users->currentPage() }} / {{ $users->lastPage() }}
                </span>
                @if($users->hasMorePages())
                    <a href="{{ $users->nextPageUrl() }}"
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
