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
    Route::get('/', function(){
        return 'Welcome to Kenya Administrative Boundaries API';
    });
    Route::get('counties', [CountyController::class, 'index']);
    Route::post('counties', [CountyController::class, 'store']);
    Route::get('counties/search', [CountyController::class, 'search']);
    Route::get('counties/{id}', [CountyController::class, 'show']);
    Route::put('counties/{id}', [CountyController::class, 'update']);
    Route::delete('counties/{id}', [CountyController::class, 'destroy']);
    Route::get('/counties/{county_id}/constituencies', [CountyController::class, 'getConstituenciesByCounty']);

    Route::get('constituencies', [ConstituencyController::class, 'index']);
    Route::post('constituencies', [ConstituencyController::class, 'store']);
    Route::get('/constituencies/search', [ConstituencyController::class, 'search']); // More specific route above the rest
    Route::get('constituencies/{id}', [ConstituencyController::class, 'show']);
    Route::put('constituencies/{id}', [ConstituencyController::class, 'update']);
    Route::delete('constituencies/{id}', [ConstituencyController::class, 'destroy']);
    Route::get('/constituencies/{constituency_id}/wards', [ConstituencyController::class, 'getWardsByConstituency']);
    Route::get('/counties/{county_id}/constituencies/{constituency_id}/wards', [ConstituencyController::class, 'getWardsByCountyAndConstituency']);

    Route::get('wards', [WardController::class, 'index']);
    Route::post('wards', [WardController::class, 'store']);
    Route::get('wards/search', [WardController::class, 'search']);
    Route::get('wards/{id}', [WardController::class, 'show']);
    Route::put('wards/{id}', [WardController::class, 'update']);
    Route::delete('wards/{id}', [WardController::class, 'destroy']);


});