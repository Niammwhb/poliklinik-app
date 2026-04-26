<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\JadwalPeriksa;
use App\Models\DaftarPoli;

class DashboardController extends Controller
{
    public function index()
    {
        $dokter = Auth::user();

        $totalJadwal = JadwalPeriksa::where('id_dokter', $dokter->id)->count();

        $pasienMenunggu = DaftarPoli::whereHas('jadwalPeriksa', function ($q) use ($dokter) {
                $q->where('id_dokter', $dokter->id);
            })
            ->whereDoesntHave('periksas')
            ->count();

        $totalRiwayat = DaftarPoli::whereHas('jadwalPeriksa', function ($q) use ($dokter) {
                $q->where('id_dokter', $dokter->id);
            })
            ->whereHas('periksas')
            ->count();

        $jadwalList = JadwalPeriksa::where('id_dokter', $dokter->id)
            ->latest()
            ->take(5)
            ->get();

        return view('dokter.dashboard', compact(
            'totalJadwal',
            'pasienMenunggu',
            'totalRiwayat',
            'jadwalList'
        ));
    }
}