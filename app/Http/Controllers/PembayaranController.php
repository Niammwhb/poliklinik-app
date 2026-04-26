<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | PASIEN - LIHAT TAGIHAN
    |--------------------------------------------------------------------------
    */
    public function indexPasien()
    {
        $data = Pembayaran::where('pasien_id', Auth::id())
            ->latest()
            ->get();

        return view('pasien.pembayaran.index', compact('data'));
    }

    /*
    |--------------------------------------------------------------------------
    | PASIEN - UPLOAD BUKTI BAYAR
    |--------------------------------------------------------------------------
    */
    public function upload(Request $request, $id)
    {
        $request->validate([
            'bukti_bayar' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $pembayaran = Pembayaran::findOrFail($id);

        $file = $request->file('bukti_bayar')
            ->store('bukti_pembayaran', 'public');

        $pembayaran->update([
            'bukti_bayar' => $file,
            'status'      => 'menunggu_verifikasi'
        ]);

        return back()->with('success', 'Bukti pembayaran berhasil diupload.');
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN - LIST VERIFIKASI
    |--------------------------------------------------------------------------
    */
    public function indexAdmin()
    {
        $data = Pembayaran::with('pasien')
            ->where('status', 'menunggu_verifikasi')
            ->latest()
            ->get();

        return view('admin.pembayaran.index', compact('data'));
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN - KONFIRMASI PEMBAYARAN
    |--------------------------------------------------------------------------
    */
    public function verifikasi($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        $pembayaran->update([
            'status' => 'lunas'
        ]);

        return back()->with('success', 'Pembayaran berhasil diverifikasi.');
    }
}