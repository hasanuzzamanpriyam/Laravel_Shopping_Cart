<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', [ProductController::class, 'index']);
Route::post('/cart/add', [ProductController::class, 'addToCart']);
Route::post('/cart/remove', [ProductController::class, 'removeFromCart']);
