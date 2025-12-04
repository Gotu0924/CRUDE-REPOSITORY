<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;

// Public Routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Private Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::resource('/tasks', TaskController::class);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::delete('/tasks', [TaskController::class, 'destroy'])->middleware('auth:sanctum');
    Route::put('/tasks', [TaskController::class, 'update']); 

});