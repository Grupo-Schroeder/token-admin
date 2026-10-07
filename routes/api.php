<?php



use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserTestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/login', [AuthController::class, 'login']);
Route::post('/usr', [UserTestController::class, 'store']) -> middleware('auth:api');
Route::get('/test-protected', function () {
    return response()->json([
        'message' => 'Acceso autorizado',
    ]);
})->middleware('auth:api');
