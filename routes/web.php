<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KatalogController;

Route::get('/', function () {
    return view('landing.index');
});

Route::get('/katalog', [KatalogController::class, 'index']);
Route::get('/katalog/{id}', [KatalogController::class, 'show'])->name('katalog.show');