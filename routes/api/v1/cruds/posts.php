<?php

use App\Http\Controllers\API\v1\Crud\PostController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:sanctum', 'api'], 'prefix' => 'crud'], function () {
    Route::apiResource('posts', PostController::class);
});
