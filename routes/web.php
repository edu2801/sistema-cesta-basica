<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CostumersController;
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
        // ainda é necessário fazer esse método
        Route::get('/delete/{id}', [UsersController::class, 'delete']);
    });

    Route::prefix('/costumers')->group(function () {
        Route::get('/', [CostumersController::class, 'index']);
        Route::get('/view/{id}', [CostumersController::class, 'view']);
        Route::get('/new-record/{id}', [CostumersController::class, 'newRecord']);
        Route::get('/print/{id}', [CostumersController::class, 'print']);
        Route::post('/insert-record/{id}', [CostumersController::class, 'insertRecord']);
        Route::get('/create', [CostumersController::class, 'create']);
        Route::get('/edit/{id}', [CostumersController::class, 'edit']);
        Route::post('/insert', [CostumersController::class, 'insert']);
        Route::post('/check-cpf/{id?}', [CostumersController::class, 'checkCpf']);
        Route::delete('/{id}', [CostumersController::class, 'delete']);
        Route::put('/{id}', [CostumersController::class, 'update']);
    });

    Route::prefix('dashboard')->group(function () {
        Route::get('/charts', [DashboardController::class, 'charts']);
    });

    Route::get('/logout', [LoginController::class, 'logout']);
});
