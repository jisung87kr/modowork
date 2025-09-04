<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Authentication routes
Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('profile', [AuthController::class, 'profile']);
        Route::put('profile', [AuthController::class, 'updateProfile']);
        Route::post('change-password', [AuthController::class, 'changePassword']);
    });
});

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // Job seeker routes
    Route::middleware('role:job_seeker')->prefix('job-seeker')->group(function () {
        // Job seeker specific routes will go here
    });
    
    // Employer routes  
    Route::middleware('role:employer')->prefix('employer')->group(function () {
        // Employer specific routes will go here
    });
    
    // Admin routes
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        // Admin specific routes will go here
    });
});