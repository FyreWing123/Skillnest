@extends('admin.layout')
@section('title', $user->name . ' — Detail User')
@section('heading', 'Detail User')

@section('content')

{{-- BACK + TOGGLE --}}
<div class="flex items-center justify-between mb-6">
    <a href="{{ route('admin.users') }}"
       class="text-sm font-semibold text-slate-500 hover:text-[#1846A3] transition">
        ← Kembali ke Manajemen User
    </a>
    <form method="POST" action="{{ route('admin.users.toggle', $user->id) }}">
        @csrf @method('PATCH')
        <button type="submit"
                onclick="return confirm('{{ $user->is_active ? 'Suspend' : 'Aktifkan' }} akun {{ $user->name }}?')"
                class="rounded-xl px-4 py-2 text-sm font-semibold transition
                       {{ $user->is_active
                            ? 'bg-red-50 text-red-600 border border-red-200 hover:bg-red-100'
                            : 'bg-green-50 text-green-700 border border-green-200 hover:bg-green-100' }}">
            {{ $user->is_active ? 'Suspend Akun' : 'Aktifkan Akun' }}
        </button>
    </form>
</div>

<div class="grid gap-6 lg:grid-cols-3">

    {{-- LEFT: PROFIL --}}
    <div class="space-y-6">

        {{-- Avatar + Nama --}}
        <div class="rounded-2xl bg-white border border-[#E2E8F0] shadow-sm p-6">
            <div class="flex flex-col items-center text-center">
                @if($user->photo)
                    <img src="{{ asset('storage/' . $user->photo) }}"
                         class="h-20 w-20 rounded-full object-cover mb-4" alt="">
                @else
                    @php $init = strtoupper(substr($user->name, 0, 2)); @endphp
                    <div class="h-20 w-20 rounded-full flex items-center justify-center font-bold text-2xl mb-4
                                {{ $user->role === 'umkm' ? 'bg-purple-100 text-purple-700' : 'bg-[#EAF2FF] text-[#1846A3]' }}">
                        {{ $init }}
                    </div>
                @endif

                <h2 class="text-lg font-bold text-[#0F172A]">{{ $user->name }}</h2>
                @if($user->role === 'umkm' && $user->nama_usaha)
                    <p class="text-sm text-slate-500 mt-0.5">{{ $user->nama_usaha }}</p>
                @endif
                <p class="text-sm text-slate-400 mt-0.5">{{ $user->email }}</p>

                <div class="flex items-center gap-2 mt-3">
                    <span class="rounded-full px-3 py-1 text-xs font-bold
                                 {{ $user->role === 'mahasiswa' ? 'bg-blue-100 text-blue-700' : 'bg-purple-100 text-purple-700' }}">
                        {{ ucfirst($user->role) }}
                    </span>
                    <span class="rounded-full px-3 py-1 text-xs font-bold
                                 {{ $user->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        {{ $user->is_active ? 'Aktif' : 'Suspended' }}
                    </span>
                </div>
                <p class="text-xs text-slate-400 mt-3">Bergabung {{ $user->created_at->format('d M Y') }}</p>
            </div>
        </div>

        {{-- Info Detail --}}
        <div class="rounded-2xl bg-white border border-[#E2E8F0] shadow-sm p-6">
            <h3 class="font-bold text-[#0F172A] mb-4">
                Informasi {{ $user->role === 'mahasiswa' ? 'Mahasiswa' : 'UMKM' }}
            </h3>
            <div class="space-y-4">
                @if($user->role === 'mahasiswa')
                    @if($user->universitas)
                    <div>
                        <p class="text-xs text-slate-400 mb-0.5">Universitas</p>
                        <p class="text-sm font-semibold text-[#0F172A]">{{ $user->universitas }}</p>
                    </div>
                    @endif
                    @if($user->jurusan)
                    <div>
                        <p class="text-xs text-slate-400 mb-0.5">Jurusan</p>
                        <p class="text-sm font-semibold text-[#0F172A]">{{ $user->jurusan }}</p>
                    </div>
                    @endif
                    @if($user->semester)
                    <div>
                        <p class="text-xs text-slate-400 mb-0.5">Semester</p>
                        <p class="text-sm font-semibold text-[#0F172A]">{{ $user->semester }}</p>
                    </div>
                    @endif
                    @if($user->bio)
                    <div>
                        <p class="text-xs text-slate-400 mb-0.5">Bio</p>
                        <p class="text-sm text-slate-600 leading-relaxed">{{ $user->bio }}</p>
                    </div>
                    @endif
                    @if(count($user->skills_array))
                    <div>
                        <p class="text-xs text-slate-400 mb-2">Skills</p>
                        <div class="flex flex-wrap gap-1.5">
                            @foreach($user->skills_array as $skill)
                                <span class="rounded-full bg-[#EAF2FF] px-2.5 py-1 text-xs font-semibold text-[#1846A3]">
                                    {{ $skill }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    @if(!$user->universitas && !$user->jurusan && !$user->bio && !count($user->skills_array))
                        <p class="text-sm text-slate-400 italic">Profil belum dilengkapi.</p>
                    @endif
                @else
                    @if($user->kategori_usaha)
                    <div>
                        <p class="text-xs text-slate-400 mb-0.5">Kategori Usaha</p>
                        <p class="text-sm font-semibold text-[#0F172A]">{{ $user->kategori_usaha }}</p>
                    </div>
                    @endif
                    @if($user->alamat_usaha)
                    <div>
                        <p class="text-xs text-slate-400 mb-0.5">Alamat</p>
                        <p class="text-sm text-slate-600">{{ $user->alamat_usaha }}</p>
                    </div>
                    @endif
                    @if($user->no_whatsapp)
                    <div>
                        <p class="text-xs text-slate-400 mb-0.5">WhatsApp</p>
                        <p class="text-sm font-semibold text-[#0F172A]">{{ $user->no_whatsapp }}</p>
                    </div>
                    @endif
                    @if($user->deskripsi_usaha)
                    <div>
                        <p class="text-xs text-slate-400 mb-0.5">Deskripsi Usaha</p>
                        <p class="text-sm text-slate-600 leading-relaxed">{{ $user->deskripsi_usaha }}</p>
                    </div>
                    @endif
                    @if(!$user->kategori_usaha && !$user->alamat_usaha && !$user->deskripsi_usaha)
                        <p class="text-sm text-slate-400 italic">Profil belum dilengkapi.</p>
                    @endif
                @endif
            </div>
        </div>
    </div>

    {{-- RIGHT: LAYANAN (mahasiswa) atau PESANAN (umkm) --}}
    <div class="lg:col-span-2">

        @if($user->role === 'mahasiswa')

        {{-- LAYANAN --}}
        <div class="rounded-2xl bg-white border border-[#E2E8F0] shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-[#F1F5F9] flex items-center justify-between">
                <h3 class="font-bold text-[#0F172A]">Layanan Dikelola</h3>
                <span class="text-xs text-slate-400">{{ $layanans->count() }} layanan</span>
            </div>

            @forelse($layanans as $l)
            <div class="px-6 py-5 border-b border-[#F1F5F9] last:border-0">
                <div class="flex items-start gap-4">
                    @if($l->thumbnail)
                        <img src="{{ asset('storage/' . $l->thumbnail) }}"
                             class="h-14 w-20 rounded-xl object-cover shrink-0" alt="">
                    @else
                        <div class="h-14 w-20 rounded-xl bg-gradient-to-br from-[#2563EB] to-[#1149C7] shrink-0"></div>
                    @endif
                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between gap-3">
                            <div class="min-w-0">
                                <p class="font-semibold text-[#0F172A] truncate">{{ $l->nama }}</p>
                                <div class="flex flex-wrap items-center gap-1.5 mt-1">
                                    <span class="rounded-full bg-[#EAF2FF] px-2 py-0.5 text-xs font-semibold text-[#1846A3]">
                                        {{ $l->kategori }}
                                    </span>
                                    @if($l->isOpen())
                                        <span class="rounded-full bg-emerald-100 px-2 py-0.5 text-xs font-bold text-emerald-700">Open</span>
                                    @else
                                        <span class="rounded-full bg-slate-100 px-2 py-0.5 text-xs font-bold text-slate-500">Closed</span>
                                    @endif
                                </div>
                            </div>
                            <a href="{{ route('admin.layanans.show', $l->id) }}"
                               class="shrink-0 rounded-xl bg-[#EAF2FF] px-3 py-1.5 text-xs font-semibold text-[#1846A3] hover:bg-[#DBEAFE] transition">
                                Lihat Detail
                            </a>
                        </div>
                        <div class="flex flex-wrap items-center gap-4 mt-2.5 text-xs">
                            <span class="font-bold text-[#1846A3]">{{ $l->formatHarga() }}</span>
                            <span class="text-slate-500">{{ $l->pesanans_count }} pesanan</span>
                            @if($l->avg_rating)
                                <span class="text-yellow-500 font-semibold">★ {{ $l->avg_rating }}
                                    <span class="text-slate-400 font-normal">({{ $l->rating_count }} ulasan)</span>
                                </span>
                            @else
                                <span class="text-slate-400">Belum ada rating</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="px-6 py-16 text-center text-sm text-slate-400">
                Mahasiswa ini belum memiliki layanan.
            </div>
            @endforelse
        </div>

        @else

        {{-- RIWAYAT PESANAN UMKM --}}
        <div class="rounded-2xl bg-white border border-[#E2E8F0] shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-[#F1F5F9] flex items-center justify-between">
                <h3 class="font-bold text-[#0F172A]">Riwayat Pesanan</h3>
                <span class="text-xs text-slate-400">{{ $pesanans->count() }} pesanan dilakukan</span>
            </div>

            @forelse($pesanans as $p)
            <div class="px-6 py-5 border-b border-[#F1F5F9] last:border-0">
                <div class="flex items-start gap-4">
                    @if($p->layanan && $p->layanan->thumbnail)
                        <img src="{{ asset('storage/' . $p->layanan->thumbnail) }}"
                             class="h-12 w-16 rounded-lg object-cover shrink-0" alt="">
                    @else
                        <div class="h-12 w-16 rounded-lg bg-gradient-to-br from-[#2563EB] to-[#1149C7] shrink-0"></div>
                    @endif
                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between gap-3">
                            <div class="min-w-0">
                                <p class="font-semibold text-[#0F172A] truncate">{{ $p->layanan->nama ?? '—' }}</p>
                                <p class="text-xs text-slate-400 mt-0.5">
                                    oleh <span class="font-medium text-slate-600">{{ $p->layanan->user->name ?? '—' }}</span>
                                </p>
                            </div>
                            <span class="rounded-lg px-2.5 py-1 text-xs font-bold shrink-0 {{ $p->statusColor() }}">
                                {{ $p->statusLabel() }}
                            </span>
                        </div>
                        <div class="flex items-center gap-4 mt-2 text-xs text-slate-500">
                            <span class="font-semibold text-[#1846A3]">{{ $p->layanan->formatHarga() ?? '' }}</span>
                            <span>{{ $p->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="px-6 py-16 text-center text-sm text-slate-400">
                UMKM ini belum pernah melakukan pesanan.
            </div>
            @endforelse
        </div>

        @endif
    </div>

</div>

@endsection
