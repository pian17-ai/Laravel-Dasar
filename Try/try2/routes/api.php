<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);

// Route::middleware('auth:sanctum', function() {
//     Route::post('/auth/logout', [AuthController::class, 'logout']);
// });

Route::middleware('auth:sanctum')->group(function() {
    Route::post('/auth/logout', [AuthController::class, 'logout']);
});