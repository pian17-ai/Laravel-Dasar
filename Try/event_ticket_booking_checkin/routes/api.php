<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\CheckinController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// auth
Route::prefix('/v1/auth')->group(function () {
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);
    Route::middleware('auth:sanctum')->post('/logout', [UserController::class, 'logout']);
});

// event
Route::get('/events', [EventController::class, 'index']);
Route::get('/event/{event}', [EventController::class, 'show']);
Route::middleware('auth:sanctum', 'admin')->group(function () {
    Route::post('/event', [EventController::class, 'store']);
    Route::put('/event/{event}', [EventController::class, 'update']);
    Route::delete('/event/{event}', [EventController::class, 'destroy']);
});

// ticket
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/event/{event}/ticket', [TicketController::class, 'index']);
    Route::get('/ticket/{ticket}', [TicketController::class, 'show']);
    Route::middleware('admin')->group(function () {
        Route::post('/event/{event}/ticket', [TicketController::class, 'store']);
        Route::put('/ticket/{ticket}', [TicketController::class, 'update']);
        Route::delete('/ticket/{ticket}', [TicketController::class, 'destroy']);
    });
});

// booking
Route::middleware('auth:sanctum')->group(function() {
    Route::get('/bookings', [BookingController::class, 'index']);
    Route::get('/booking/{booking}', [BookingController::class, 'show']);
    Route::post('/ticket/{ticket}/booking', [BookingController::class, 'store']);
    Route::delete('/booking/{booking}', [BookingController::class, 'destroy']);
    Route::middleware('admin')->group(function() {
        Route::get('/ticket/{ticket}/bookings', [BookingController::class, 'indexAdmin']);
    });
});

//checkin
Route::middleware('auth:sanctum')->post('/booking/{booking}/checkin', [CheckinController::class, 'store']);