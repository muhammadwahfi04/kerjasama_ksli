<?php

use App\Http\Controllers\KsInstansiController;
use App\Http\Controllers\KsPerguruanTinggiController;
use App\Http\Controllers\KsPerusahaanSwastaController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

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

if (file_exists(app_path('Http/Controllers/Controller.php'))) {
    Route::get('lang/{bahasa}', [Controller::class, 'lang'])
    ->name('kerjasamaunib.lang');
}

Route::get('kerjasama-unib/laporan', [Controller::class, 'laporan'])
    ->name('kerjasamaunib.laporan');

Route::get('kerjasama-unib/kategori', [Controller::class, 'kategori'])
    ->name('kerjasamaunib.kategori');

Route::get('/kerjasama-unib/kategori/detail/{ksNegara}', [Controller::class, 'detailKategori'])
    ->name('kerjasamaunib.detailKategori');

Route::get('/kerjasama-unib/login', [KsInstansiController::class, 'login'])->middleware('guest')
    ->name('login');

Route::post('/kerjasama-unib/postLogin', [KsInstansiController::class, 'postLogin'])
    ->name('postLogin');

Route::get('/kerjasama-unib/logout', [KsInstansiController::class, 'logout'])
    ->name('logout');

Route::get('/', [Controller::class, 'beranda']);

Route::get('kerjasama-unib/beranda', [Controller::class, 'beranda'])
    ->name('kerjasamaunib.beranda'); 

Route::get('kerjasama-unib/notifikasi', [Controller::class, 'notifikasi'])
    ->name('notifikasi.unib');

Route::get('/kerjasama-unib/instansi-pemerintahan', [KsInstansiController::class, 'index'])
    ->name('pemerintahan.index');

Route::get('/kerjasama-unib/perguruan-tinggi', [KsPerguruanTinggiController::class, 'index'])
    ->name('perguruan.index');

Route::post('/kerjasama-unib/cetak-pdf', [Controller::class, 'cetakpdf'])
    ->name('perguruan.cetakpdf');

Route::get('/kerjasama-unib/perusahaan-swasta', [KsPerusahaanSwastaController::class, 'index'])
    ->name('perusahaan.index');



Route::group(['middleware' => ['auth', 'ceklevel:admin,unit']], function () {        //ini adalah midleware

    //Instansi Pemerintahan
    Route::get('/kerjasama-unib/tambah-data-pemerintahan', [KsInstansiController::class, 'create'])
        ->name('pemerintahan.create');

    Route::post('/kerjasama-unib/pemerintahan-store', [KsInstansiController::class, 'store'])
        ->name('pemerintahan.store');

    Route::get('kerjasama-unib/pemerintahan/{ksId}/update', [KsInstansiController::class, 'update'])
        ->name('pemerintahan.update');

    Route::post('kerjasama-unib/pemerintahan/{ksId}/update_proses', [KsInstansiController::class, 'update_proses'])
        ->name('pemerintahan.update_proses');

    Route::get('/kerjasama-unib/instansi-pemerintahan/hapus/{ksId}', [KsInstansiController::class, 'hapus'])
        ->name('pemerintahan.hapus');

    //perguruan Tinggi
    Route::get('/kerjasama-unib/tambah-data-perguruan-tinggi', [KsPerguruanTinggiController::class, 'create'])
        ->name('perguruan.create');

    Route::post('/kerjasama-unib/perguruan-tinggi-store', [KsPerguruanTinggiController::class, 'store'])
        ->name('perguruan.store');

    Route::get('/kerjasama-unib/perguruan-tinggi/hapus/{ksId}', [KsPerguruanTinggiController::class, 'hapus'])
        ->name('perguruan.hapus');

    Route::get('kerjasama-unib/perguruan-tinggi/{ksId}/update', [KsPerguruanTinggiController::class, 'update'])
        ->name('perguruan.update');

    Route::post('kerjasama-unib/perguruan-tinggi/{ksId}/update_proses', [KsPerguruanTinggiController::class, 'update_proses'])
        ->name('perguruan.update_proses');

    //Perusahaan Swasta

    Route::get('/kerjasama-unib/tambah-data-perusahaan-swasta', [KsPerusahaanSwastaController::class, 'create'])
        ->name('perusahaan.create');

    Route::post('/kerjasama-unib/perusahaan-swasta-store', [KsPerusahaanSwastaController::class, 'store'])
        ->name('perusahaan.store');

    Route::get('/kerjasama-unib/perusahaan-swasta/hapus/{ksId}', [KsPerusahaanSwastaController::class, 'hapus'])
        ->name('perusahaan.hapus');

    Route::get('kerjasama-unib/perusahaan-swasta/{ksId}/update', [KsPerusahaanSwastaController::class, 'update'])
        ->name('perusahaan.update');

    Route::post('kerjasama-unib/perusahaan-swasta/{ksId}/update_proses', [KsPerusahaanSwastaController::class, 'update_proses'])
        ->name('perusahaan.update_proses');

    // Route::get('/kerjasama-unib/activity-log/hapus/{id}', [Controller::class, 'hapus'])
    //     ->name('activity_log.hapus');
});