<?php



use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserTestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::post('/login', [::class, 'login']);
Route::get('/test-protected', function () {
    return response()->json([
        'message' => 'Acceso autorizado',
    ]);
})->middleware('auth:api');

Route::post('/login', [ApiController::class, 'login']);
