<?php

namespace App\Exports;

use App\Models\Obat;
use Maatwebsite\Excel\Concerns\{
    FromCollection,
    WithHeadings,
    ShouldAutoSize,
    WithStyles,
    WithEvents,
    WithCustomStartCell
};
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class ObatExport implements
    FromCollection,
    WithHeadings,
    ShouldAutoSize,
    WithStyles,
    WithEvents,
    WithCustomStartCell
{
    public function startCell(): string
    {
        return 'A4';
    }

    public function collection()
    {
        return Obat::select(
            'nama_obat',
            'kemasan',
            'harga',
            'stok'
        )->get();
    }

    public function headings(): array
    {
        return [
            'Nama Obat',
            'Kemasan',
            'Harga',
            'Stok'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            4 => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF']
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '4338CA']
                ]
            ]
        ];
    }

    public function registerEvents(): array
    {
        return [

            AfterSheet::class => function (AfterSheet $event) {

                $sheet = $event->sheet;

                $sheet->mergeCells('A1:D1');
                $sheet->setCellValue('A1', 'LAPORAN DATA OBAT POLIKLINIK');

                $sheet->mergeCells('A2:D2');
                $sheet->setCellValue('A2', 'Tanggal Export : ' . date('d-m-Y H:i'));

                $lastRow = $sheet->getHighestRow();

                $sheet->getStyle("A4:D{$lastRow}")
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(Border::BORDER_THIN);

                $sheet->freezePane('A5');
            }

        ];
    }
}