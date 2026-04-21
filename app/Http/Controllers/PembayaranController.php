<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    public function indexPasien()
    {
        $data = Pembayaran::where('pasien_id', Auth::id())->get();
        return view('pasien.pembayaran.index', compact('data'));
    }

    public function upload(Request $request, $id)
    {
        $request->validate([
            'bukti_bayar' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $file = $request->file('bukti_bayar')->store('bukti_pembayaran', 'public');

        Pembayaran::findOrFail($id)->update([
            'bukti_bayar' => $file,
            'status' => 'menunggu_verifikasi'
        ]);

        return back()->with('success', 'Bukti pembayaran berhasil diupload');
    }

    public function indexAdmin()
    {
        $data = Pembayaran::where('status','menunggu_verifikasi')->get();
        return view('admin.pembayaran.index', compact('data'));
    }

    public function verifikasi($id)
    {
        Pembayaran::findOrFail($id)->update([
            'status' => 'lunas'
        ]);

        return back()->with('success','Pembayaran berhasil diverifikasi');
    }
}