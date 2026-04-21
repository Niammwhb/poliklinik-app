<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pembayarans', function (Blueprint $table) {
    $table->id();
    $table->foreignId('pasien_id')->constrained('users')->onDelete('cascade');
    $table->string('nama_tagihan');
    $table->integer('jumlah');
    $table->string('bukti_bayar')->nullable();
    $table->enum('status', ['belum_bayar','menunggu_verifikasi','lunas','ditolak'])->default('belum_bayar');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
