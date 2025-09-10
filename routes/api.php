<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::apiResource('users', UserController::class);



Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {

    Route::get('/user', [AuthController::class, 'user']);
    Route::middleware('auth:api')->post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/me', [AuthController::class, 'me']);
});