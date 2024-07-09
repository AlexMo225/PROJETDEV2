<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{AuthTokenController, ContactController, DashboardController, StripeController, UserController, SubscriptionController, PasswordResetController, NewsController,ListAbonnementController};

// Prefix: /api/
Route::post('/stripe/webhook', [StripeController::class, 'webhook']);

// Auth
Route::post('/register', [AuthTokenController::class, 'register']);
Route::post('/login', [AuthTokenController::class, 'login']);
Route::post('/logout', [AuthTokenController::class, 'logout'])->middleware('auth:sanctum');

// User
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth:sanctum');
Route::get('/user', [UserController::class, 'index'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::delete('/user', [UserController::class, 'delete']);
    Route::put('/user/{id}', [UserController::class, 'update']);
});

// Contact
Route::post('/contact', [ContactController::class, 'send']);

// Stripe Checkout
Route::post('/stripe/checkout', [StripeController::class, 'checkout'])->middleware('auth:sanctum');
Route::get('/stripe/customer', [StripeController::class, 'customer'])->middleware('auth:sanctum');

// Subscription
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/subscribe', [SubscriptionController::class, 'subscribe']);
    Route::post('/cancel-subscription', [SubscriptionController::class, 'cancelSubscription']);
    Route::get('/subscription', [SubscriptionController::class, 'getSubscription']);
    Route::post('/password-reset', [PasswordResetController::class, 'sendPasswordResetLink']);
});

// News
Route::get('/news', [NewsController::class, 'index']);
Route::get('/news/{id}', [NewsController::class, 'show']);

// abonnement list
Route::get('abonnements', [ListAbonnementController::class, 'index']);