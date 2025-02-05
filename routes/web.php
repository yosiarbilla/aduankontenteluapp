<?php

use App\Http\Controllers\AduanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

<<<<<<< HEAD
// Route::fallback(function() {
//     return view ('maintenance');
// });

=======
>>>>>>> c34b33e0997faa774a11c8df40efcfc11e0c7160
// Redirect root to login if not authenticated
Route::get('/', function () {
    return auth()->check() ? redirect('/dashboard') : view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile routes (from Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Aduan routes
    Route::prefix('aduan')->group(function () {
        Route::get('/', [AduanController::class, 'index'])->name('aduan.index');
        Route::get('/create', [AduanController::class, 'create'])->name('aduan.create');
        Route::post('/', [AduanController::class, 'store'])->name('aduan.store');
        Route::get('/{aduan}', [AduanController::class, 'show'])->name('aduan.show');
        Route::get('/{aduan}/edit', [AduanController::class, 'edit'])->name('aduan.edit');
        Route::put('/{aduan}', [AduanController::class, 'update'])->name('aduan.update');
        Route::delete('/{aduan}', [AduanController::class, 'destroy'])->name('aduan.destroy');
    });
});

<<<<<<< HEAD
require __DIR__.'/auth.php';
=======
require __DIR__.'/auth.php';
>>>>>>> c34b33e0997faa774a11c8df40efcfc11e0c7160
