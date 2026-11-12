<?php

use App\Http\Controllers\Api\DashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Ticket;
use App\Http\Controllers\Api\TicketController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/tickets', function () {
    return Ticket::with(['category', 'creator', 'assignee'])
        ->latest()
        ->get();
});

Route::get('/tickets', [TicketController::class, 'index']);
Route::get('/dashboard', [DashboardController::class, 'index']);