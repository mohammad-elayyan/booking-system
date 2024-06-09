<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BusinessController;

Route::get('/', function () {
    return view('login');
});

Route::middleware('admin')->group(function () {
    Route::resource('/user', UserController::class)->except(['show'])->name('index', 'user');
    Route::resource('/business', BusinessController::class)->except(['show'])->name('index', 'business');
});
Route::post('/admin_login', [AdminLoginController::class, 'login'])->name('admin_login');
Route::get('/showLoginForm', [AdminLoginController::class, 'showLoginForm'])->name('login_form');
Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');
