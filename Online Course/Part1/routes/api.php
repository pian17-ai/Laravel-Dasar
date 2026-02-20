<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/cars', [CarController::class, 'index']);
Route::get('/car/{id}', [CarController::class, 'show']);
// Route::post('/cars', [CarController::class, 'store']);
// Route::put('/car/{id}', [CarController::class, 'update']);
// Route::delete('/car/{id}', [CarController::class, 'destroy']);

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/category/{id}', [CategoryController::class, 'show']);
Route::post('/category', [CategoryController::class, 'store']);
Route::put('/category/{id}', [CategoryController::class, 'update']);
Route::delete('/category/{id}', [CategoryController::class, 'destroy']);

Route::middleware('auth:sanctum')->group(function() {
    Route::post('/cars', [CarController::class, 'store']);
    Route::put('/car/{id}', [CarController::class, 'update']);
    Route::delete('/car/{id}', [CarController::class, 'delete']);

    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::post('/login', [AuthController::class, 'login']);