<?php



use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserTestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/login', [AuthController::class, 'login']);
Route::get('/test-protected', function () {
    return response()->json([
        'message' => 'Acceso autorizado',
    ]);
})->middleware('auth:api');
