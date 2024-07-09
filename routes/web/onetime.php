<?php

use App\Http\Controllers\OnetimePlanController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('onetime-plans', [OnetimePlanController::class, 'showOnetimePlans'])->name('onetime.plans');
    Route::post('onetime-plans/subscribe', [OnetimePlanController::class, 'subscribe'])->name('onetime.subscribe');
    Route::get('chapa/onetime/return/{transactionId}/{onetimePlan}', [OnetimePlanController::class, 'return'])->name('chapa.onetime.return');
});
