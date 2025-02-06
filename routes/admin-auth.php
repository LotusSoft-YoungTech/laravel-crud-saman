<?php

use App\Http\Controllers\Admin\Auth\LoginadminController;
use App\Http\Controllers\Admin\Auth\RegisteredadminController;
use App\Http\Controllers\Admin\AdminPostController; // New controller for post management
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('guest:admin')->group(function () {
    Route::get('register', [RegisteredadminController::class, 'create'])->name('admin.register');
    Route::post('register', [RegisteredadminController::class, 'store']);
    Route::get('login', [LoginadminController::class, 'create'])->name('admin.login');
    Route::post('login', [LoginadminController::class, 'store']);
});

Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::post('logout', [LoginadminController::class, 'destroy'])->name('admin.logout');

    // Admin Dashboard Route (Only one definition)
    Route::get('/dashboard', [LoginadminController::class, 'dashboard'])->name('admin.dashboard');

    // Post Management Routes (Handled by a separate AdminPostController)
    Route::post('/posts/{id}/restrict', [AdminPostController::class, 'restrict'])->name('admin.posts.restrict');
    Route::delete('/posts/{id}', [AdminPostController::class, 'destroy'])->name('admin.posts.destroy');
});
