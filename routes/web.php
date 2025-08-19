<?php

use App\Http\Controllers\Web\RoomController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\BedController;
use App\Http\Controllers\Web\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'show'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [UserController::class, 'create'])->name('register.form');
    Route::post('/register', [UserController::class, 'store'])->name('register');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn () => view('dashboard.index'))->name('dashboard');

    // Роутинг для комнат
    Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
    Route::get('/rooms/{id}', [RoomController::class, 'show'])
    ->whereNumber('id')
    ->name('rooms.show');
    Route::get('/rooms/create', [RoomController::class, 'create'])->name('rooms.create');
    Route::post('/rooms', [RoomController::class, 'store'])->name('rooms.store');
    Route::put('/rooms/{id}', [RoomController::class, 'update'])->name('rooms.update');
    Route::get('/rooms/{id}/edit', [RoomController::class, 'edit'])->name('rooms.edit');
    Route::delete('/rooms/{id}', [RoomController::class, 'destroy'])->name('rooms.destroy');
    // Роутинг для коек
    Route::get('/rooms/{room}/beds', [BedController::class, 'index'])->name('beds.index');
    Route::get('/rooms/{room}/beds/create', [BedController::class, 'create'])->name('beds.create');
    Route::get('/rooms/{room}/beds/{bed}', [BedController::class, 'show'])->name('beds.show');
    Route::post('/rooms/{room}/beds', [BedController::class, 'store'])->name('beds.store');
    Route::get('/rooms/{room}/beds/{bed}/edit', [BedController::class, 'edit'])->name('beds.edit');
    Route::put('/rooms/{room}/beds/{bed}', [BedController::class, 'update'])->name('beds.update');
    Route::delete('/rooms/{room}/beds/{bed}', [BedController::class, 'destroy'])->name('beds.destroy');

});
