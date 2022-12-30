<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\DashboardController;

Route::prefix('login')->group(function () {
    Route::get('/', function () {
        return view('login');
    })->name('login');
    Route::post('/', [LoginController::class, 'login']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('/users')->group(function () {
        Route::get('/', [UsersController::class, 'index']);
        Route::get('/create', [UsersController::class, 'create']);
        Route::post('/insert', [UsersController::class, 'insert']);
        Route::get('/edit/{id}', [UsersController::class, 'edit']);
        Route::post('/update/{id}', [UsersController::class, 'update']);
        Route::get('/delete/{id}', [UsersController::class, 'delete']);
    });
});
