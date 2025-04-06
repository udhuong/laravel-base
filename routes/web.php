<?php

use App\Http\Controllers\SocialAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('auth')->group(function () {
    Route::get('{provider}/redirect', [SocialAuthController::class, 'redirect']);
    Route::get('{provider}/callback', [SocialAuthController::class, 'callback']);
});
