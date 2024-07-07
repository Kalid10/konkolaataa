<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\PricingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', [CarController::class, 'index'])->name('cars.index');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('/pricing')->group(function () {
    Route::get('', [PricingController::class, 'index'])->name('pricing');
});

Route::get('/auth/google', function () {
    return Inertia::location(Socialite::driver('google')->redirect());
});
Route::get('auth/google/callback', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'handleGoogleCallback']);

$directory = new RecursiveDirectoryIterator(__DIR__.'/web');
$iterator = new RecursiveIteratorIterator($directory);

foreach ($iterator as $file) {
    if ($file->getExtension() === 'php') {
        include $file->getPathname();
    }
}

require __DIR__.'/auth.php';
