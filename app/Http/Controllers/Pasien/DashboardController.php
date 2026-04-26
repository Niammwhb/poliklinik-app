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

        $antrianAktif = DaftarPoli::with([
                'jadwalPeriksa.dokter.poli'
            ])
            ->where('id_pasien', $user->id)
            ->latest()
            ->first();

        $jadwals = JadwalPeriksa::with([
                'dokter.poli'
            ])
            ->orderBy('hari')
            ->get();

        return view('pasien.dashboard', compact(
            'user',
            'antrianAktif',
            'jadwals'
        ));
    }
}