<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\DaftarPoli;
use App\Models\JadwalPeriksa;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $antrianAktif = DaftarPoli::where('id_pasien', $user->id)
    ->latest()
    ->first();

        // semua jadwal dokter
        $jadwals = JadwalPeriksa::with('dokter')->get();

        return view('pasien.dashboard', compact(
            'user',
            'antrianAktif',
            'jadwals'
        ));
    }
}