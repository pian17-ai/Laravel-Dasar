<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// auth
Route::prefix('/v1/auth')->group(function() {
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);
    Route::middleware('auth:sanctum')->post('/logout', [UserController::class, 'logout']);
});

// event
Route::get('/events', [EventController::class, 'index']);
Route::get('/event/{event}', [EventController::class, 'show']);
Route::middleware('auth:sanctum', 'admin')->group(function() {
    Route::post('/event', [EventController::class, 'store']);
    Route::put('/event/{event}', [EventController::class, 'update']);
    Route::delete('/event/{event}', [EventController::class, 'destroy']);
});

// ticket
Route::middleware('auth:sanctum', 'admin')->group(function() {
    Route::post('/ticket/{event}', [TicketController::class, 'store']);
    Route::put('/ticket/{ticket}', [TicketController::class, 'update']);
    Route::delete('/ticket/{ticket}', [TicketController::class, 'destroy']);
});