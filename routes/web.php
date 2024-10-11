<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function(){
    Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [PostController::class, 'index'])->name('dashboard.view');
    Route::get('/post/{id}', [PostController::class, 'show'])->name('post.view');
    Route::post('/post', [PostController::class, 'store'])->name('post.store');
    Route::get('/user/{id}', [UserController::class, 'viewUserProfile'])->name('user.view');
    Route::get('/profile', [UserController::class, 'viewProfile'])->name('profile.view');
    Route::get('/profile/edit', [UserController::class, 'editProfile'])->name('profile.edit');
    Route::patch('/profile/edit', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    // Route::resource('posts', PostController::class);
});
