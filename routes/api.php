<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//======================= Start Auth ===============================
    Route::controller(AuthController::class)->group(function () {
        Route::post('register','register')->middleware('throttle:3,0.5');
        Route::post('login','login')->middleware('throttle:3,0.5');
        Route::post('logout','logout')->middleware('auth:sanctum');
    });
//======================= End Auth ===============================

//======================= Start Posts ===============================
    Route::middleware('auth:sanctum')->controller(PostController::class)->group(function () {
        Route::get('posts', 'index');
        Route::get('posts/{post}', 'show');
        Route::post('posts','store')->middleware('throttle:3,0.5');
        Route::put('posts/{post}', 'update')->middleware('throttle:3,0.5');
        Route::delete('posts/{post}', 'destroy')->middleware('throttle:3,0.5');
    });
//======================= End Posts ===============================
