<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\UserProfileController;

Route::get('/login', [AuthController::class, 'showLoginForm'])
    ->middleware('guest')
    ->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboardadmin', function () {
    return view('admin.dashboard_admin');
})->middleware('auth')->name('dashboardadmin');

Route::get('/download', function () { return view('admin/download'); })->name('download');
Route::get('/admin/download/create', [DownloadController::class, 'create'])->name('download.create');
Route::get('/admin/download/edit', [DownloadController::class, 'edit'])->name('download.edit');

Route::get('/profile', function () { return view('admin/profile'); })->name('profile');
Route::get('/admin/profile/create', [ProfileController::class, 'create'])->name('profile.create');
Route::get('/admin/profile/edit', [ProfileController::class, 'editProfile'])->name('profile.edit');

Route::get('/berita', function () { return view('admin/berita'); })->name('berita');

//USER
Route::get('/', function () {
    return view('dashboard_user');
});


// Admin
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/profile', [AdminProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::post('/admin/profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');
});

// User
Route::get('/profile', [UserProfileController::class, 'show'])->name('profile.show');
