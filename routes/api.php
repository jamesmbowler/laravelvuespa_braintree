<?php

use App\Http\Controllers\AdvancedStatsController;
use App\Http\Controllers\BasicStatsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BraintreeController;

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

Route::get('/braintree/clientToken', [BraintreeController::class, 'clientToken']);
Route::post('/checkout', [BraintreeController::class, 'checkout']);

Route::get('/stats', [BasicStatsController::class, 'stats']);
Route::get('/advanced_stats', [AdvancedStatsController::class, 'stats']);