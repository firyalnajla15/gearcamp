<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\CartController;

Route::get('/', function () {
    return view('landing.index');
});

Route::get('/katalog', [KatalogController::class, 'index']);
Route::get('/katalog/{id}', [KatalogController::class, 'show'])->name('katalog.show');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])
    ->name('cart.add');
Route::post('/cart/increase/{id}', [CartController::class, 'increase'])
    ->name('cart.increase');
Route::post('/cart/decrease/{id}', [CartController::class, 'decrease'])
    ->name('cart.decrease');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])
    ->name('cart.remove');
Route::delete('/cart/clear', [CartController::class, 'clear'])
    ->name('cart.clear');