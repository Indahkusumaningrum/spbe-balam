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
use App\Http\Controllers\EmailController;
use App\Http\Controllers\AdminContactController;
use Mews\Captcha\Facades\Captcha;

// Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])
    ->middleware('guest')
    ->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Dashboard
Route::get('/admin/tahapan_spbe', [AdminContactController::class, 'tahapan'])->name('admin.tahapan_spbe');

Route::get('/dashboardadmin', [AdminContactController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard.admin');

Route::get('/dashboardadmin', function () {
    return view('admin.dashboard_admin');
})->middleware('auth')->name('dashboardadmin');

// Download Routes
Route::get('/admin/download/', [DownloadController::class, 'index'])->name('admin.download');
Route::get('/admin/download/create', [DownloadController::class, 'create'])->name('download.create');
Route::get('/admin/download/edit/{id}', [DownloadController::class, 'edit'])->name('download.edit');
Route::put('/admin/download/update/{id}', [DownloadController::class, 'update'])->name('download.update');
Route::post('/admin/download/store', [DownloadController::class, 'store'])->name('admin.download.store');
Route::get('/admin/download/file/{fileName}', [DownloadController::class, 'downloadFile'])->name('admin.download.file');
Route::delete('/admin/download/{id}', [DownloadController::class, 'destroy'])->name('admin.download.destroy');

// User Download
Route::get('/download', [UserDownloadController::class, 'index'])->name('download');

// Profile Routes
Route::get('/admin/profile/create', [ProfileController::class, 'create'])->name('profile.create');
Route::get('/admin/profile/edit', [ProfileController::class, 'editProfile'])->name('profile.edit');

// Berita Routes
Route::get('/berita/index', [UserBeritaController::class, 'index'])->name('berita.index');

// Dashboard Routes
Route::get('/', [UserDashboardController::class, 'index'])->name('dashboard_user');
Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard_user');
Route::get('/das', [UserDashboardController::class, 'index'])->name('dashboard.user');
Route::get('/berita/{id_berita}', [UserBeritaController::class, 'show'])->name('berita.show');

Route::get('/tahapan_spbe', function () {
    return view('tahapan_spbe');
})->name('tahapan_spbe');

// Admin Routes with Auth
Route::middleware(['auth'])->group(function () {
    // Profile Routes
    Route::get('/admin/profile', [\App\Http\Controllers\AdminProfileController::class, 'show'])->name('profile');
    Route::get('/admin/profile/edit', [\App\Http\Controllers\AdminProfileController::class, 'edit'])->name('edit.profile');
    Route::post('/admin/profile', [\App\Http\Controllers\AdminProfileController::class, 'update'])->name('admin.profile.update');

    // TinyMCE Upload
    Route::post('/upload-image-tinymce', [\App\Http\Controllers\AdminBeritaController::class, 'uploadImageTinyMCE'])->name('tinymce.upload.image');
});

// User Profile
Route::get('/userprofile', [UserProfileController::class, 'show'])->name('profile.show');

// Berita Admin Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/berita', [AdminBeritaController::class, 'index'])->name('admin.berita');
    Route::get('/admin/berita/create', [AdminBeritaController::class, 'create'])->name('admin.berita.create');
    Route::post('/admin/berita', [AdminBeritaController::class, 'store'])->name('admin.berita.store');
    Route::get('/admin/berita/{id}/edit', [AdminBeritaController::class, 'edit'])->name('admin.berita.edit');
    Route::put('/admin/berita/{id}', [AdminBeritaController::class, 'update'])->name('admin.berita.update');
    Route::delete('/admin/berita/{id}', [AdminBeritaController::class, 'destroy'])->name('admin.berita.destroy');
    Route::get('/admin/berita/{id}/detail', [AdminBeritaController::class, 'show'])->name('admin.berita.show');
    Route::get('/admin/berita/load-more', [AdminBeritaController::class, 'loadMoreBerita'])->name('admin.berita.load-more');
});

Route::post('/upload-image-tinymce', [AdminBeritaController::class, 'uploadImageTinyMCE'])->name('tinymce.upload.image');

// CONTACT ROUTES - PERBAIKI DUPLIKASI!
// Captcha reload route
Route::get('/reload-captcha', function () {
    return response()->json(['captcha' => captcha_img('flat')]);
});

// Contact form submission - HANYA SATU ROUTE INI!
Route::post('/contact', [EmailController::class, 'store'])
    ->middleware('rate.contact')
    ->name('contact.store');

// User contact page
Route::get('/kontak', function () {
    return view('kontak_show_user');
})->name('kontak.user');

// Admin Contact Routes
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/contact', [AdminContactController::class, 'indexContact'])->name('admin.contact.index');
    Route::get('/contact/{id}', [AdminContactController::class, 'show'])->name('admin.contact.show');
    Route::delete('/contact/{id}', [AdminContactController::class, 'destroy'])->name('admin.contact.destroy');
    Route::get('/contact/count', [AdminContactController::class, 'getCount'])->name('admin.contact.count');
    Route::get('/contact/{id}/read', [AdminContactController::class, 'markAsReadFromEmail'])->name('admin.contact.read');
    Route::post('/contact/{id}/mark-read', [AdminContactController::class, 'markAsRead'])->name('admin.contact.mark-read');
    Route::patch('/contact/{id}/status', [AdminContactController::class, 'updateStatus'])->name('admin.contact.update-status');
    Route::get('/contact/api/count', [AdminContactController::class, 'count'])->name('admin.contact.count');
});

// Galeri Routes
Route::get('/galeri', [GalleryController::class, 'index'])->name('galeri.index');

Route::prefix('admin')->group(function () {
    Route::get('/galeri', [GalleryController::class, 'adminIndex'])->name('admin.galeri');
    Route::get('/galeri/create', [GalleryController::class, 'create'])->name('admin.galeri.create');
    Route::post('/galeri', [GalleryController::class, 'store'])->name('admin.galeri.store');
    Route::get('/galeri/edit/{id}', [GalleryController::class, 'edit'])->name('admin.galeri.edit');
    Route::put('/galeri/{id}', [GalleryController::class, 'update'])->name('admin.galeri.update');
    Route::delete('/galeri/{id}', [GalleryController::class, 'destroy'])->name('admin.galeri.destroy');
});

// Regulasi Routes
Route::get('/admin/regulasi', [RegulasiController::class, 'index'])->name('admin.regulasi');
Route::get('/admin/regulasi/create', [RegulasiController::class, 'create'])->name('admin.regulasi.create');
Route::post('/admin/regulasi', [RegulasiController::class, 'store'])->name('admin.regulasi.store');
Route::get('/admin/regulasi/{id}/edit', [RegulasiController::class, 'edit'])->name('admin.regulasi.edit');
Route::put('/admin/regulasi/{id}', [RegulasiController::class, 'update'])->name('admin.regulasi.update');
Route::delete('/admin/regulasi/{id}', [RegulasiController::class, 'destroy'])->name('admin.regulasi.destroy');
Route::get('/admin/regulasi/download/{fileName}', [RegulasiController::class, 'downloadFile'])->name('admin.regulasi.file');

Route::get('/regulasi/index', [RegulasiController::class, 'indexUser'])->name('regulasi_index');

// Additional Berita Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('berita', [AdminBeritaController::class, 'index'])->name('berita');
    Route::get('berita/create', [AdminBeritaController::class, 'create'])->name('berita.create');
    Route::post('berita', [AdminBeritaController::class, 'store'])->name('berita.store');
    Route::get('berita/{id}/edit', [AdminBeritaController::class, 'edit'])->name('berita.edit');
    Route::put('berita/{id}', [AdminBeritaController::class, 'update'])->name('berita.update');
    Route::delete('berita/{id}', [AdminBeritaController::class, 'destroy'])->name('berita.destroy');
});

// Evaluasi Routes
Route::get('/admin/evaluasi', [EvaluasiController::class, 'adminIndex'])->name('admin.evaluasi');
Route::get('/admin/evaluasi/create', [EvaluasiController::class, 'create'])->name('admin.evaluasi.create');
Route::post('/admin/evaluasi', [EvaluasiController::class, 'store'])->name('admin.evaluasi.store');
Route::get('/admin/evaluasi/{id}', [EvaluasiController::class, 'show'])->name('admin.evaluasi.show');
Route::get('/admin/evaluasi/{id}/edit', [EvaluasiController::class, 'edit'])->name('admin.evaluasi.edit');
Route::put('/admin/evaluasi/{id}', [EvaluasiController::class, 'update'])->name('admin.evaluasi.update');
Route::delete('/admin/evaluasi/{id}', [EvaluasiController::class, 'destroy'])->name('admin.evaluasi.destroy');
Route::get('/admin/evaluasi/file/{documentName}', [EvaluasiController::class, 'downloadFile'])->name('admin.evaluasi.file');

// Indikator Routes
Route::get('/indikator', [IndikatorController::class, 'userIndex'])->name('indikator.show');
Route::get('/indikator/tahun/{tahun}', [IndikatorController::class, 'userIndikatorByTahun'])->name('indikator.tahun');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/indikator', [IndikatorController::class, 'index'])->name('indikator.index');
    Route::get('/indikator/tahun/{tahun}', [IndikatorController::class, 'indikatorByTahun'])->name('indikator.tahun');
    Route::get('/indikator/create/{tahun_id}', [IndikatorController::class, 'create'])->name('indikator.create');
    Route::post('/indikator/store/{tahun}', [IndikatorController::class, 'store'])->name('indikator.store');
    Route::get('/indikator/{id}/edit', [IndikatorController::class, 'edit'])->name('indikator.edit');
    Route::put('/indikator/{id}', [IndikatorController::class, 'update'])->name('indikator.update');
    Route::delete('/indikator/{id}', [IndikatorController::class, 'destroy'])->name('indikator.destroy');
});

Route::get('/admin/indikator/tahun/{tahun}', [IndikatorController::class, 'indikatorByTahun'])->name('admin.indikator.tahun');

// Domain Routes
Route::prefix('admin')->group(function () {
    Route::get('/domain', [DomainController::class, 'index'])->name('admin.domain_index');
    Route::get('/domain/create', [DomainController::class, 'create'])->name('admin.domain.create');
    Route::post('/domain', [DomainController::class, 'store'])->name('admin.domain.store');
    Route::get('/domain/{domain}/edit', [DomainController::class, 'edit'])->name('admin.domain.edit');
    Route::put('/domain/{domain}', [DomainController::class, 'update'])->name('admin.domain.update');
    Route::delete('/domain/{domain}', [DomainController::class, 'destroy'])->name('admin.domain.destroy');
});

// Aspek Routes
Route::get('/admin/aspek', [AspectController::class, 'index'])->name('admin.aspect.index');
Route::post('/admin/aspek', [AspectController::class, 'store'])->name('admin.aspect.store');