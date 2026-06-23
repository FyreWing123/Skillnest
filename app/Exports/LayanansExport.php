<?php

namespace App\Exports;

use App\Models\Layanan;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;

class LayanansExport
{
    public function download(): StreamedResponse
    {
        $layanans = Layanan::with('user')
            ->withCount('pesanans')
            ->orderBy('nama')
            ->get();

        $spreadsheet = new Spreadsheet();
        $sheet       = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Data Layanan SkillNest');

        // Headers
        $headers = [
            'No', 'Nama Layanan', 'Mahasiswa', 'Email',
            'Kategori', 'Harga', 'Estimasi', 'Status',
            'Jumlah Pesanan', 'Deskripsi Singkat',
        ];
        $sheet->fromArray([$headers], null, 'A1');

        // Header style
        $sheet->getStyle('A1:J1')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FF1846A3']],
            'alignment' => ['horizontal' => 'center'],
        ]);

        // Data rows
        $row = 2;
        foreach ($layanans as $i => $l) {
            $sheet->fromArray([[
                $i + 1,
                $l->nama,
                $l->user->name ?? '—',
                $l->user->email ?? '—',
                $l->kategori,
                $l->formatHarga(),
                $l->estimasi ?? '—',
                $l->isOpen() ? 'Open' : 'Closed',
                $l->pesanans_count,
                $l->deskripsi_singkat ?? '—',
            ]], null, "A{$row}");

            if ($row % 2 === 0) {
                $sheet->getStyle("A{$row}:J{$row}")->getFill()
                    ->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FFF8FAFC');
            }
            $row++;
        }

        // Auto-size columns
        foreach (range('A', 'J') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Border
        if ($row > 1) {
            $sheet->getStyle("A1:J" . ($row - 1))->getBorders()->getAllBorders()
                ->setBorderStyle(Border::BORDER_THIN)->getColor()->setARGB('FFE2E8F0');
        }

        $filename = 'skillnest-layanans-' . now()->format('Y-m-d') . '.xlsx';
        $writer   = new Xlsx($spreadsheet);

        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, $filename, [
            'Content-Type'  => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Cache-Control' => 'max-age=0',
        ]);
    }
}
