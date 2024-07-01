<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::prefix('post')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('cars.index');
});
