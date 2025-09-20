<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ArsipSuratController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.about.about',
    [
        'title' => 'About'
    ]);
});

// Arsip Surat Routes ---------------------------------------------------------------------------
Route::get('/arsip-surat', [ArsipSuratController::class, 'index'])->name('arsip.list');
Route::get('/arsip-surat/data-list', [ArsipSuratController::class, 'data'])->name('arsip.data');

Route::get('/arsip-surat/tambah-surat', [ArsipSuratController::class, 'create'])->name('arsip.create');
Route::post('/arsip-surat/simpan-surat', [ArsipSuratController::class, 'store'])->name('arsip.store');

Route::get('/arsip-surat/download/{slug}', [ArsipSuratController::class, 'download'])->name('arsip.download');

Route::get('/arsip-surat/lihat-surat/{slug}', [ArsipSuratController::class, 'view'])->name('arsip.view');
Route::get('/arsip-surat/edit-surat/{slug}', [ArsipSuratController::class, 'edit'])->name('arsip.edit');
Route::post('/arsip-surat/update-surat', [ArsipSuratController::class, 'update'])->name('arsip.update');

Route::delete('/arsip-surat/destroy/{slug}', [ArsipSuratController::class, 'destroy'])->name('arsip.delete');
Route::delete('/arsip-surat/delete-selected', [ArsipSuratController::class, 'destroySelected'])->name('arsip.destroySelected');

// Kategori Surat Routes ---------------------------------------------------------------------------
Route::get('/kategori-surat', [KategoriController::class, 'index'])->name('kategori.list');
Route::get('/kategori-surat/data-list', [KategoriController::class, 'data'])->name('kategori.data');
Route::get('/kategori-surat/tambah-kategori', [KategoriController::class, 'create'])->name('kategori.create');
Route::post('/kategori-surat/simpan-kategori', [KategoriController::class, 'store'])->name('kategori.store');
Route::get('/kategori-surat/edit-kategori/{slug}', [KategoriController::class, 'edit'])->name('kategori.create');
Route::post('/kategori-surat/update-kategori', [KategoriController::class, 'update'])->name('kategori.update');
Route::delete('/kategori-surat/destroy/{slug}', [KategoriController::class, 'destroy'])->name('kategori.delete');
Route::delete('/kategori-surat/delete-selected', [KategoriController::class, 'destroySelected'])->name('kategori.destroySelected');

// Profile Routes -----------------------------------------------------------------------------------
Route::get('/about', [AboutController::class, 'index'])->name('about.index');

require __DIR__.'/auth.php';
