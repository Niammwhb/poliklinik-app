<?php

namespace App\Http\Controllers;

use App\Exports\DokterExport;
use App\Exports\PasienExport;
use App\Exports\ObatExport;
use App\Exports\JadwalPeriksaExport;
use App\Exports\RiwayatPasienExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function dokter()
    {
        return Excel::download(new DokterExport, 'dokter.xlsx');
    }

    public function pasien()
    {
        return Excel::download(new PasienExport, 'pasien.xlsx');
    }

    public function obat()
    {
        return Excel::download(new ObatExport, 'obat.xlsx');
    }

    public function jadwal()
    {
        return Excel::download(new JadwalPeriksaExport, 'jadwal-periksa.xlsx');
    }

    public function riwayat()
    {
        return Excel::download(new RiwayatPasienExport, 'riwayat-pasien.xlsx');
    }
}