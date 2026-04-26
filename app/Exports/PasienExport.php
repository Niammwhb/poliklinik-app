<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PasienExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return User::where('role', 'pasien')
            ->get()
            ->map(function ($item) {
                return [
                    $item->nama,
                    $item->email,
                    $item->no_ktp,
                    $item->no_hp,
                    $item->alamat,
                    $item->no_rm,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Nama Pasien',
            'Email',
            'No KTP',
            'No HP',
            'Alamat',
            'No RM'
        ];
    }
}