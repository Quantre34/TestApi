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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('/auth', [AuthController::class, 'Auth']);
Route::post('/subscribe', [SubscriptionController::class, 'Subscribe']);
Route::post('/chat', [ChatController::class, 'chat']);
// Route::group(['prefix'=>'/','namespace'=>'main','as'=>'main.'], function(){
//     Route::get('/auth', [AuthController::class, 'Auth']);
//     Route::post('/subscribe', [PurchaseController::class, 'SubscriptionController']);
//     Route::post('/chat',[ChatController::class, 'Chat']);
// });

