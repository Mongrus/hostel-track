<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\UserController;

Route::post('/register', [UserController::class, 'register'])->name('user.register');
