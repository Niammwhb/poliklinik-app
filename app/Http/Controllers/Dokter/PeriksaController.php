<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\DaftarPoli;
use App\Models\Obat;
use App\Models\Periksa;
use App\Models\DetailPeriksa;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PeriksaController extends Controller
{
    public function index()
    {
        $dokter = Auth::user();

        $pasiens = DaftarPoli::with(['periksas', 'pasien'])
            ->whereHas('jadwalPeriksa', function ($q) use ($dokter) {
                $q->where('id_dokter', $dokter->id);
            })
            ->doesntHave('periksas')
            ->latest()
            ->get();

        return view('dokter.periksa.index', compact('pasiens'));
    }


    public function riwayat()
    {
        $dokter = Auth::user();

        $pasiens = DaftarPoli::with(['periksas', 'pasien'])
            ->whereHas('jadwalPeriksa', function ($q) use ($dokter) {
                $q->where('id_dokter', $dokter->id);
            })
            ->has('periksas')
            ->latest()
            ->get();

        return view('dokter.riwayat.index', compact('pasiens'));
    }


    public function create($id)
    {
        $dokter = Auth::user();

        $pasien = DaftarPoli::with('pasien')
            ->whereHas('jadwalPeriksa', function ($q) use ($dokter) {
                $q->where('id_dokter', $dokter->id);
            })
            ->findOrFail($id);

        $obats = Obat::all();

        return view('dokter.periksa.create', compact('pasien', 'obats'));
    }


    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $request->validate([
                'catatan'       => 'required',
                'biaya_periksa' => 'required|numeric|min:0',
                'id_obat'       => 'required',
            ]);

            $obat = Obat::findOrFail($request->id_obat);

            if ($obat->stok <= 0) {
                return back()->with('error', 'Stok obat habis.');
            }

            $periksa = Periksa::create([
                'id_daftar_poli' => $request->id_daftar_poli,
                'catatan'        => $request->catatan,
                'tgl_periksa'    => now(),
                'biaya_periksa'  => $request->biaya_periksa,
            ]);

            $daftarPoli = DaftarPoli::findOrFail($request->id_daftar_poli);

            Pembayaran::create([
                'pasien_id'    => $daftarPoli->id_pasien,
                'nama_tagihan' => 'Biaya Pemeriksaan',
                'jumlah'       => $request->biaya_periksa,
                'status'       => 'belum_bayar'
            ]);

            DetailPeriksa::create([
                'id_periksa' => $periksa->id,
                'id_obat'    => $obat->id,
            ]);

            $obat->decrement('stok');

            DB::commit();

            return redirect()->route('dokter.periksa.index')
                ->with('success', 'Pemeriksaan berhasil disimpan.');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('error', $e->getMessage());
        }
    }


    public function edit($id)
    {
        $periksa = Periksa::findOrFail($id);
        $detail  = DetailPeriksa::where('id_periksa', $id)->first();
        $obats   = Obat::all();

        return view('dokter.periksa.edit', compact(
            'periksa',
            'detail',
            'obats'
        ));
    }


    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {

            $request->validate([
                'catatan'       => 'required',
                'biaya_periksa' => 'required|numeric|min:0',
                'id_obat'       => 'required',
            ]);

            $periksa = Periksa::findOrFail($id);
            $detail  = DetailPeriksa::where('id_periksa', $id)->first();

            $obatBaru = Obat::findOrFail($request->id_obat);

            if ($obatBaru->stok <= 0 && $detail->id_obat != $obatBaru->id) {
                return back()->with('error', 'Stok obat habis.');
            }

            $periksa->update([
                'catatan'       => $request->catatan,
                'biaya_periksa' => $request->biaya_periksa,
            ]);

            $detail->update([
                'id_obat' => $request->id_obat,
            ]);

            DB::commit();

            return redirect()->route('dokter.riwayat.index')
                ->with('success', 'Data berhasil diupdate.');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('error', 'Gagal update data.');
        }
    }


    public function destroy($id)
    {
        $periksa = Periksa::findOrFail($id);

        DetailPeriksa::where('id_periksa', $id)->delete();

        $periksa->delete();

        return redirect()->route('dokter.riwayat.index')
            ->with('success', 'Data berhasil dihapus.');
    }
}