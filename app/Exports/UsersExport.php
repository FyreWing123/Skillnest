<?php

namespace App\Exports;

use App\Models\User;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;

class UsersExport
{
    public function download(): StreamedResponse
    {
        $users = User::where('role', '!=', 'admin')
            ->orderBy('role')
            ->orderBy('name')
            ->get();

        $spreadsheet = new Spreadsheet();
        $sheet       = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Data User SkillNest');

        // Headers
        $headers = [
            'No', 'Nama', 'Email', 'Role',
            'Universitas / Nama Usaha', 'Jurusan / Kategori Usaha',
            'Bergabung', 'Status',
        ];
        $sheet->fromArray([$headers], null, 'A1');

        // Header style
        $sheet->getStyle('A1:H1')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FF1846A3']],
            'alignment' => ['horizontal' => 'center'],
        ]);

        // Data rows
        $row = 2;
        foreach ($users as $i => $u) {
            $sheet->fromArray([[
                $i + 1,
                $u->name,
                $u->email,
                ucfirst($u->role),
                $u->role === 'mahasiswa' ? ($u->universitas ?? '—') : ($u->nama_usaha ?? '—'),
                $u->role === 'mahasiswa' ? ($u->jurusan ?? '—')     : ($u->kategori_usaha ?? '—'),
                $u->created_at->format('d M Y'),
                $u->is_active ? 'Aktif' : 'Suspended',
            ]], null, "A{$row}");

            if ($row % 2 === 0) {
                $sheet->getStyle("A{$row}:H{$row}")->getFill()
                    ->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FFF8FAFC');
            }
            $row++;
        }

        // Auto-size columns
        foreach (range('A', 'H') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Border
        if ($row > 1) {
            $sheet->getStyle("A1:H" . ($row - 1))->getBorders()->getAllBorders()
                ->setBorderStyle(Border::BORDER_THIN)->getColor()->setARGB('FFE2E8F0');
        }

        $filename = 'skillnest-users-' . now()->format('Y-m-d') . '.xlsx';
        $writer   = new Xlsx($spreadsheet);

        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, $filename, [
            'Content-Type'        => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Cache-Control'       => 'max-age=0',
        ]);
    }
}
