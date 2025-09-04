<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/health', function () {
    try {
        // Test database connection
        DB::connection()->getPdo();
        
        return response()->json([
            'status' => 'OK',
            'timestamp' => now()->toISOString(),
            'service' => 'modowork-api',
            'version' => config('app.version', '1.0.0'),
            'environment' => config('app.env'),
            'database' => 'connected',
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'ERROR',
            'timestamp' => now()->toISOString(),
            'service' => 'modowork-api',
            'version' => config('app.version', '1.0.0'),
            'environment' => config('app.env'),
            'database' => 'disconnected',
            'error' => 'Database connection failed'
        ], 503);
    }
});
