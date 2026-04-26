<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DokterExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return User::where('role', 'dokter')
            ->with('poli')
            ->get()
            ->map(function ($item) {
                return [
                    $item->nama,
                    $item->email,
                    $item->no_ktp,
                    $item->no_hp,
                    $item->alamat,
                    $item->poli->nama_poli ?? '-',
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Nama Dokter',
            'Email',
            'No KTP',
            'No HP',
            'Alamat',
            'Poli'
        ];
    }
}