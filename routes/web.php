<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DaftarAsprakController;
use App\Http\Controllers\Dashboard\DaftarMataKuliahController;
use App\Http\Controllers\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\ManagementUser;
use App\Http\Controllers\Dashboard\MataKuliahController;
use App\Http\Controllers\Dashboard\PendaftaranAsprakController;
use App\Http\Controllers\Dashboard\VerifikasiController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::view('/', 'dashboard.pendaftaran.index')->name('home');
// Route::view('/home', 'dashboard.pendaftaran.index')->name('home');
Route::get('/', function () {
    return redirect()->route('calonasprak.index');
})->name('home');

Route::resource('calonasprak',          DaftarAsprakController::class)->only(['index', 'store']);
Route::get('calonasprak/login',         [DaftarAsprakController::class, 'login'])->name('calonasprak.login');
Route::post('calonasprak/login',        [DaftarAsprakController::class, 'loginpost'])->name('calonasprak.login.post');
Route::get('calonasprak/daftar',        [DaftarAsprakController::class, 'form'])->name('calonasprak.form');
Route::get('calonasprak/jadwal',        [DaftarAsprakController::class, 'jadwal'])->name('calonasprak.jadwal');
Route::get('calonasprak/tidak-ada-pembukaan',   [DaftarAsprakController::class, 'none'])->name('calonasprak.none');

Auth::routes(['register' => false]);

Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['admin']], function () {
        // Verifikasi Berkas1
        Route::get('asprak/verifikasi',             [VerifikasiController::class, 'index'])->name('asprak.index');
        Route::get('asprak/verifikasi/search',      [VerifikasiController::class, 'berkasmatkul'])->name('asprak.index.matkul');
        Route::post('asprak/verifikasi',            [VerifikasiController::class, 'verifikasiberkas'])->name('asprak.verifikasi');

        // Route Pembukaan Pendaftaran Asprak
        Route::resource('rekrut',                   PendaftaranAsprakController::class);
        Route::resource('matakuliah',               MataKuliahController::class)->except(['index', 'show']);
        Route::resource('daftarmatakuliah',         DaftarMataKuliahController::class)->only(['create', 'store']);

        // Verifikasi Kelulusan dan Penilaian
        Route::get('asprak/penilaian',              [VerifikasiController::class, 'indexnilai'])->name('asprak.nilai.index');
        Route::post('asprak/penilain',              [VerifikasiController::class, 'penilaian'])->name('asprak.verifikasi.nilai');
        Route::get('asprak/verifikasi/nilai/search', [VerifikasiController::class, 'penilaianmatkul'])->name('asprak.nilai.index.matkul');
        Route::post('asprak/verifikasi/lulus',      [VerifikasiController::class, 'verifikasilulus'])->name('asprak.verifikasi.lulus');
    });
    Route::get('calonasprak/seleksi',           [DaftarAsprakController::class, 'seleksi'])->name('calonasprak.seleksi');
    Route::get('calonasprak/seleksi/{id}',      [DaftarAsprakController::class, 'seleksishow'])->name('calonasprak.test');
    Route::post('calonasprak/seleksi/{id}',     [DaftarAsprakController::class, 'seleksiupload'])->name('calonasprak.test.store');
    Route::post('calonasprak/logout',           [DaftarAsprakController::class, 'logout'])->name('calonasprak.logout');

    // Auth Route
    Route::get('dashboard',                     [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('logout',                       [AuthController::class, 'logout'])->name('logout');
    Route::resource('user',                     ManagementUser::class)->only(['edit', 'update']);
});
