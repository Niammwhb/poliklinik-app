<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\DaftarPoli;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function index()
    {
        $riwayat = DaftarPoli::with([
            'jadwalPeriksa.dokter.poli',
            'periksas'
        ])
        ->where('id_pasien', Auth::user()->id)
        ->latest()
        ->get();

        return view('pasien.riwayat.index', compact('riwayat'));
    }

    public function detail($id)
    {
        $data = DaftarPoli::with([
            'jadwalPeriksa.dokter.poli',
            'periksas.detailPeriksas.obat'
        ])
        ->where('id_pasien', Auth::user()->id)
        ->findOrFail($id);

        return view('pasien.riwayat.detail', compact('data'));
    }
}