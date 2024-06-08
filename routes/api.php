<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\ChatController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


    Route::post('/auth', [AuthController::class, 'Authenticate']);
    
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/subscribe', [SubscriptionController::class, 'Subscribe']);
        Route::post('/chat',[ChatController::class, 'Chat']);
    });