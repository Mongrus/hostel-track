<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\UserController;

Route::middleware('guest')->group(function () {
    Route::get('/register', [UserController::class, 'create'])->name('register.form');
    Route::post('/register', [UserController::class, 'store'])->name('register');
});
