<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/refresh', [AuthController::class, 'refreshToken']);
});
Route::middleware('auth:api')->group(function () {
    Route::get('/user', [AuthController::class, 'getUserDetail']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
