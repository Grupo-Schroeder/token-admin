<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\UserController;

Route::get('/auth/google', [GoogleAuthController::class, 'redirectToGoogle'])
    ->name('google.redirect');

Route::get('/auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback'])
    ->name('google.callback');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::post('/token/{id}/revoke', [TokenController::class, 'revokeToken']);

    Route::get('/tokens/create', [TokenController::class, 'createToken'])
        ->name('tokens.create');

    Route::post('/tokens', [TokenController::class, 'storeToken'])
        ->name('tokens.store');

    Route::get('/tokens/{id}', [TokenController::class, 'show'])
        ->name('tokens.show');

    Route::get('/users/create', [UserController::class, 'createUser'])
        ->name('users.create');

    Route::post('/users', [UserController::class, 'storeUser'])
        ->name('users.store');

    Route::get('/users/{id}', [UserController::class, 'showUser'])
        ->name('users.show');

    Route::get( '/tokens/{id}/edit', [TokenController::class, 'edit'])
        ->name('tokens.edit');

    Route::put( '/tokens/{id}', [TokenController::class, 'update'])
        ->name('tokens.update');

});


Route::get('/login', function () {
    return view('login');
})->name('login');


