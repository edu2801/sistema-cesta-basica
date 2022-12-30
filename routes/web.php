<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::prefix('login')->group(function () {
    Route::get('/', function () {
        return view('login');
    })->name('login');
    Route::post('/', [LoginController::class, 'login']);

});

// Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('pages.users.index');
    });
// });