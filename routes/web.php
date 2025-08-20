<?php

use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\BedController;
use App\Http\Controllers\Web\ResidentController;
use App\Http\Controllers\Web\RoomController;
use App\Http\Controllers\Web\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'show'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [UserController::class, 'create'])->name('register.form');
    Route::post('/register', [UserController::class, 'store'])->name('register');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', fn () => view('dashboard.index'))->name('dashboard');

    /** ---------------- Rooms ---------------- */
    Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');

    Route::get('/rooms/create', [RoomController::class, 'create'])->name('rooms.create');

    Route::post('/rooms', [RoomController::class, 'store'])->name('rooms.store');

    Route::get('/rooms/{room}', [RoomController::class, 'show'])
        ->whereNumber('room')->name('rooms.show');

    Route::get('/rooms/{room}/edit', [RoomController::class, 'edit'])
        ->whereNumber('room')->name('rooms.edit');

    Route::put('/rooms/{room}', [RoomController::class, 'update'])
        ->whereNumber('room')->name('rooms.update');

    Route::delete('/rooms/{room}', [RoomController::class, 'destroy'])
        ->whereNumber('room')->name('rooms.destroy');

    /** ---------------- Beds ---------------- */
    Route::scopeBindings()->group(function () {

        Route::get('/rooms/{room}/beds', [BedController::class, 'index'])
            ->whereNumber('room')->name('beds.index');

        Route::get('/rooms/{room}/beds/create', [BedController::class, 'create'])
            ->whereNumber('room')->name('beds.create');

        Route::post('/rooms/{room}/beds', [BedController::class, 'store'])
            ->whereNumber('room')->name('beds.store');

        Route::get('/rooms/{room}/beds/{bed}/edit', [BedController::class, 'edit'])
            ->whereNumber('room')->whereNumber('bed')->name('beds.edit');

        Route::put('/rooms/{room}/beds/{bed}', [BedController::class, 'update'])
            ->whereNumber('room')->whereNumber('bed')->name('beds.update');

        Route::get('/rooms/{room}/beds/{bed}', [BedController::class, 'show'])
            ->whereNumber('room')->whereNumber('bed')->name('beds.show');

        Route::delete('/rooms/{room}/beds/{bed}', [BedController::class, 'destroy'])
            ->whereNumber('room')->whereNumber('bed')->name('beds.destroy');
    });

    /** ---------------- Resident ---------------- */
    Route::get('/residents', [ResidentController::class, 'index'])->name('residents.index');

    Route::get('/residents/create', [ResidentController::class, 'create'])->name('residents.create');
    Route::post('/residents', [ResidentController::class, 'store'])->name('residents.store');

    Route::get('/residents/{resident}', [ResidentController::class, 'show'])
    ->whereNumber('resident')->name('residents.show');

    Route::get('/residents/{resident}/edit', [ResidentController::class, 'edit'])
    ->whereNumber('resident')->name('residents.edit');
    Route::put('/residents/{resident}', [ResidentController::class, 'update'])
    ->whereNumber('resident')->name('residents.update');

    Route::delete('/residents/{resident}', [ResidentController::class, 'destroy'])
    ->whereNumber('resident')->name('residents.destroy');
});
