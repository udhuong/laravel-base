<?php

use Udhuong\Uploader\Presentation\Http\Controllers\UploadController;

Route::prefix('api')->group(function () {
    Route::prefix('upload')->group(function () {
        Route::post('/', [UploadController::class, 'upload']);
    });
});
