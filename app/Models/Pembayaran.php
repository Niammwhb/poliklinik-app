<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'pasien_id',
        'nama_tagihan',
        'jumlah',
        'bukti_bayar',
        'status'
    ];

    public function pasien()
    {
        return $this->belongsTo(User::class, 'pasien_id');
    }
}