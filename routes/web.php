<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Guru\DaftarSiswaController;
use App\Http\Controllers\Guru\GuruNilaiController;
use App\Http\Controllers\Guru\GuruPenerapanController;
use App\Http\Controllers\Guru\GuruSoalController;
use App\Http\Controllers\Guru\GuruSubSoalController;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\Registrasi\RegistrasiController;
use App\Http\Controllers\Setting\SettingController;
use App\Http\Controllers\Siswa\SiswaInstrumentController;
use App\Http\Controllers\Siswa\SiswaNilaiController;
use App\Http\Middleware\CekLevel;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

// Login
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login/authenticate', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::get('/logout-action', [LoginController::class, 'logout'])->name('logout-action.logout');

// Registrasi
Route::get('/registrasi', [RegistrasiController::class, 'index'])->name('registrasi.index');
Route::post('/registrasi/store', [RegistrasiController::class, 'store'])->name('registrasi.store');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
    Route::post('/setting/updateprofile', [SettingController::class, 'updateprofile'])->name('setting.updateprofile');
    Route::post('/setting/updateusername', [SettingController::class, 'updateusername'])->name('setting.updateusername');
    Route::post('/setting/updatepassword', [SettingController::class, 'updatepassword'])->name('setting.updatepassword');
    Route::post('/setting/updategambar', [SettingController::class, 'updategambar'])->name('setting.updategambar');
    Route::post('/setting/deletegambar', [SettingController::class, 'deletegambar'])->name('setting.deletegambar');

    // Admin
    Route::group(['middleware' => [CekLevel::class . ':Admin']], function () {
    });

    // Guru
    Route::group(['middleware' => [CekLevel::class . ':Guru']], function () {
        Route::get('/daftar-siswa', [DaftarSiswaController::class, 'index'])->name('daftar-siswa.index');
        Route::get('/daftar-siswa/create', [DaftarSiswaController::class, 'create'])->name('daftar-siswa.create');
        Route::get('/daftar-siswa/edit/{id}', [DaftarSiswaController::class, 'edit'])->name('daftar-siswa.edit');
        Route::post('/daftar-siswa/store', [DaftarSiswaController::class, 'store'])->name('daftar-siswa.store');
        Route::post('/daftar-siswa/update/{id}', [DaftarSiswaController::class, 'update'])->name('daftar-siswa.update');
        Route::post('/daftar-siswa/destroy/{id}', [DaftarSiswaController::class, 'destroy'])->name('daftar-siswa.destroy');

        // Nilai
        Route::get('/guru-nilai', [GuruNilaiController::class, 'index'])->name('guru-nilai.index');
        Route::get('/guru-nilai/show/{id}', [GuruNilaiController::class, 'show'])->name('guru-nilai.show');
        Route::get('/guru-nilai/exportpdf/{id}', [GuruNilaiController::class, 'generatePDF'])->name('guru-nilai.exportpdf');
        Route::get('/guru-nilai/hasilpeserta', [GuruNilaiController::class, 'hasilpeserta'])->name('guru-nilai.hasilpeserta');
        Route::get('/guru-nilai/showhasilpeserta/{id}', [GuruNilaiController::class, 'showhasilpeserta'])->name('guru-nilai.showhasilpeserta');
        Route::get('/guru-nilai/exporthasil/{id}', [GuruNilaiController::class, 'generateHasilPesertaPDF'])->name('guru-nilai.exporthasil');

        // Soal
        Route::get('/guru-soal', [GuruSoalController::class, 'index'])->name('guru-soal.index');
        Route::get('/guru-soal/create', [GuruSoalController::class, 'create'])->name('guru-soal.create');
        Route::get('/guru-soal/edit/{id}', [GuruSoalController::class, 'edit'])->name('guru-soal.edit');
        Route::get('/guru-soal/show/{id}', [GuruSoalController::class, 'show'])->name('guru-soal.show');
        Route::get('/guru-soal/createjawaban/{id}', [GuruSoalController::class, 'createjawaban'])->name('guru-soal.createjawaban');
        Route::get('/guru-soal/editjawaban/{id}', [GuruSoalController::class, 'editjawaban'])->name('guru-soal.editjawaban');
        Route::post('/guru-soal/storejawaban', [GuruSoalController::class, 'storejawaban'])->name('guru-soal.storejawaban');
        Route::post('/guru-soal/updatejawaban/{id}', [GuruSoalController::class, 'updatejawaban'])->name('guru-soal.updatejawaban');
        Route::post('/guru-soal/destroyjawaban/{id}', [GuruSoalController::class, 'destroyjawaban'])->name('guru-soal.destroyjawaban');
        Route::post('/guru-soal/store', [GuruSoalController::class, 'store'])->name('guru-soal.store');
        Route::post('/guru-soal/update/{id}', [GuruSoalController::class, 'update'])->name('guru-soal.update');
        Route::post('/guru-soal/destroy/{id}', [GuruSoalController::class, 'destroy'])->name('guru-soal.destroy');

        // SubSoal
        Route::get('guru-subsoal', [GuruSubSoalController::class, 'index'])->name('guru-subsoal.index');
        Route::get('guru-subsoal/subsoal/{id}', [GuruSubSoalController::class, 'subsoal'])->name('guru-subsoal.subsoal');
        Route::get('guru-subsoal/createsubsoal/{id}', [GuruSubSoalController::class, 'createsubsoal'])->name('guru-subsoal.createsubsoal');
        Route::get('guru-subsoal/editsubsoal/{id}', [GuruSubSoalController::class, 'editsubsoal'])->name('guru-subsoal.editsubsoal');
        Route::post('guru-subsoal/storesubsoal', [GuruSubSoalController::class, 'storesubsoal'])->name('guru-subsoal.storesubsoal');
        Route::post('guru-subsoal/updatesubsoal/{id}', [GuruSubSoalController::class, 'updatesubsoal'])->name('guru-subsoal.updatesubsoal');
        Route::post('guru-subsoal/destroysubsoal/{id}', [GuruSubSoalController::class, 'destroysubsoal'])->name('guru-subsoal.destroysubsoal');

        // Jawaban Sub Soal
        Route::get('guru-jawabansubs/{id}', [GuruSubSoalController::class, 'indexjawabansubsoal'])->name('guru-jawabansubs.index');
        Route::get('guru-jawabansubs/create/{id}', [GuruSubSoalController::class, 'createjawabansubsoal'])->name('guru-jawabansubs.createjawabansubsoal');
        Route::get('guru-jawabansubs/edit/{id}', [GuruSubSoalController::class, 'editjawabansubsoal'])->name('guru-jawabansubs.editjawabansubsoal');
        Route::post('guru-jawabansubs/store', [GuruSubSoalController::class, 'storejawabansubsoal'])->name('guru-jawabansubs.storejawabansubsoal');
        Route::post('guru-jawabansubs/update/{id}', [GuruSubSoalController::class, 'updatejawabansubsoal'])->name('guru-jawabansubs.updatejawabansubsoal');
        Route::post('guru-jawabansubs/destroy/{id}', [GuruSubSoalController::class, 'destroyjawabansubsoal'])->name('guru-jawabansubs.destroyjawabansubsoal');

        // Penerapan
        Route::get('/penerapan-soal', [GuruPenerapanController::class, 'index'])->name('penerapan-soal.index');
    });

    // Siswa
    Route::group(['middleware' => [CekLevel::class . ':Siswa']], function () {
        Route::get('/siswa-instrument', [SiswaInstrumentController::class, 'index'])->name('siswa-instrument.index');
        Route::get('/siswa-instrument/create', [SiswaInstrumentController::class, 'create'])->name('siswa-instrument.create');
        Route::post('/siswa-instrument/store', [SiswaInstrumentController::class, 'store'])->name('siswa-instrument.store');

        // Nilai
        Route::get('/siswa-nilai', [SiswaNilaiController::class, 'index'])->name('siswa-nilai.index');
        Route::get('/siswa-nilai/generatepdf', [SiswaNilaiController::class, 'generatePDF'])->name('siswa-nilai.generatepdf');
    });
});
