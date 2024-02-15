<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TicketsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/get-token', [AuthController::class, 'getUserToken']);

Route::middleware('auth:sanctum')->group(function () {
    Route::group(['prefix' => 'tickets'], function () {
        Route::get('open', [TicketsController::class, 'openTickets']);
        Route::get('closed', [TicketsController::class, 'closedTickets']);
    });
    Route::group(['prefix' => 'users'], function () {
        Route::get('{email}/tickets', [TicketsController::class, 'getUserTickets']);
    });
    Route::get('/stats', [TicketsController::class, 'stats']);
});
