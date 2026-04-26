<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaftarPoli extends Model
{
    protected $table = 'daftar_poli';

    protected $fillable = [
        'id_jadwal',
        'id_pasien',
        'keluhan',
        'no_antrian'
    ];

    /*
    |--------------------------------------------------------------------------
    | Relasi Pasien
    |--------------------------------------------------------------------------
    */
    public function pasien()
    {
        return $this->belongsTo(User::class, 'id_pasien');
    }

    /*
    |--------------------------------------------------------------------------
    | Relasi Jadwal Periksa
    |--------------------------------------------------------------------------
    | nama lama: jadwalPeriksa()
    | ditambah jadwal() agar dashboard jalan
    |--------------------------------------------------------------------------
    */
    public function jadwalPeriksa()
    {
        return $this->belongsTo(JadwalPeriksa::class, 'id_jadwal');
    }

    public function jadwal()
    {
        return $this->belongsTo(JadwalPeriksa::class, 'id_jadwal');
    }

    /*
    |--------------------------------------------------------------------------
    | Relasi Periksa
    |--------------------------------------------------------------------------
    | hasMany untuk data lama
    | hasOne untuk dashboard
    |--------------------------------------------------------------------------
    */
    public function periksas()
    {
        return $this->hasMany(Periksa::class, 'id_daftar_poli');
    }

    public function periksa()
    {
        return $this->hasOne(Periksa::class, 'id_daftar_poli');
    }
}