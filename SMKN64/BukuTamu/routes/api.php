<?php

use App\Http\Controllers\GuestBookController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('/auth')->group(function() {
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);
    Route::middleware('auth:sanctum')->post('/logout', [UserController::class, 'logout']);
});

Route::middleware('auth:sanctum')->group(function() {
    Route::get('guestbook', [GuestBookController::class, 'index']);
    Route::get('guestbook/{id}', [GuestBookController::class, 'show']);
    Route::post('guestbook', [GuestBookController::class, 'store']);
    Route::delete('guestbook/{id}', [GuestBookController::class, 'destroy']);
});