<?php

use App\Http\Controllers\Api\TemperatureReadingController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('temperature-readings', [TemperatureReadingController::class, 'store'])->name('api.temperature-readings.store');
});
