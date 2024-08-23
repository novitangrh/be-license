<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FYP\RoutingController;

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
RoutingController::LoadServices();
RoutingController::LoadPublicServices();

Route::apiResource('licence-type', \App\Http\Controllers\LicenceTypeController::class);
Route::apiResource('licence', \App\Http\Controllers\LicenceController::class);
Route::apiResource('contact', \App\Http\Controllers\ContactController::class);
Route::apiResource('notification-setting', \App\Http\Controllers\NotificationController::class)->only([
    'index', 'show', 'update'
]);

Route::controller(\App\Http\Controllers\AuthController::class)->group(function () {
    Route::post('/login', 'login');
    Route::get('/profile', 'getProfile');
});
