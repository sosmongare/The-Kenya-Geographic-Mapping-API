<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiLogController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('apilogs', [ApiLogController::class, 'index'])->name('apilogs.index');
Route::get('apilogs/analytics', [ApiLogController::class, 'analytics'])->name('apilogs.analytics');

Route::get('apilogs/endpoint-usage', [ApiLogController::class, 'endpointUsage'])->name('apilogs.endpointUsage');
Route::get('apilogs/{id}', [ApiLogController::class, 'show'])->name('apilogs.show');

