<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DislikeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register')->name('register.post');
    Route::post('/login', 'login')->name('login.post');
    Route::post('/logout', 'logout')->name('logout.post');
});

Route::controller(PostController::class)->group(function () {
    Route::post('/post', 'store')->name('post.post');
    Route::get('/post/{post}', 'show')->name('post.show');
    Route::delete('/post/{post}', 'destroy')->name('post.destroy');
    Route::get('/post/{post}/edit', 'edit')->name('post.edit');
    Route::put('/post/{post}', 'update')->name('post.update');
});

Route::controller(CommentController::class)->group(function () {
    Route::post('/comment', 'store')->name('comment.post');
    Route::delete('/comment/{comment}', 'destroy')->name('comment.destroy');
});

Route::post('/like/post/{post}', [LikeController::class, 'store'])->name('like.store');
Route::post('/dislike/post/{post}', [DislikeController::class, 'store'])->name('dislike.store');

Route::view('/', 'posts', ['categories' => Category::all()])->name('posts.view');
Route::view('/post', 'post', ['categories' => Category::all()])->name('post.view');

Route::view('/register', 'register')->name('register.view');
Route::view('/login', 'login')->name('login.view');
Route::view('/profile', 'profile')->name('profile.view');
Route::view('/edit-profile', 'edit-profile')->name('profile.edit.view');
