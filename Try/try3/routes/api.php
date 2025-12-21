<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentsController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [UserController::class, 'logout']);

Route::get('/courses', [CourseController::class, 'index']);
Route::get('/course/{id}', [CourseController::class, 'show']);

Route::middleware('auth:sanctum')->group(function() {
    Route::post('/courses', [CourseController::class, 'store']);
    Route::put('/courses/{id}', [CourseController::class, 'update']);
    Route::delete('/courses/{id}', [CourseController::class, 'delete']);

    Route::post('/enrol', [EnrollmentsController::class, 'store']);
});