<?php

use App\Http\Controllers\Admin\BusinessController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::apiResource('/user', UserController::class);
Route::apiResource('/business', BusinessController::class);

Route::post('/business/update/{id}', [BusinessController::class, 'update']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
