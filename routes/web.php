<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\AdminBeritaController;
use App\Http\Controllers\UserBeritaController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\UserDownloadController;
use App\Http\Controllers\RegulasiController;
use App\Http\Controllers\EvaluasiController;
use App\Http\Controllers\IndikatorController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\AspectController;


Route::get('/login', [AuthController::class, 'showLoginForm'])
    ->middleware('guest')
    ->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Route::get('/download', function () { return view('admin/download'); })->name('admin.download');
// Route::get('/admin/download/create', [DownloadController::class, 'create'])->name('download.create');

Route::get('/dashboardadmin', [DashboardAdminController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard.admin');

Route::get('/dashboardadmin', function () {
    return view('admin.dashboard_admin');
})->middleware('auth')->name('dashboardadmin');

Route::get('/admin/download/', [DownloadController::class, 'index'])->name('admin.download');
Route::get('/admin/download/create', [DownloadController::class, 'create'])->name('download.create');
Route::get('/admin/download/edit/{id}', [DownloadController::class, 'edit'])->name('download.edit');
Route::put('/admin/download/update/{id}', [DownloadController::class, 'update'])->name('download.update');
Route::post('/admin/download/store', [DownloadController::class, 'store'])->name('admin.download.store');
Route::get('/admin/download/file/{fileName}', [DownloadController::class, 'downloadFile'])->name('admin.download.file');
Route::delete('/admin/download/{id}', [DownloadController::class, 'destroy'])->name('admin.download.destroy');




Route::get('/admin/profile/create', [ProfileController::class, 'create'])->name('profile.create');
Route::get('/admin/profile/edit', [ProfileController::class, 'editProfile'])->name('profile.edit');

// Route::get('/berita', function () { return view('admin/berita'); })->name('berita');

// USER
Route::get('/', function () {
    return view('dashboard_user');
})->name('dashboard_user');

Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard.user');

Route::get('/tahapan_spbe', function () {
    return view('tahapan_spbe');
})->name('tahapan_spbe');

// Admin
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/profile', [AdminProfileController::class, 'show'])->name('profile');
    Route::get('/admin/profile/edit', [AdminProfileController::class, 'edit'])->name('edit.profile');
    Route::post('/admin/profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');
});

// User
Route::get('/userprofile', [UserProfileController::class, 'show'])->name('profile.show');

//BERITA
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/berita', [AdminBeritaController::class, 'index'])->name('admin.berita');
    Route::get('/admin/berita/create', [AdminBeritaController::class, 'create'])->name('admin.berita.create');
    Route::post('/admin/berita', [AdminBeritaController::class, 'store'])->name('admin.berita.store');
    Route::get('/admin/berita/{id}/edit', [AdminBeritaController::class, 'edit'])->name('admin.berita.edit');
    Route::put('/admin/berita/{id}', [AdminBeritaController::class, 'update'])->name('admin.berita.update');
    Route::delete('/admin/berita/{id}', [AdminBeritaController::class, 'destroy'])->name('admin.berita.destroy');
    Route::get('/admin/berita/{id}/detail', [AdminBeritaController::class, 'show'])->name('admin.berita.show');

});

Route::get('/berita/index', [UserBeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{id_berita}', [UserBeritaController::class, 'show'])->name('berita.show');


//KONTAK
Route::get('/kontak', function () {
    return view('kontak_show_user');
})->name('kontak.user');



#GALERI
// User
Route::get('/galeri', [GalleryController::class, 'index'])->name('galeri.index');

// Admin
Route::prefix('admin')->group(function () {
    Route::get('/galeri', [GalleryController::class, 'adminIndex'])->name('admin.galeri');
    Route::get('/galeri/create', [GalleryController::class, 'create'])->name('admin.galeri.create');
    Route::post('/galeri', [GalleryController::class, 'store'])->name('admin.galeri.store');
    Route::get('/galeri/edit/{id}', [GalleryController::class, 'edit'])->name('admin.galeri.edit');
    Route::put('/galeri/{id}', [GalleryController::class, 'update'])->name('admin.galeri.update');
    Route::delete('/galeri/{id}', [GalleryController::class, 'destroy'])->name('admin.galeri.destroy');
});


// Admin
Route::get('/admin/regulasi', [RegulasiController::class, 'index'])->name('admin.regulasi');
Route::get('/admin/regulasi/create', [RegulasiController::class, 'create'])->name('admin.regulasi.create');
Route::post('/admin/regulasi', [RegulasiController::class, 'store'])->name('admin.regulasi.store');
Route::get('/admin/regulasi/{id}/edit', [RegulasiController::class, 'edit'])->name('admin.regulasi.edit');
Route::put('/admin/regulasi/{id}', [RegulasiController::class, 'update'])->name('admin.regulasi.update');
Route::delete('/admin/regulasi/{id}', [RegulasiController::class, 'destroy'])->name('admin.regulasi.destroy');
Route::get('/admin/regulasi/download/{fileName}', [RegulasiController::class, 'downloadFile'])->name('admin.regulasi.file');
// User
Route::get('/regulasi/index', [RegulasiController::class, 'indexUser'])->name('regulasi_index');


// Admin
Route::get('/admin/evaluasi', [EvaluasiController::class, 'adminIndex'])->name('admin.evaluasi');
Route::get('/admin/evaluasi/create', [EvaluasiController::class, 'create'])->name('admin.evaluasi.create');
Route::post('/admin/evaluasi', [EvaluasiController::class, 'store'])->name('admin.evaluasi.store');
Route::get('/admin/evaluasi/{id}', [EvaluasiController::class, 'show'])->name('admin.evaluasi.show');
Route::get('/admin/evaluasi/{id}/edit', [EvaluasiController::class, 'edit'])->name('admin.evaluasi.edit');
Route::put('/admin/evaluasi/{id}', [EvaluasiController::class, 'update'])->name('admin.evaluasi.update');
Route::delete('/admin/evaluasi/{id}', [EvaluasiController::class, 'destroy'])->name('admin.evaluasi.destroy');
Route::get('/admin/evaluasi/file/{documentName}', [EvaluasiController::class, 'downloadFile'])->name('admin.evaluasi.file');

// User
Route::get('/evaluasi/index', [EvaluasiController::class, 'index'])->name('evaluasi.list');
Route::get('/', [EvaluasiController::class, 'index'])->name('dashboard_user');


// Untuk publik
Route::get('/indikator', [IndikatorController::class, 'publicIndex'])->name('indikator.index');

// Untuk admin
Route::prefix('admin')->group(function () {
    Route::get('indikator', [IndikatorController::class, 'index'])->name('admin.indikator.index');
    Route::get('indikator/create', [IndikatorController::class, 'create'])->name('admin.indikator.create');
    Route::post('indikator', [IndikatorController::class, 'store'])->name('admin.indikator.store');
    Route::get('indikator/{id}/edit', [IndikatorController::class, 'edit'])->name('admin.indikator.edit');
    Route::put('indikator/{id}', [IndikatorController::class, 'update'])->name('admin.indikator.update');
    Route::delete('indikator/{id}', [IndikatorController::class, 'destroy'])->name('admin.indikator.destroy');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('indikator', IndikatorController::class);
});

Route::prefix('admin')->group(function () {
    Route::get('/domain', [DomainController::class, 'index'])->name('admin.domain_index');
    Route::get('/domain/create', [DomainController::class, 'create'])->name('admin.domain.create');
    Route::post('/domain', [DomainController::class, 'store'])->name('admin.domain.store');
    Route::get('/domain/{domain}/edit', [DomainController::class, 'edit'])->name('admin.domain.edit');
    Route::put('/domain/{domain}', [DomainController::class, 'update'])->name('admin.domain.update');
    Route::delete('/domain/{domain}', [DomainController::class, 'destroy'])->name('admin.domain.destroy');
});

// Aspek
Route::get('/admin/aspek', [AspectController::class, 'index'])->name('admin.aspect.index');
Route::post('/admin/aspek', [AspectController::class, 'store'])->name('admin.aspect.store');

// Route::get('/admin/domain', [DomainController::class, 'index'])->name('admin.domain.index');
// Route::get('/admin/aspek', [AspectController::class, 'index'])->name('admin.aspect.index');

