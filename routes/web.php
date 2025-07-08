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



Route::get('/login', [AuthController::class, 'showLoginForm'])
    ->middleware('guest')
    ->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/download', function () { return view('admin/download'); })->name('admin.download');
Route::get('/admin/download/create', [DownloadController::class, 'create'])->name('download.create');

Route::get('/dashboardadmin', [DashboardAdminController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard.admin');

Route::get('/dashboardadmin', function () {
    return view('admin.dashboard_admin');
})->middleware('auth')->name('dashboardadmin');

Route::get('/download', function () { return view('admin/download'); })->name('download');
Route::get('/admin/download/create', [DownloadController::class, 'create'])->name('download.create');
Route::get('/admin/download/edit', [DownloadController::class, 'edit'])->name('download.edit');

Route::get('/admin/profile/create', [ProfileController::class, 'create'])->name('profile.create');
Route::get('/admin/profile/edit', [ProfileController::class, 'editProfile'])->name('profile.edit');

// Route::get('/berita', function () { return view('admin/berita'); })->name('berita');

//USER
Route::get('/', function () {
    return view('dashboard_user');
});
Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard.user');



// Admin
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [AdminProfileController::class, 'show'])->name('profile');
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
