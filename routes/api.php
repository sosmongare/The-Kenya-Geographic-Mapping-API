<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WardController;
use App\Http\Controllers\CountyController;
use App\Http\Controllers\ConstituencyController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('admin')->group(function () {
    Route::get('counties', [CountyController::class, 'index']);
    Route::post('counties', [CountyController::class, 'store']);
    Route::get('counties/{id}', [CountyController::class, 'show']);
    Route::put('counties/{id}', [CountyController::class, 'update']);
    Route::delete('counties/{id}', [CountyController::class, 'destroy']);
    Route::get('counties/search/{query}', [CountyController::class, 'search']);

    Route::get('constituencies', [ConstituencyController::class, 'index']);
    Route::post('constituencies', [ConstituencyController::class, 'store']);
    Route::get('constituencies/{id}', [ConstituencyController::class, 'show']);
    Route::put('constituencies/{id}', [ConstituencyController::class, 'update']);
    Route::delete('constituencies/{id}', [ConstituencyController::class, 'destroy']);
    Route::get('constituencies/search/{query}', [ConstituencyController::class, 'search']);

    Route::get('wards', [WardController::class, 'index']);
    Route::post('wards', [WardController::class, 'store']);
    Route::get('wards/{id}', [WardController::class, 'show']);
    Route::put('wards/{id}', [WardController::class, 'update']);
    Route::delete('wards/{id}', [WardController::class, 'destroy']);
    Route::get('wards/search/{query}', [WardController::class, 'search']);
});