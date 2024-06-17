<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WardController;
use App\Http\Controllers\CountyController;
use App\Http\Controllers\ConstituencyController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('counties', CountyController::class);
Route::apiResource('constituencies', ConstituencyController::class);
Route::apiResource('wards', WardController::class);

Route::get('counties/search/{query}', [CountyController::class, 'search']);
Route::get('constituencies/search/{query}', [ConstituencyController::class, 'search']);
Route::get('wards/search/{query}', [WardController::class, 'search']);
