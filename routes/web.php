<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserTestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleAuthController;

Route::get('/auth/google', [GoogleAuthController::class, 'redirectToGoogle'])
    ->name('google.redirect');

Route::get('/auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback'])
    ->name('google.callback');


Route::middleware('auth')->group(function () {
    Route::get('/', [UserTestController::class, 'index']);
    Route::get('/usr/create', [UserTestController::class, 'create']);
    Route::get('/usr/{id}', [UserTestController::class, 'show']);

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::post('/token/{id}/revoke', [DashboardController::class, 'revokeToken']);

    Route::get('/tokens/create', [DashboardController::class, 'createToken'])
        ->name('tokens.create');

    Route::post('/tokens', [DashboardController::class, 'storeToken'])
        ->name('tokens.store');

    Route::get('/users/create', [DashboardController::class, 'createUser'])
    ->name('users.create');

    Route::post('/users', [DashboardController::class, 'storeUser'])
        ->name('users.store');

    Route::get('/users/{id}', [DashboardController::class, 'showUser'])
    ->name('users.show');
});


Route::get('/login', function () {
    return view('login');
})->name('login');


