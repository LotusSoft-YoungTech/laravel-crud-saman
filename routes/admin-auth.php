<?php

use App\Http\Controllers\Admin\Auth\LoginadminController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

    Route::prefix('admin')->middleware('guest:admin')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('admin.register');
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::get('login', [LoginadminController::class, 'create'])
        ->name('admin.login');

    Route::post('login', [LoginadminController::class, 'store']);

});

Route::prefix('admin')->middleware('auth:admin')->group(function () {
  
    Route::post('logout', [LoginadminController::class, 'destroy'])
        ->name('admin.logout');

        //admin dashboar
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
        
});
