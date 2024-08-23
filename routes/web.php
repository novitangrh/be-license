<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return response()->json([
        'name' => '{APP_NAME}',
        'state' => 'Normal'
    ], 200);
});

Route::post('/tes', function () {
    return response()->json([
        'name' => 'TES',
        'state' => 'Mantap'
    ], 200);
});


Route::get('/token', function () {
    $token = csrf_token();
    return response()->json([
        'name' => 'token',
        'value' => $token
    ], 200);
});