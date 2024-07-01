<?php

use App\Http\Controllers\PricingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('/pricing')->group(function () {
    Route::get('', [PricingController::class, 'index'])->name('pricing');
});

$directory = new RecursiveDirectoryIterator(__DIR__.'/web');
$iterator = new RecursiveIteratorIterator($directory);

foreach ($iterator as $file) {
    if ($file->getExtension() === 'php') {
        include $file->getPathname();
    }
}

require __DIR__.'/auth.php';
