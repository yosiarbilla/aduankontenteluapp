<?php

use App\Http\Controllers\AduanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InstansiController;
use Illuminate\Support\Facades\Route;

// Redirect root to login if not authenticated
Route::get('/', function () {
    return auth()->check() ? redirect('/dashboard') : view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile routes (from Breeze)
    Route::get('/profileshow', [ProfileController::class, 'show'])->name('profile.show');
    //Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    //Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    //Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Aduan routes
    Route::prefix('aduan')->group(function () {
        Route::get('/', [AduanController::class, 'index'])->name('aduan.index');
        Route::get('/create', [AduanController::class, 'create'])->name('aduan.create');
        Route::post('/store', [AduanController::class, 'store'])->name('aduan.store');
        Route::get('/{aduan}', [AduanController::class, 'show'])->name('aduan.show');
        Route::get('/{aduan}/edit', [AduanController::class, 'edit'])->name('aduan.edit');
        Route::put('/{aduan}', [AduanController::class, 'update'])->name('aduan.update');
        Route::delete('/{aduan}', [AduanController::class, 'destroy'])->name('aduan.destroy');
        Route::get('/export-pdf/{id}', [AduanController::class, 'exportPdf'])->name('aduan.export-pdf');
        Route::put('/{aduan}/kirim', [AduanController::class, 'kirim'])->name('aduan.kirim'); // Route untuk kirim
        Route::put('/{aduan}/approve', [AduanController::class, 'approve'])->name('aduan.approve'); // Route baru untuk approval
    });        
    // Instansi dan Tentang kami routes
    Route::get('/instansi', [InstansiController::class, 'instansi'])->name('instansi');
    Route::get('/tentang-kami', [InstansiController::class, 'tentangkami'])->name('tentangkami');
});

require __DIR__.'/auth.php';