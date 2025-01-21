<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\AttachTokenFromCookie;
use App\Http\Middleware\RedirectIfNotAuthenticated;
use Illuminate\Support\Facades\Route;

Route::resource('/', App\Http\Controllers\LoginController::class)->names([
    'show' => 'login.show',
]);

Auth::routes();
Route::middleware([AttachTokenFromCookie::class, RedirectIfNotAuthenticated::class])->group(function () {
    Route::resource('/dashboard', DashboardController::class)->names([
        'index' => 'dashboard.index',
        'store' => 'dashboard.store',
        'show' => 'dashboard.show',
        'update' => 'dashboard.update',
        'destroy' => 'dashboard.destroy',
    ]);
});
Route::get('/reset-password/{id}', [AuthController::class, 'resetPassword'])->name('reset-password');
Route::resource('/login', App\Http\Controllers\LoginController::class);
Route::get('/login', [App\Http\Controllers\LoginController::class, 'index'])->name('login');
