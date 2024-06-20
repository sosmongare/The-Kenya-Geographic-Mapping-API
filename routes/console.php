<?php

use App\Http\Middleware\LogRequest;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

$middlewareGroups = [
    'api' => [
        LogRequest::class,
        // other middlewares...
    ],
];
