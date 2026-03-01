<?php

use App\Http\Controllers\Api\V1\AIController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CommentsController;
use App\Http\Controllers\Api\V1\JobsController;
use App\Http\Controllers\Api\V1\MasterJobsController;
use App\Http\Controllers\Api\V1\MasterOfferController;
use App\Http\Controllers\Api\V1\OffersController;
use App\Http\Controllers\Api\V1\ParamController;
use App\Http\Controllers\Api\V1\ProfileController;
use App\Http\Controllers\MessageController;
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


Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    Route::post('/param/jobs', [ParamController::class, 'JobsParam']);

    Route::post('/jobPriceCheck', [AIController::class, 'jobPriceCheck']);


    Route::post('/jobs/add', [JobsController::class, 'add']);
    Route::post('/jobs/get', [JobsController::class, 'get']);
    Route::post('/jobs/jobsOk', [JobsController::class, 'jobsOk']);

    Route::post('/profile/getUserInfo', [ProfileController::class, 'getUserInfo']);
    Route::post('/profile/profileUpdate', [ProfileController::class, 'profileUpdate']);
    Route::post('/profile/passwordUpdate', [ProfileController::class, 'passwordUpdate']);
    Route::post('/profile/addressUpdate', [ProfileController::class, 'addressUpdate']);

    Route::post('/offers/get', [OffersController::class, 'get']);
    Route::post('/offers/get/item', [OffersController::class, 'getItem']);
    Route::post('/offers/status/approved', [OffersController::class, 'offerApproved']);
    Route::post('/offers/status/rejected', [OffersController::class, 'offerRejected']);

    Route::post('/comments/jobsPoint', [CommentsController::class, 'jobsPoint']);
    Route::post('/comments/getComments', [CommentsController::class, 'getComments']);


    Route::post('messages/send', [MessageController::class, 'send']);
    Route::post('messages/{userId}/{offer_id}', [MessageController::class, 'getMessages']);
});


Route::prefix('v1/master')->middleware('auth:sanctum')->group(function () {
    Route::post('/jobs/searchParam', [ParamController::class, 'getSearchJobsFilterParam']);

    Route::post('jobs/get', [MasterJobsController::class, 'get']);
    Route::post('jobs/addOffer', [MasterJobsController::class, 'addOffer']);
    Route::post('offers/get', [MasterOfferController::class, 'get']);
});



Route::middleware('auth:sanctum')->get('/v1/me', function (Request $request) {
    return \App\Http\Responses\ApiResponder::success(
        $request->user()
    );
});
