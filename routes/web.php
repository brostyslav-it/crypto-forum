<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReactionsController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::get('/register', 'registerView')->name('register.view');
    Route::get('/login', 'loginView')->name('login.view');
    Route::post('/register', 'register')->name('register.post');
    Route::post('/login', 'login')->name('login.post');
    Route::post('/logout', 'logout')->name('logout.post');
});

Route::controller(ProfileController::class)->group(function () {
    Route::get('/profile', 'showProfile')->name('profile.view');
    Route::get('/edit-profile', 'showEditProfile')->name('profile.edit.view');
    Route::put('/edit-profile', 'update')->name('profile.update');
});

Route::controller(PostController::class)->group(function () {
    Route::get('/', 'showAll')->name('posts.view');
    Route::get('/post', 'index')->name('post.view');
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

Route::controller(ReactionsController::class)->group(function () {
    Route::post('/like/post/{post}', 'storeLike')->name('like.store');
    Route::post('/dislike/post/{post}', 'storeDislike')->name('dislike.store');
});
