<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\PoliController;
use App\Http\Controllers\Admin\DokterController;
use App\Http\Controllers\Admin\PasienController;
use App\Http\Controllers\Admin\ObatController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

use App\Http\Controllers\Dokter\DashboardController as DokterDashboardController;
use App\Http\Controllers\Dokter\JadwalPeriksaController;
use App\Http\Controllers\Dokter\PeriksaController;

use App\Http\Controllers\Pasien\PoliController as PasienPoliController;
use App\Http\Controllers\Pasien\DashboardController;
use App\Http\Controllers\Pasien\RiwayatController;

use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\ExportController;



/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('admin.dashboard');

        Route::resource('polis', PoliController::class);
        Route::resource('dokter', DokterController::class);
        Route::resource('pasien', PasienController::class);
        Route::resource('obat', ObatController::class);

        Route::get('/pembayaran', [PembayaranController::class, 'indexAdmin'])
            ->name('admin.pembayaran');

        Route::post('/pembayaran/verifikasi/{id}', [PembayaranController::class, 'verifikasi'])
            ->name('admin.pembayaran.verifikasi');
    });



/*
|--------------------------------------------------------------------------
| DOKTER
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:dokter'])
    ->prefix('dokter')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Dashboard Dokter
        |--------------------------------------------------------------------------
        */
        Route::get('/dashboard', [DokterDashboardController::class, 'index'])
            ->name('dokter.dashboard');


        /*
        |--------------------------------------------------------------------------
        | Jadwal Periksa
        |--------------------------------------------------------------------------
        */
        Route::resource('jadwal-periksa', JadwalPeriksaController::class);

        Route::get('/jadwal-periksa/next/{id}', [JadwalPeriksaController::class, 'next'])
            ->name('jadwal-periksa.next');


        /*
        |--------------------------------------------------------------------------
        | Periksa Pasien
        |--------------------------------------------------------------------------
        */
        Route::get('/periksa', [PeriksaController::class, 'index'])
            ->name('dokter.periksa.index');

        Route::get('/riwayat-pasien', [PeriksaController::class, 'riwayat'])
            ->name('dokter.riwayat.index');

        Route::get('/periksa/{id}', [PeriksaController::class, 'create'])
            ->name('dokter.periksa.create');

        Route::post('/periksa/store', [PeriksaController::class, 'store'])
            ->name('dokter.periksa.store');

        Route::get('/periksa/edit/{id}', [PeriksaController::class, 'edit'])
            ->name('dokter.periksa.edit');

        Route::put('/periksa/update/{id}', [PeriksaController::class, 'update'])
            ->name('dokter.periksa.update');

        Route::delete('/periksa/delete/{id}', [PeriksaController::class, 'destroy'])
            ->name('dokter.periksa.destroy');
    });



/*
|--------------------------------------------------------------------------
| PASIEN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:pasien'])
    ->prefix('pasien')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('pasien.dashboard');

        Route::get('/daftar', [PasienPoliController::class, 'get'])
            ->name('pasien.daftar');

        Route::post('/daftar', [PasienPoliController::class, 'submit'])
            ->name('pasien.daftar.submit');

        Route::get('/pembayaran', [PembayaranController::class, 'indexPasien'])
            ->name('pasien.pembayaran');

        Route::post('/pembayaran/upload/{id}', [PembayaranController::class, 'upload'])
            ->name('pasien.pembayaran.upload');

        Route::get('/riwayat', [RiwayatController::class, 'index'])
            ->name('pasien.riwayat.index');

        Route::get('/riwayat/{id}', [RiwayatController::class, 'detail'])
            ->name('pasien.riwayat.detail');
    });



/*
|--------------------------------------------------------------------------
| EXPORT EXCEL
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/export/dokter', [ExportController::class, 'dokter']);
    Route::get('/export/pasien', [ExportController::class, 'pasien']);
    Route::get('/export/obat', [ExportController::class, 'obat']);
    Route::get('/export/jadwal', [ExportController::class, 'jadwal']);
    Route::get('/export/riwayat', [ExportController::class, 'riwayat']);
});