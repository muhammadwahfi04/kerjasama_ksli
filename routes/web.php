<?php

use App\Http\Controllers\KsInstansiController;
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

Route::get('/instansi_index', [KsInstansiController::class, 'index'])
->name('instansi_index.index');

Route::get('/ks_instansi/create', [KsInstansiController::class, 'create'])
->name('create_ks_instansi.create');

Route::post('/ks_instansi', [KsInstansiController::class, 'store'])
->name('ks_instansi.store');

// Route::get('/ks_instansi/{ks_instansi}', [KsInstansiController::class, 'detail'])
// ->name('instansi_index.detail');

// Route::get('/data_instansi', function(){
//     return view('data_instansi');   
// });

// Route::get('/buka', function(){
//     return view('layouts/beranda');
// });