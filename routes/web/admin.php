<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin/')->middleware(['auth'])->name('admin.')->group(function () {
    Route::get('', [AdminController::class, 'index'])->name('index');
    Route::get('users', [AdminController::class, 'users'])->name('users');
    Route::get('users/register', [AdminController::class, 'register'])->name('users.register');
});
