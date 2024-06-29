<?php

use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;

Route::prefix('cars')->group(function () {
    Route::get('/', [CarController::class, 'index'])->name('cars.index');
});
