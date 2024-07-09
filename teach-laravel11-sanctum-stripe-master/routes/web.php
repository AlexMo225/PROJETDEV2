<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\{ ProductController, StripeController };
use App\Models\Plan;

Route::get('/', function () {
    return view('index');
});

// Stripe
Route::get("/products", [ProductController::class, "index"]);
Route::post("/products", [StripeController::class, "checkout"]);

Route::get("/stripe/success", [StripeController::class, "success"])->name("stripe.success");
Route::get("/stripe/cancel", [StripeController::class, "cancel"])->name("stripe.cancel");
