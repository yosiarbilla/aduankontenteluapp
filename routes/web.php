<?php

use App\Http\Controllers\AduanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InstansiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Redirect root to login if not authenticated
Route::get('/', function () {
    // Updated: direct redirect to login
    return auth()->check() ? redirect('/dashboard') : redirect('/login');
});

// Routes yang memerlukan autentikasi
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile routes (from Breeze)
    Route::get('/profileshow', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Instansi dan Tentang kami routes - dapat diakses semua user terautentikasi
    Route::get('/instansi', [InstansiController::class, 'instansi'])->name('instansi');
    Route::get('/tentang-kami', [InstansiController::class, 'tentangkami'])->name('tentangkami');

    // Routes untuk aduan - diorganisasi ulang untuk menghindari konflik
    Route::prefix('aduan')->group(function () {
        // Index route (daftar aduan)
        Route::get('/', [AduanController::class, 'index'])->name('aduan.index');
        
        // PENTING: Tempatkan rute spesifik sebelum rute dengan parameter
        // Create dan Store route untuk semua role yang berhak membuat aduan
        Route::middleware(['role:user,admin,manager,petugas'])->group(function () {
            Route::get('/create', [AduanController::class, 'create'])->name('aduan.create');
            Route::post('/', [AduanController::class, 'store'])->name('aduan.store');
        });
        
        // Export PDF route
        Route::get('/export-pdf/{id}', [AduanController::class, 'exportPdf'])->name('aduan.export-pdf');
        
        // Routes untuk edit/update aduan
        Route::middleware(['role:user,admin,manager,petugas'])->group(function () {
            Route::get('/{aduan}/edit', [AduanController::class, 'edit'])->name('aduan.edit');
            Route::put('/{aduan}', [AduanController::class, 'update'])->name('aduan.update');
            Route::put('/{aduan}/kirim', [AduanController::class, 'kirim'])->name('aduan.kirim');
        });
        
        // Routes untuk delete (hanya admin, manager, petugas)
        Route::middleware(['role:admin,manager,petugas'])->group(function () {
            Route::delete('/{aduan}', [AduanController::class, 'destroy'])->name('aduan.destroy');
        });
        
        // Routes untuk approve/reject (hanya admin dan manager)
        Route::middleware(['role:admin,manager'])->group(function () {
            Route::put('/{aduan}/approve', [AduanController::class, 'approve'])->name('aduan.approve');
            Route::put('/{aduan}/reject', [AduanController::class, 'reject'])->name('aduan.reject');
        });
        
        // Show route (PENTING: tempatkan setelah semua rute spesifik)
        Route::get('/{aduan}', [AduanController::class, 'show'])->name('aduan.show');
    });
    
    // Routes khusus untuk admin
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('users', UserController::class);
    });

    // Error Routes
    Route::get('/403', function () {
        return view('errors.403');
    })->name('403');
    Route::get('/404', function () {
        return view('errors.404');
    });
});

require __DIR__.'/auth.php';