<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [UserController::class, 'logout']);

Route::get('/courses', [CourseController::class, 'index']);
Route::get('/course/{id}', [CourseController::class, 'show']);

Route::middleware('auth:sanctum')->group(function() {
    Route::post('/course/store', [CourseController::class, 'store']);
    Route::post('/course/update/{id}', [CourseController::class, 'update']);
    Route::post('/course/delete/{id}', [CourseController::class, 'delete']);
});