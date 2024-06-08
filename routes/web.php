<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Admin;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AdminController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::post('/ajax', [AjaxController::class, 'Init']);

Route::group(['prefix'=>'/','namespace'=>'main','as'=>'main.'], function(){
    Route::get('/', function () {
        return view('main.Home');
    });
    Route::get('/login', function () {
        return view('main.Auth.Login');
    })->name('Login');
});
Route::group(['prefix'=>'panel','middleware'=>['Admin']],function(){
    Route::get('/', [AdminController::class, 'DashBoard']);
});
