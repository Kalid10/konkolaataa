<?php

use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;

Route::prefix('car')->group(function () {
    Route::get('/', [CarController::class, 'index'])->name('cars.index');
    Route::get('/show', [CarController::class, 'show'])->name('cars.show');
    Route::get('/post', [CarController::class, 'create'])->name('cars.create');
    Route::post('/store', [CarController::class, 'store'])->name('cars.store');
});
