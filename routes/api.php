<?php

use Illuminate\Http\Request;
use App\Http\Controllers\FlightController;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/flights/add', [FlightController::class, 'store']);
Route::get('/flights/search', [FlightController::class, 'search']);
