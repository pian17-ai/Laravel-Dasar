<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//auth
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [UserController::class, 'logout']);

// event
Route::get('/events', [EventController::class, 'index']);
Route::get('/event/{id}', [EventController::class, 'show']);
Route::middleware('auth:sanctum')->post('/event', [EventController::class, 'store']);
Route::middleware('auth:sacntum', 'admin')->group(function() {
    // Route::put('/{id}', EventController::class, 'update');
    // Route::delete('/{id}', EventController::class, 'delete');
});