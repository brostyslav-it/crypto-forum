<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

Route::view('/', 'posts', ['categories' => Category::all()])->name('posts.view');
Route::view('/register', 'register')->name('register.view');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::view('/login', 'login')->name('login.view');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout.post');
Route::view('/profile', 'profile')->name('profile.view');
Route::view('/edit-profile', 'edit-profile')->name('profile.edit.view');
Route::view('/post', 'post', ['categories' => Category::all()])->name('post.view');
Route::post('/post', [PostController::class, 'store'])->name('post.post');
Route::get('/post/{post}', [PostController::class, 'show'])->name('post.show');
Route::post('/comment', [CommentController::class, 'store'])->name('comment.post');
