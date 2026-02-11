<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\JobsController;
use App\Http\Controllers\Api\V1\ParamController;
use App\Http\Controllers\Api\V1\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/userApproved', [AuthController::class, 'approvedUser']);
    Route::post('/param/auth', [ParamController::class, 'AuthParam']);

    Route::middleware('auth:sanctum')->get('/me', [AuthController::class, 'me']);
});

Route::prefix('v1')->middleware('auth:sanctum')->group(function (){
    Route::post('/param/jobs', [ParamController::class, 'JobsParam']);

    Route::post('/jobs/add', [JobsController::class, 'add']);
    Route::post('/jobs/get', [JobsController::class, 'get']);

    Route::post('/profile/getUserInfo',[ProfileController::class,'getUserInfo']);
    Route::post('/profile/profileUpdate',[ProfileController::class,'profileUpdate']);
    Route::post('/profile/passwordUpdate',[ProfileController::class,'passwordUpdate']);

});


Route::middleware('auth:sanctum')->get('/v1/me', function (Request $request) {
   return \App\Http\Responses\ApiResponder::success(
        $request->user()
    ); 
});
