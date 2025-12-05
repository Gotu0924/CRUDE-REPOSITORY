<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\PublishController;

// Public Routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/publishon', [PublishController::class, 'publishon']);
Route::post('/logout', [AuthController::class, 'logout']);

// Private Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::resource('/tasks', TaskController::class);

});