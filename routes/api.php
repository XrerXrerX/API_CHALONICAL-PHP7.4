<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth.bearer')->group(function () {
    Route::get('/calonical/{website?}', [ApiController::class, 'calonicalindex']);
    Route::get('/calonicalview/{id}', [ApiController::class, 'calonicalview']);
    Route::post('/calonical', [ApiController::class, 'calonicalstore']);
    Route::put('/calonical', [ApiController::class, 'calonicalupdate']);
    Route::delete('/calonical', [ApiController::class, 'calonicaldestroy']);
});
