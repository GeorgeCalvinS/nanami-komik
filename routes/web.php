<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KomikController;
use App\Http\Controllers\AuthController; // Dari yang kita buat di Step sebelumnya
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\RiwayatBacaController;

// Route Utama (Komik)
Route::get('/', [KomikController::class, 'index'])->name('home');
Route::get('/browse', [KomikController::class, 'browse'])->name('browse');
Route::get('/library', [KomikController::class, 'library'])->name('library');

// Route Login
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);

// Rute untuk melihat dan mengedit profil pribadi (untuk Mahasiswa/User)
Route::get('/profil', [ProfilController::class, 'edit'])->name('profil.edit');
Route::put('/profil/update', [ProfilController::class, 'update'])->name('profil.update');

// Rute Bookmark
Route::get('/bookmark', [BookmarkController::class, 'index'])->name('bookmark.index');
Route::post('/bookmark', [BookmarkController::class, 'store'])->name('bookmark.store');
Route::delete('/bookmark/{id}', [BookmarkController::class, 'destroy'])->name('bookmark.destroy');

// Rute Continue Reading / Riwayat Baca
Route::get('/riwayat', [RiwayatBacaController::class, 'index'])->name('riwayat.index');
Route::post('/riwayat/simpan', [RiwayatBacaController::class, 'store'])->name('riwayat.store');
Route::delete('/riwayat/{id}', [RiwayatBacaController::class, 'destroy'])->name('riwayat.destroy');

Route::resource('pengguna', PenggunaController::class);