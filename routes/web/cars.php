<?php

use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;

Route::prefix('car')->middleware(['auth'])->group(function () {
    Route::get('/', [CarController::class, 'index'])->name('cars.index');
    Route::get('/used', [CarController::class, 'index'])->name('cars.used');
    Route::get('/brand_new', [CarController::class, 'index'])->name('cars.brand_new');
    Route::get('/show/{car}', [CarController::class, 'show'])->name('cars.show');
    Route::get('/post', [CarController::class, 'create'])->name('cars.create');
    Route::post('/store', [CarController::class, 'store'])->name('cars.store');
    Route::get('/user', [CarController::class, 'userCars'])->name('cars.user');
});
