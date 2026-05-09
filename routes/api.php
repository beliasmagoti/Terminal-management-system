<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;

use App\Http\Controllers\Api\TerminalController;
use App\Http\Controllers\Api\TankController;
use App\Http\Controllers\Api\SensorController;

use App\Http\Controllers\Api\FuelDeliveryController;
use App\Http\Controllers\Api\FuelTransferController;

use App\Http\Controllers\Api\TankReadingController;
use App\Http\Controllers\Api\MaintenanceRecordController;

use App\Http\Controllers\Api\AlertController;
use App\Http\Controllers\Api\AuditLogController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\DeviceTokenController;

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', [AuthController::class, 'me']);
    });
});

/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES (AUTH REQUIRED)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | USERS 
    |--------------------------------------------------------------------------
    */
    Route::apiResource('users', UserController::class);
        Route::get(
            '/dashboard',
            [DashboardController::class, 'index']
        );
    /*
    |--------------------------------------------------------------------------
    | TERMINALS
    |--------------------------------------------------------------------------
    */
    Route::apiResource('terminals', TerminalController::class);

    /*
    |--------------------------------------------------------------------------
    | TANKS
    |--------------------------------------------------------------------------
    */
    Route::apiResource('tanks', TankController::class);

    /*
    |--------------------------------------------------------------------------
    | SENSORS
    |--------------------------------------------------------------------------
    */
    Route::apiResource('sensors', SensorController::class);

    /*
    |--------------------------------------------------------------------------
    | FUEL DELIVERY
    |--------------------------------------------------------------------------
    */
    Route::apiResource('fuel-deliveries', FuelDeliveryController::class);

    /*
    |--------------------------------------------------------------------------
    | FUEL TRANSFER
    |--------------------------------------------------------------------------
    */
    Route::apiResource('fuel-transfers', FuelTransferController::class);

    /*
    |--------------------------------------------------------------------------
    | TANK READINGS (IoT DATA)
    |--------------------------------------------------------------------------
    */
    Route::apiResource('tank-readings', TankReadingController::class);

    /*
    |--------------------------------------------------------------------------
    | MAINTENANCE RECORDS
    |--------------------------------------------------------------------------
    */
    Route::apiResource('maintenance-records', MaintenanceRecordController::class);

    /*
    |--------------------------------------------------------------------------
    | ALERTS
    |--------------------------------------------------------------------------
    */
    Route::apiResource('alerts', AlertController::class);

    // extra alert actions
    Route::patch('alerts/{id}/resolve', [AlertController::class, 'resolve']);
    Route::patch('alerts/{id}/ignore', [AlertController::class, 'ignore']);

    /*
    |--------------------------------------------------------------------------
    | AUDIT LOGS
    |--------------------------------------------------------------------------
    */
    Route::get('audit-logs', [AuditLogController::class, 'index']);

    /*
    |--------------------------------------------------------------------------
    | DEVICE TOKENS (PUSH NOTIFICATIONS)
    |--------------------------------------------------------------------------
    */
    Route::apiResource('device-tokens', DeviceTokenController::class);
    Route::patch('device-tokens/{id}/deactivate', [DeviceTokenController::class, 'deactivate']);
});