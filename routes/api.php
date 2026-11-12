<?php

use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\TicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Authentication
Route::post('/login', [LoginController::class, 'auth']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout']);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Tickets
    Route::get('/tickets', [TicketController::class, 'index']);

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index']);
});