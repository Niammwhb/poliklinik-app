<?php

namespace App\Exports;

use App\Models\Periksa;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RiwayatPasienExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $dokterId = Auth::id();

        return Periksa::whereHas('daftarPoli.jadwalPeriksa', function ($q) use ($dokterId) {
                $q->where('id_dokter', $dokterId);
            })
            ->with('daftarPoli.pasien')
            ->get()
            ->map(function ($item) {
                return [
                    $item->daftarPoli->pasien->nama ?? '-',
                    $item->tgl_periksa ?? '-',
                    $item->catatan ?? '-',
                    $item->biaya_periksa ?? 0,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Nama Pasien',
            'Tanggal Periksa',
            'Catatan',
            'Biaya Periksa'
        ];
    }
}