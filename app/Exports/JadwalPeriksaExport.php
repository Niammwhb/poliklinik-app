<?php

namespace App\Exports;

use App\Models\JadwalPeriksa;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class JadwalPeriksaExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $dokterId = Auth::id();

        return JadwalPeriksa::where('id_dokter', $dokterId)
            ->get()
            ->map(function ($item) {
                return [
                    $item->hari,
                    $item->jam_mulai,
                    $item->jam_selesai,
                    $item->nomor_sekarang ?? 0,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Hari',
            'Jam Mulai',
            'Jam Selesai',
            'Nomor Sekarang'
        ];
    }
}