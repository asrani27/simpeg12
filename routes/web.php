<?php

use App\Http\Controllers\AdminLayananController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DmsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/', [LoginController::class, 'login'])->name('login.process');
Route::get('logout', [LogoutController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    // Superadmin dashboard
    Route::get('/superadmin/dashboard', [DashboardController::class, 'superadmin'])
        ->middleware('role:superadmin')
        ->name('dashboard.superadmin');

    // Admin Layanan CRUD (only for superadmin)
    Route::middleware('role:superadmin')
        ->prefix('/superadmin/user')
        ->group(function () {
            Route::get('/', [AdminLayananController::class, 'index'])->name('superadmin.admin_layanan.index');
            Route::get('/create', [AdminLayananController::class, 'create'])->name('superadmin.admin_layanan.create');
            Route::post('/', [AdminLayananController::class, 'store'])->name('superadmin.admin_layanan.store');
            Route::get('/{id}', [AdminLayananController::class, 'show'])->name('superadmin.admin_layanan.show');
            Route::get('/{id}/edit', [AdminLayananController::class, 'edit'])->name('superadmin.admin_layanan.edit');
            Route::put('/{id}', [AdminLayananController::class, 'update'])->name('superadmin.admin_layanan.update');
            Route::delete('/{id}', [AdminLayananController::class, 'destroy'])->name('superadmin.admin_layanan.destroy');
        });

    // DMS dashboard
    Route::get('/dms/dashboard', [DashboardController::class, 'dms'])
        ->middleware('role:dms')
        ->name('dashboard.dms');
    
    // Admin DMS download
    Route::get('/dms/download/{nip}/{type}', [DmsController::class, 'adminDownload'])
        ->middleware('role:dms')
        ->name('dms.admin.download');
    
    // Admin DMS zip download
    Route::get('/dms/zip/{nip}', [DmsController::class, 'zipDownload'])
        ->middleware('role:dms')
        ->name('dms.admin.zip');

    // Pegawai dashboard
    Route::get('/pegawai/dashboard', [DashboardController::class, 'pegawai'])
        ->middleware('role:pegawai')
        ->name('dashboard.pegawai');
    
    // Pegawai DMS
    Route::prefix('pegawai/dms')
        ->middleware('role:pegawai')
        ->name('pegawai.dms.')
        ->group(function () {
            Route::get('/', [DmsController::class, 'index'])->name('index');
            Route::post('/', [DmsController::class, 'store'])->name('store');
            Route::get('/download/{id}', [DmsController::class, 'download'])->name('download');
            Route::delete('/{id}', [DmsController::class, 'destroy'])->name('destroy');
        });

    // Profile routes
    Route::prefix('profile')
        ->name('profile.')
        ->group(function () {
            Route::get('/', [ProfileController::class, 'index'])->name('index');
            Route::post('/password', [ProfileController::class, 'updatePassword'])->name('updatePassword');
            Route::post('/photo', [ProfileController::class, 'updatePhoto'])->name('updatePhoto');
        });

    // Default dashboard route (for backward compatibility)
    Route::get('/dashboard', function () {
        $user = auth()->user();

        if ($user->hasRole('superadmin')) {
            return redirect()->route('dashboard.superadmin');
        } elseif ($user->hasRole('dms')) {
            return redirect()->route('dashboard.dms');
        } elseif ($user->hasRole('pegawai')) {
            return redirect()->route('dashboard.pegawai');
        }

        abort(403, 'Unauthorized');
    })->name('dashboard');
});
