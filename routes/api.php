<?php

use App\Http\Controllers\BrokerController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ReactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function () {

    Route::prefix('/properties')->group(function () {
        Route::post('/', [PropertyController::class, 'create']);
        Route::get('/{perPage}/{page}', [PropertyController::class, 'getAll']);
        Route::post('/comments', [CommentController::class, 'create']);
        Route::post('/like-reaction', [ReactionController::class, 'likeProperty']);
        Route::get('/{id}/users/{userId}', [PropertyController::class, 'viewOneById']);
    });

    Route::prefix('/brokers')->group(function () {
        Route::post('/', [BrokerController::class, 'create']);
        Route::get('/{brokerId}/property/{propertyId}', [BrokerController::class, 'getPropertyDetailById']); // broker panel
        Route::get('/{brokerId}/properties/{perPage}/{page}', [BrokerController::class, 'getAllPropertiesDetailsByBrokerId']); // broker panel
        Route::post('/property/status-change', [PropertyController::class, 'changeStatus']);
    });

    Route::prefix('/users')->group(function () {
        Route::post('/', [UserController::class, 'create']);
        Route::get('/{userId}', [UserController::class, 'getOneById']);
    });

});
