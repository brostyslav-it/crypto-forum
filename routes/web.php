<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'Main Page...';
});

Route::view('/register', 'register')->name('register.view');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::view('/login', 'login')->name('login.view');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout.post');
Route::view('/profile', 'profile')->name('profile.view');
Route::view('/edit-profile', 'edit-profile')->name('profile.edit.view');
