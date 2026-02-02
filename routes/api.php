<?php

use App\Http\Controllers\Api\V1\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);

    Route::middleware('auth:sanctum')->get('/me', [AuthController::class, 'me']);
});

Route::middleware('auth:sanctum')->get('/v1/me', function (Request $request) {
    return \App\Http\Responses\ApiResponder::success(
        $request->user()
    );
});
