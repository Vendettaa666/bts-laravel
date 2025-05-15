<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\TahunController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\FotoController;

// Dashboard Route
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Tahun Routes
Route::resource('tahuns', TahunController::class);

// Buku Routes
Route::resource('bukus', BukuController::class);

// Foto Routes
Route::resource('fotos', FotoController::class);

Route::resource('kategoris', KategoriController::class);
