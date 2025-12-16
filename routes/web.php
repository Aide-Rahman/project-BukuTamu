<?php

use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\TamuController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('pegawai', PegawaiController::class)->except(['show']);
Route::resource('tamu', TamuController::class)->except(['show']);

Route::post('tamu/{tamu}/kunjungan', [TamuController::class, 'storeKunjungan'])
    ->name('tamu.kunjungan.store');
