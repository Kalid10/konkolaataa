<?php

use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('/')->group(function () {
    Route::get('subscribe', [SubscriptionController::class, 'showSubscriptionForm'])->name('subscribe.form');
    Route::post('subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe');
    Route::get('chapa/return/{transactionId}/{subscriptionPlan}', [SubscriptionController::class, 'return'])->name('chapa.return');
});
