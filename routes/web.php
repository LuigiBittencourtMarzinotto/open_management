<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\AttachTokenFromCookie;
use App\Http\Middleware\RedirectIfNotAuthenticated;
use Illuminate\Support\Facades\Route;


Auth::routes();
Route::middleware([AttachTokenFromCookie::class, RedirectIfNotAuthenticated::class])->group(function () {
    Route::resource('/dashboard', DashboardController::class)->names([
        'index' => 'dashboard.index',
        'store' => 'dashboard.store',
        'show' => 'dashboard.show',
        'update' => 'dashboard.update',
        'destroy' => 'dashboard.destroy',
    ]);
    Route::get('/user/{id}', [UserController::class, 'showUser'])->name('show-user');
    Route::get('/user', [UserController::class, 'view'])->name('user.view');

});
Route::get('/reset-password/{id}', [AuthController::class, 'resetPassword'])->name('reset-password');
Route::resource('/login', App\Http\Controllers\LoginController::class);
Route::get('/login', [App\Http\Controllers\LoginController::class, 'index'])->name('login');
Route::get('/', [App\Http\Controllers\LoginController::class, 'index']);
