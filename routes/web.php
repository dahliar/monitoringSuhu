<?php

use App\Http\Controllers\DeviceController;
use App\Http\Controllers\ApiTokenController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\TemperatureReadingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::resource('rooms', RoomController::class)->except(['destroy']);
    Route::patch('rooms/{room}/activate', [RoomController::class, 'activate'])->name('rooms.activate');
    Route::patch('rooms/{room}/deactivate', [RoomController::class, 'deactivate'])->name('rooms.deactivate');

    Route::resource('devices', DeviceController::class)->except(['destroy']);
    Route::patch('devices/{device}/activate', [DeviceController::class, 'activate'])->name('devices.activate');
    Route::patch('devices/{device}/deactivate', [DeviceController::class, 'deactivate'])->name('devices.deactivate');

    Route::resource('temperature-readings', TemperatureReadingController::class)->only(['index', 'show']);

    Route::resource('users', UserController::class)->except(['destroy'])->middleware('admin');
    Route::patch('users/{user}/activate', [UserController::class, 'activate'])->name('users.activate')->middleware('admin');
    Route::patch('users/{user}/deactivate', [UserController::class, 'deactivate'])->name('users.deactivate')->middleware('admin');

    Route::resource('api-tokens', ApiTokenController::class)->only(['index', 'create', 'store', 'show', 'destroy'])->middleware('admin');
});
