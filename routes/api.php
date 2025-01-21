<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::prefix('v1')->middleware("jwt.auth")->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


});
Route::apiResource('/menu', MenuController::class)->names([
    'index' => 'menu.index',
    'store' => 'menu.store',
    'show' => 'menu.show',
    'update' => 'menu.update',
    'destroy' => 'menu.destroy',
]);

Route::post('/register', [AuthController::class, 'register'])->name("register");
Route::apiResource('/login',App\Http\Controllers\LoginController::class)->names([
    'store' => 'loginApi.store',
]);
Route::post('/update-password', [AuthController::class, 'updatePassword'])->name("update-password");
Route::post('/me', [AuthController::class, 'me']);
Route::post('/codeVerificationEmail', [AuthController::class, 'codeVerificationEmail'])->name("code-verification-email");
Route::post('/verified-email', [AuthController::class, 'verifiedEmail'])->name("verified-email");
Route::post('/forgetten-password', [AuthController::class, 'forgettenPassword'])->name("forgetten-password");
Route::get('/logout', [AuthController::class, 'logout'])->name("login.logout");

