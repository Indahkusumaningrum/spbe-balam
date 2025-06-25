<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DownloadController;

Route::get('/login', [AuthController::class, 'showLoginForm'])
    ->middleware('guest')
    ->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/download', function () { return view('admin/download'); })->name('admin.download');
Route::get('/admin/download/create', [DownloadController::class, 'create'])->name('download.create');

Route::get('/dashboardadmin', function () {
    return view('admin.dashboard_admin');
})->middleware('auth');


//USER
Route::get('/', function () {
    return view('dashboard_user');
});
