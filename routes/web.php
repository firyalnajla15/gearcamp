<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;

// HALAMAN PUBLIK
Route::get('/', function () {
    return view('landing.index');
})->name('home');

// Katalog bisa diakses tanpa login
Route::get('/katalog', [KatalogController::class, 'index'])
    ->name('katalog.index');

Route::get('/katalog/{id}', [KatalogController::class, 'show'])
    ->name('katalog.show');

// KERANJANG (GUEST BISA AKSES)
Route::get('/cart', [CartController::class, 'index'])
    ->name('cart.index');

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

// CHECKOUT
Route::get('/checkout', function () {
    return view('checkout.index');
})
    ->middleware('auth')
    ->name('checkout');

// LOGIN DAN REGISTER
Route::middleware('guest')->group(function () {

    // LOGIN ADMIN
    Route::get('/login/admin', [AuthController::class, 'showAdminLogin'])
        ->name('login.admin');

    Route::post('/login/admin', [AuthController::class, 'loginAdmin'])
        ->name('login.admin.process');

    // LOGIN USER
    Route::get('/login/user', [AuthController::class, 'showUserLogin'])
        ->name('login.user');

    Route::post('/login/user', [AuthController::class, 'loginUser'])
        ->name('login.user.process');

    // REGISTER USER
    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.process');
});

// LOGOUT
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// KHUSUS ADMIN
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');
    });

// KHUSUS USER
Route::middleware(['auth', 'role:user'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {
        Route::get('/dashboard', [UserDashboardController::class, 'index'])
            ->name('dashboard');
    });
