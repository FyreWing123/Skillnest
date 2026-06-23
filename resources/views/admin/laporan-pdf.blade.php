<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 10.5px;
            color: #1e293b;
            background: #ffffff;
        }

        /* ── HEADER ── */
        .header {
            background: #1846A3;
            color: white;
            padding: 18px 28px 16px;
            margin-bottom: 22px;
        }
        .header-top { overflow: hidden; }
        .header-logo { float: left; }
        .header-logo .brand { font-size: 20px; font-weight: bold; letter-spacing: -0.3px; }
        .header-logo .tagline { font-size: 9.5px; opacity: 0.75; margin-top: 2px; }
        .header-meta { float: right; text-align: right; font-size: 9.5px; opacity: 0.8; line-height: 1.6; }
        .header-divider { clear: both; border-top: 1px solid rgba(255,255,255,0.25); margin-top: 12px; padding-top: 8px; }
        .header-title { font-size: 13px; font-weight: bold; }
        .header-period { font-size: 9.5px; opacity: 0.75; margin-top: 2px; }

        /* ── SECTIONS ── */
        .wrap { padding: 0 28px; }
        .section { margin-bottom: 22px; }
        .section-title {
            font-size: 12px;
            font-weight: bold;
            color: #1846A3;
            border-bottom: 2px solid #1846A3;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }

        /* ── TABLES ── */
        table { width: 100%; border-collapse: collapse; font-size: 9.5px; }
        thead th {
            background: #1846A3;
            color: white;
            padding: 7px 9px;
            text-align: left;
            font-weight: bold;
        }
        tbody td {
            padding: 6px 9px;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: top;
        }
        tbody tr:nth-child(even) td { background: #f8fafc; }
        .text-center { text-align: center; }
        .text-right  { text-align: right; }
        .bold        { font-weight: bold; }
        .blue        { color: #1846A3; }
        .gold        { color: #b45309; }
        .green       { color: #047857; }
        .num-rank    { color: #cbd5e1; font-weight: bold; font-size: 11px; }

        /* ── MONTHLY GRID ── */
        .monthly-grid { width: 100%; border-collapse: collapse; }
        .monthly-grid th {
            background: #1846A3;
            color: white;
            padding: 6px 4px;
            text-align: center;
            font-size: 9px;
        }
        .monthly-grid td {
            text-align: center;
            padding: 8px 4px;
            font-weight: bold;
            border-bottom: 1px solid #e2e8f0;
            font-size: 11px;
        }
        .monthly-grid td.has-data { color: #1846A3; }
        .monthly-grid td.no-data  { color: #cbd5e1; }

        /* ── FOOTER ── */
        .footer {
            margin-top: 28px;
            padding: 10px 28px;
            border-top: 1px solid #e2e8f0;
            text-align: center;
            font-size: 8.5px;
            color: #94a3b8;
        }
        .footer .brand-mark { color: #1846A3; font-weight: bold; }
        .page-break { page-break-before: always; }
    </style>
</head>
<body>

{{-- ══════════════════════════ HEADER ══════════════════════════ --}}
<div class="header">
    <div class="header-top">
        <div class="header-logo">
            <div class="brand">SkillNest</div>
            <div class="tagline">Platform Jasa Mahasiswa untuk UMKM</div>
        </div>
        <div class="header-meta">
            Dicetak oleh: Admin<br>
            Tanggal: {{ now()->format('d M Y, H:i') }} WIB
        </div>
    </div>
    <div class="header-divider">
        <div class="header-title">Laporan & Statistik Platform</div>
        <div class="header-period">Periode: Januari – Desember {{ now()->year }}</div>
    </div>
</div>

<div class="wrap">

    {{-- ══════════════════════════ MONTHLY STATS ══════════════════════════ --}}
    <div class="section">
        <div class="section-title">Pesanan per Bulan — {{ now()->year }}</div>
        <table class="monthly-grid">
            <thead>
                <tr>
                    @foreach($monthlyStats as $m)
                        <th>{{ $m['label'] }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <tr>
                    @foreach($monthlyStats as $m)
                        <td class="{{ $m['count'] > 0 ? 'has-data' : 'no-data' }}">
                            {{ $m['count'] > 0 ? $m['count'] : '–' }}
                        </td>
                    @endforeach
                </tr>
            </tbody>
        </table>
        @php
            $totalPesananTahun = collect($monthlyStats)->sum('count');
            $bulanTertinggi    = collect($monthlyStats)->sortByDesc('count')->first();
        @endphp
        <p style="margin-top:8px; font-size:9px; color:#64748b;">
            Total pesanan tahun {{ now()->year }}: <strong>{{ $totalPesananTahun }}</strong>
            @if($bulanTertinggi && $bulanTertinggi['count'] > 0)
                &nbsp;·&nbsp; Bulan terlaris: <strong>{{ $bulanTertinggi['label'] }}</strong> ({{ $bulanTertinggi['count'] }} pesanan)
            @endif
        </p>
    </div>

    {{-- ══════════════════════════ TOP LAYANAN ══════════════════════════ --}}
    <div class="section">
        <div class="section-title">Top 5 Layanan Terlaris</div>
        <table>
            <thead>
                <tr>
                    <th style="width:28px" class="text-center">No</th>
                    <th>Nama Layanan</th>
                    <th>Pemilik (Mahasiswa)</th>
                    <th>Kategori</th>
                    <th style="width:70px" class="text-center">Total Pesanan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($topLayanan as $i => $l)
                <tr>
                    <td class="text-center num-rank">{{ $i + 1 }}</td>
                    <td class="bold">{{ $l->nama }}</td>
                    <td>{{ $l->user->name ?? '—' }}</td>
                    <td>{{ $l->kategori }}</td>
                    <td class="text-center bold blue">{{ $l->pesanans_count }}</td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center" style="color:#94a3b8; padding:14px">Belum ada data.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- ══════════════════════════ TOP MAHASISWA ══════════════════════════ --}}
    <div class="section">
        <div class="section-title">Top 5 Mahasiswa (Rata-rata Rating Tertinggi)</div>
        <table>
            <thead>
                <tr>
                    <th style="width:28px" class="text-center">No</th>
                    <th>Nama</th>
                    <th>Jurusan</th>
                    <th>Universitas</th>
                    <th style="width:70px" class="text-center">Avg Rating</th>
                    <th style="width:55px" class="text-center">Ulasan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($topMahasiswa as $i => $u)
                <tr>
                    <td class="text-center num-rank">{{ $i + 1 }}</td>
                    <td class="bold">{{ $u->name }}</td>
                    <td>{{ $u->jurusan ?? '—' }}</td>
                    <td>{{ $u->universitas ?? '—' }}</td>
                    <td class="text-center bold gold">★ {{ number_format($u->avgRating(), 1) }}</td>
                    <td class="text-center">{{ $u->ratingCount() }}</td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center" style="color:#94a3b8; padding:14px">Belum ada data.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- ══════════════════════════ TOP UMKM ══════════════════════════ --}}
    <div class="section">
        <div class="section-title">Top 5 UMKM (Pesanan Terbanyak)</div>
        <table>
            <thead>
                <tr>
                    <th style="width:28px" class="text-center">No</th>
                    <th>Nama / Nama Usaha</th>
                    <th>Kategori Usaha</th>
                    <th style="width:90px" class="text-center">Total Pesanan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($topUmkm as $i => $u)
                <tr>
                    <td class="text-center num-rank">{{ $i + 1 }}</td>
                    <td class="bold">{{ $u->nama_usaha ?? $u->name }}</td>
                    <td>{{ $u->kategori_usaha ?? '—' }}</td>
                    <td class="text-center bold blue">{{ $u->pesanans_count }}</td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center" style="color:#94a3b8; padding:14px">Belum ada data.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>{{-- end .wrap --}}

{{-- ══════════════════════════ FOOTER ══════════════════════════ --}}
<div class="footer">
    <span class="brand-mark">SkillNest</span>
    &nbsp;—&nbsp; Platform Jasa Mahasiswa untuk UMKM
    &nbsp;|&nbsp;
    Dokumen ini digenerate secara otomatis oleh sistem SkillNest pada {{ now()->format('d M Y, H:i') }} WIB.
    &nbsp;Hak cipta &copy; {{ now()->year }} SkillNest. Seluruh data bersifat rahasia.
</div>

</body>
</html>
