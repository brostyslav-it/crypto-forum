<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'Main Page...';
});

Route::view('/register', 'register')->name('register_view');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::view('/login', 'login')->name('login_view');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::view('/profile', 'profile')->name('profile_view');
