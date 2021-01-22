<?php

use App\Http\Controllers\api\BookableController;
use App\Http\Controllers\api\CheckBookingAvailability;
use App\Http\Controllers\api\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('bookable', BookableController::class);
Route::get('bookable/{bookable:slug}/availability',CheckBookingAvailability::class);

Route::get('bookable/{bookable:slug}/review', [ReviewController::class,'index']);