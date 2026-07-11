<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\NotificationTemplateController;
use App\Http\Controllers\Api\NotificationUserPreferenceController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function() {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', [AuthController::class, 'me']);
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('template')->controller(NotificationTemplateController::class)->group(function() {
        Route::get('/', 'index');
        Route::get('/{template:id}', 'show');
        Route::post('/save', 'store');
        Route::patch('/update/{template:id}', 'update');
        Route::delete('/delete/{template:id}', 'delete');
    });

    Route::prefix('notification')->controller(NotificationController::class)->group(function() {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/statistics', 'statistics');

        Route::prefix('/{notification:uuid}')->group(function() {
            Route::get('/', 'show');
            Route::get('/logs', 'logs');
            Route::patch('/status', 'updateStatus');
            Route::post('/retry', 'retryNotification');
        });
    });

    Route::prefix('user-preference')->controller(NotificationUserPreferenceController::class)->group(function() {
        Route::get('/{user_id}', 'index');
        Route::post('/', 'store');
        Route::patch('/{user_id}', 'update');
        Route::delete('/{user_id}', 'delete');
    });
});
