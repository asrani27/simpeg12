<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DmsController;
use App\Http\Controllers\SkpdController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PensiunController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\KepangkatanController;
use App\Http\Controllers\AdminLayananController;
use App\Http\Controllers\TwoFactorController;
use App\Http\Controllers\UsulPnsController;

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/', [LoginController::class, 'login'])->name('login.process');
Route::get('logout', [LogoutController::class, 'logout'])->name('logout');

// 2FA Routes (require authentication but not 2FA verified)
Route::middleware(['auth'])->prefix('2fa')->name('2fa.')->group(function () {
    Route::get('verify', [TwoFactorController::class, 'showVerification'])->name('verify');
    Route::post('verify', [TwoFactorController::class, 'verify']);

    Route::middleware(['2fa.verified'])->group(function () {
        Route::get('setup', [TwoFactorController::class, 'showSetup'])->name('setup');
        Route::post('enable', [TwoFactorController::class, 'enable'])->name('enable');
        Route::post('disable', [TwoFactorController::class, 'disable'])->name('disable');
    });
});

Route::group(['middleware' => ['auth', 'role:kepangkatan']], function () {
    Route::prefix('kepangkatan')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'kepangkatan'])->name('dashboard.kepangkatan');
        Route::get('baru', [KepangkatanController::class, 'baru']);
        Route::get('diproses', [KepangkatanController::class, 'diproses']);
        Route::get('selesai', [KepangkatanController::class, 'selesai']);

        Route::get('dokumen/{id}/berkas-ok/{dokumen_id}', [KepangkatanController::class, 'verif_dokumen']);
        Route::post('dokumen/{id}/perbaikidokumen', [KepangkatanController::class, 'perbaiki_dokumen']);
        Route::get('dokumen/{id}', [KepangkatanController::class, 'dokumen_pengajuan']);
        Route::get('dokumen/{id}/zip', [KepangkatanController::class, 'downloadZip']);
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

Route::group(['middleware' => ['auth', 'role:pensiun']], function () {
    Route::prefix('pensiun')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'pensiun'])->name('dashboard.pensiun');
        Route::get('baru', [PensiunController::class, 'baru']);
        Route::get('diproses', [PensiunController::class, 'diproses']);
        Route::get('selesai', [PensiunController::class, 'selesai']);

        Route::get('dokumen/{id}/berkas-ok/{dokumen_id}', [PensiunController::class, 'verif_dokumen']);
        Route::post('dokumen/{id}/perbaikidokumen', [PensiunController::class, 'perbaiki_dokumen']);
        Route::get('dokumen/{id}', [PensiunController::class, 'dokumen_pengajuan']);
        Route::get('dokumen/{id}/zip', [PensiunController::class, 'downloadZip']);
        Route::get('selesaipengajuan/{id}', [PensiunController::class, 'selesai_pengajuan']);
        Route::get('deletepengajuan/{id}', [PensiunController::class, 'delete_pengajuan']);
        Route::get('prosespengajuan/{id}', [PensiunController::class, 'proses_pengajuan']);

        Route::get('persyaratan', [PensiunController::class, 'persyaratan']);
        Route::post('persyaratan/create', [PensiunController::class, 'persyaratan_store']);
        Route::post('persyaratan/edit', [PensiunController::class, 'persyaratan_update']);
        Route::get('persyaratan/delete/{id}', [PensiunController::class, 'persyaratan_delete']);

        Route::get('jenis_pensiun', [PensiunController::class, 'jenis_pensiun']);
        Route::post('jenis_pensiun/create', [PensiunController::class, 'jenis_pensiun_store']);
        Route::post('jenis_pensiun/edit', [PensiunController::class, 'jenis_pensiun_update']);
        Route::get('jenis_pensiun/delete/{id}', [PensiunController::class, 'jenis_pensiun_delete']);

        Route::get('pangkat', [PensiunController::class, 'k_index']);
        Route::post('pangkat/ditolak', [PensiunController::class, 'k_tolak']);
        Route::get('pangkat/{id}/dokumen', [PensiunController::class, 'k_dokumen']);
        Route::get('pangkat/{id}/zip', [PensiunController::class, 'downloadZip']);
    });
});

Route::group(['middleware' => ['auth', 'role:usul_pns']], function () {
    Route::prefix('usul_pns')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'usul_pns'])->name('dashboard.usul_pns');
        Route::get('baru', [UsulPnsController::class, 'baru']);
        Route::get('diproses', [UsulPnsController::class, 'diproses']);
        Route::get('selesai', [UsulPnsController::class, 'selesai']);

        Route::get('dokumen/{id}/berkas-ok/{dokumen_id}', [UsulPnsController::class, 'verif_dokumen']);
        Route::post('dokumen/{id}/perbaikidokumen', [UsulPnsController::class, 'perbaiki_dokumen']);
        Route::get('dokumen/{id}', [UsulPnsController::class, 'dokumen_pengajuan']);
        Route::get('dokumen/{id}/zip', [UsulPnsController::class, 'downloadZip']);
        Route::get('selesaipengajuan/{id}', [UsulPnsController::class, 'selesai_pengajuan']);
        Route::get('deletepengajuan/{id}', [UsulPnsController::class, 'delete_pengajuan']);
        Route::get('prosespengajuan/{id}', [UsulPnsController::class, 'proses_pengajuan']);

        Route::get('persyaratan', [UsulPnsController::class, 'persyaratan']);
        Route::post('persyaratan/create', [UsulPnsController::class, 'persyaratan_store']);
        Route::post('persyaratan/edit', [UsulPnsController::class, 'persyaratan_update']);
        Route::get('persyaratan/delete/{id}', [UsulPnsController::class, 'persyaratan_delete']);

        Route::get('jenis_usul_pns', [UsulPnsController::class, 'jenis_usul_pns']);
        Route::post('jenis_usul_pns/create', [UsulPnsController::class, 'jenis_usul_pns_store']);
        Route::post('jenis_usul_pns/edit', [UsulPnsController::class, 'jenis_usul_pns_update']);
        Route::get('jenis_usul_pns/delete/{id}', [UsulPnsController::class, 'jenis_usul_pns_delete']);

        Route::get('pangkat', [UsulPnsController::class, 'k_index']);
        Route::post('pangkat/ditolak', [UsulPnsController::class, 'k_tolak']);
        Route::get('pangkat/{id}/dokumen', [UsulPnsController::class, 'k_dokumen']);
        Route::get('pangkat/{id}/zip', [UsulPnsController::class, 'downloadZip']);
    });
});

Route::middleware(['auth'])->group(function () {
    // SKPD dashboard
    Route::get('/skpd/dashboard', [DashboardController::class, 'skpd'])
        ->middleware('role:skpd')
        ->name('dashboard.skpd');

    // SKPD Pegawai routes
    Route::middleware('role:skpd')
        ->prefix('/skpd/pegawai')
        ->name('skpd.pegawai.')
        ->group(function () {
            Route::get('/', [PegawaiController::class, 'skpdIndex'])->name('index');
            Route::get('/{id}', [PegawaiController::class, 'skpdShow'])->name('show');
            // DMS routes for SKPD pegawai
            Route::get('/{id}/dms', [PegawaiController::class, 'skpdDmsShow'])->name('dms');
            Route::post('/{id}/dms', [PegawaiController::class, 'skpdDmsStore'])->name('dms.store');
            Route::get('/{id}/dms/download/{type}', [PegawaiController::class, 'skpdDmsDownload'])->name('dms.download');
            Route::delete('/{id}/dms/{type}', [PegawaiController::class, 'skpdDmsDestroy'])->name('dms.destroy');
        });

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

    // SKPD CRUD (only for superadmin)
    Route::middleware('role:superadmin')
        ->prefix('/superadmin/skpd')
        ->group(function () {
            Route::get('/', [SkpdController::class, 'index'])->name('superadmin.skpd.index');
            Route::get('/create', [SkpdController::class, 'create'])->name('superadmin.skpd.create');
            Route::post('/', [SkpdController::class, 'store'])->name('superadmin.skpd.store');
            Route::get('/{id}', [SkpdController::class, 'show'])->name('superadmin.skpd.show');
            Route::get('/{id}/edit', [SkpdController::class, 'edit'])->name('superadmin.skpd.edit');
            Route::put('/{id}', [SkpdController::class, 'update'])->name('superadmin.skpd.update');
            Route::delete('/{id}', [SkpdController::class, 'destroy'])->name('superadmin.skpd.destroy');
            Route::get('/{id}/create-user', [SkpdController::class, 'showCreateUser'])->name('superadmin.skpd.showCreateUser');
            Route::post('/create-user', [SkpdController::class, 'createUser'])->name('superadmin.skpd.createUser');
            Route::post('/reset-password', [SkpdController::class, 'resetPassword'])->name('superadmin.skpd.resetPassword');
        });

    // Pegawai CRUD (only for superadmin)
    Route::middleware('role:superadmin')
        ->prefix('/superadmin/pegawai')
        ->group(function () {
            Route::get('/', [PegawaiController::class, 'index'])->name('superadmin.pegawai.index');
            Route::get('/create', [PegawaiController::class, 'create'])->name('superadmin.pegawai.create');
            Route::post('/', [PegawaiController::class, 'store'])->name('superadmin.pegawai.store');
            Route::post('/import', [PegawaiController::class, 'import'])->name('superadmin.pegawai.import');
            Route::get('/{id}', [PegawaiController::class, 'show'])->name('superadmin.pegawai.show');
            Route::get('/{id}/edit', [PegawaiController::class, 'edit'])->name('superadmin.pegawai.edit');
            Route::put('/{id}', [PegawaiController::class, 'update'])->name('superadmin.pegawai.update');
            Route::delete('/{id}', [PegawaiController::class, 'destroy'])->name('superadmin.pegawai.destroy');
            Route::post('/{id}/create-user', [PegawaiController::class, 'createUser'])->name('superadmin.pegawai.createUser');
            Route::post('/{id}/reset-password', [PegawaiController::class, 'resetPassword'])->name('superadmin.pegawai.resetPassword');
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
});

Route::group(['middleware' => ['auth', 'role:superadmin|usul_pns|pegawai|kepangkatan|admin|pensiun|karpeg|disiplin|kepegawaian|slks']], function () {
    Route::get('/periode', [PeriodeController::class, 'index']);
    Route::post('/periode', [PeriodeController::class, 'store']);
    Route::post('/periode/edit', [PeriodeController::class, 'update']);
    Route::get('/periode/delete/{id}', [PeriodeController::class, 'delete']);
});
