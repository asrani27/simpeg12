<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DmsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\KepangkatanController;
use App\Http\Controllers\AdminLayananController;

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/', [LoginController::class, 'login'])->name('login.process');
Route::get('logout', [LogoutController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth', 'role:kepangkatan']], function () {
    Route::prefix('kepangkatan')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'kepangkatan'])->name('dashboard.kepangkatan');
        Route::get('baru', [KepangkatanController::class, 'baru']);
        Route::get('diproses', [KepangkatanController::class, 'diproses']);
        Route::get('selesai', [KepangkatanController::class, 'selesai']);

        Route::get('dokumen/{id}/berkas-ok/{dokumen_id}', [KepangkatanController::class, 'verif_dokumen']);
        Route::post('dokumen/{id}/perbaikidokumen', [KepangkatanController::class, 'perbaiki_dokumen']);
        Route::get('dokumen/{id}', [KepangkatanController::class, 'dokumen_pengajuan']);
        Route::get('selesaipengajuan/{id}', [KepangkatanController::class, 'selesai_pengajuan']);
        Route::get('deletepengajuan/{id}', [KepangkatanController::class, 'delete_pengajuan']);
        Route::get('prosespengajuan/{id}', [KepangkatanController::class, 'proses_pengajuan']);

        Route::get('persyaratan', [KepangkatanController::class, 'persyaratan']);
        Route::post('persyaratan/create', [KepangkatanController::class, 'persyaratan_store']);
        Route::post('persyaratan/edit', [KepangkatanController::class, 'persyaratan_update']);
        Route::get('persyaratan/delete/{id}', [KepangkatanController::class, 'persyaratan_delete']);

        Route::get('jenis_kenaikan', [KepangkatanController::class, 'jenis_kenaikan']);
        Route::post('jenis_kenaikan/create', [KepangkatanController::class, 'jenis_kenaikan_store']);
        Route::post('jenis_kenaikan/edit', [KepangkatanController::class, 'jenis_kenaikan_update']);
        Route::get('jenis_kenaikan/delete/{id}', [KepangkatanController::class, 'jenis_kenaikan_delete']);

        Route::get('pangkat', [KepangkatanController::class, 'k_index']);
        Route::post('pangkat/ditolak', [KepangkatanController::class, 'k_tolak']);
        Route::get('pangkat/{id}/dokumen', [KepangkatanController::class, 'k_dokumen']);
        Route::get('pangkat/{id}/zip', [KepangkatanController::class, 'downloadZip']);
    });
});

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

    // DMS admin routes
    Route::prefix('dms')
        ->middleware('role:dms')
        ->group(function () {
            // Dashboard
            Route::get('/dashboard', [DashboardController::class, 'dms'])->name('dashboard.dms');
            Route::get('/download/{nip}/{type}', [DmsController::class, 'adminDownload'])->name('dms.admin.download');
            Route::get('/zip/{nip}', [DmsController::class, 'zipDownload'])->name('dms.admin.zip');
        });

    // Pegawai routes
    Route::prefix('pegawai')
        ->middleware('role:pegawai')
        ->group(function () {
            // Dashboard
            Route::get('/dashboard', [DashboardController::class, 'pegawai'])->name('dashboard.pegawai');
            // DMS
            Route::get('/dms', [DmsController::class, 'index'])->name('pegawai.dms.index');
            Route::post('/dms', [DmsController::class, 'store'])->name('pegawai.dms.store');
            Route::get('/dms/download/{id}', [DmsController::class, 'download'])->name('pegawai.dms.download');
            Route::delete('/dms/{id}', [DmsController::class, 'destroy'])->name('pegawai.dms.destroy');

            Route::post('dashboard/ajukan-layanan', [PengajuanController::class, 'store']);
            Route::get('dashboard/{id}/deletedokumen/{persyaratan_id}', [PengajuanController::class, 'delete_dokumen']);
            Route::get('dashboard/{id}/dokumen/kirim', [PengajuanController::class, 'kirim_dokumen']);
            Route::get('dashboard/{id}/dokumen', [PengajuanController::class, 'dokumen']);
            Route::post('dashboard/{id}/dokumen', [PengajuanController::class, 'upload_dokumen']);
            Route::post('dashboard/{id}/perbaikan', [PengajuanController::class, 'upload_perbaikan']);
            Route::get('dashboard/{id}/layanan', [PengajuanController::class, 'layanan']);
            Route::get('dashboard/{id}/delete', [PengajuanController::class, 'delete']);
            Route::post('dashboard/{id}/layanan', [PengajuanController::class, 'store']);
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
    // Route::get('/dashboard', function () {
    //     $user = auth()->user();

    //     if ($user->hasRole('superadmin')) {
    //         return redirect()->route('dashboard.superadmin');
    //     } elseif ($user->hasRole('admin')) {
    //         return redirect()->route('dashboard.superadmin');
    //     } elseif ($user->hasRole('dms')) {
    //         return redirect()->route('dashboard.dms');
    //     } elseif ($user->hasRole('pegawai')) {
    //         return redirect()->route('dashboard.pegawai');
    //     } elseif ($user->hasRole('kepangkatan')) {
    //         return redirect()->route('dashboard.kepangkatan');
    //     } elseif ($user->hasRole('pensiun')) {
    //         return redirect()->route('dashboard.pensiun');
    //     } elseif ($user->hasRole('karpeg')) {
    //         return redirect()->route('dashboard.karpeg');
    //     } elseif ($user->hasRole('disiplin')) {
    //         return redirect()->route('dashboard.disiplin');
    //     } elseif ($user->hasRole('kepegawaian')) {
    //         return redirect()->route('dashboard.kepegawaian');
    //     } elseif ($user->hasRole('slks')) {
    //         return redirect()->route('dashboard.slks');
    //     } elseif ($user->hasRole('usul_pns')) {
    //         return redirect()->route('dashboard.usul_pns');
    //     }

    //     abort(403, 'Unauthorized');
    // })->name('dashboard');


});

Route::group(['middleware' => ['auth', 'role:superadmin|usul_pns|pegawai|kepangkatan|admin|pensiun|karpeg|disiplin|kepegawaian|slks']], function () {
    Route::get('/periode', [PeriodeController::class, 'index']);
    Route::post('/periode', [PeriodeController::class, 'store']);
    Route::post('/periode/edit', [PeriodeController::class, 'update']);
    Route::get('/periode/delete/{id}', [PeriodeController::class, 'delete']);
});
