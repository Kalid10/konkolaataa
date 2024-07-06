<?php

use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'throttle:5,1'])->prefix('verify')->group(function () {
    Route::get('/phone', [VerificationController::class, 'phone'])->name('verify.phone');
    Route::post('/phone', [VerificationController::class, 'sendOTP'])->name('verify.phone.submit');
});
