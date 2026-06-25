<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminKomikController;
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
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
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
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/komik/create', [AdminKomikController::class, 'create'])->name('admin.komik.create');
    Route::post('/admin/komik', [AdminKomikController::class, 'store'])->name('admin.komik.store');
    Route::get('/admin/komik/{komik}/chapters', [AdminKomikController::class, 'edit'])->name('admin.komik.edit');
    Route::put('/admin/komik/{komik}', [AdminKomikController::class, 'update'])->name('admin.komik.update');
    Route::post('/admin/komik/{komik}/chapters', [AdminKomikController::class, 'storeChapter'])->name('admin.komik.chapter.store');
    Route::get('/admin/chapter/{chapter}', [AdminKomikController::class, 'showChapter'])->name('admin.komik.chapter.show');
    Route::get('/admin/chapter/{chapter}/edit', [AdminKomikController::class, 'editChapter'])->name('admin.komik.chapter.edit');
    Route::put('/admin/chapter/{chapter}', [AdminKomikController::class, 'updateChapter'])->name('admin.komik.chapter.update');
});

Route::get('/komik/{komik}', [KomikController::class, 'show'])->name('komik.show');
Route::get('/chapter/{chapter}', [KomikController::class, 'showChapter'])->name('komik.chapter.show');

Route::resource('pengguna', PenggunaController::class);