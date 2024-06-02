<?php

use App\Http\Controllers\Admin\BusinessController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Business\ServiceCotroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::apiResource('/user', UserController::class);
Route::apiResource('/business', BusinessController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/service', ServiceCotroller::class);
    Route::apiResource('/booking', BookingController::class);
    Route::post('/service/update/{id}', [ServiceCotroller::class, 'update']);
    Route::post('/booking/update/{id}', [BookingController::class, 'update']);
});

Route::post('/business/update/{id}', [BusinessController::class, 'update']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
