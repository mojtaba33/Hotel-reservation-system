<?php

use App\Http\Controllers\api\BookableController;
use App\Http\Controllers\api\CheckBookingAvailability;
use App\Http\Controllers\api\CheckoutController;
use App\Http\Controllers\api\GetBookablePriceController;
use App\Http\Controllers\api\ReviewController;
use App\Http\Controllers\api\ShowBookingByReviewKeyController;
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
Route::post('bookable/{bookable:slug}/price', GetBookablePriceController::class);

Route::get('bookable/{bookable:slug}/review', [ReviewController::class,'index']);
Route::get('review/{review}', [ReviewController::class,'show']);
Route::post('review', [ReviewController::class,'store']);
Route::get('booking/{booking:review_key}', ShowBookingByReviewKeyController::class);

Route::post('checkout',[CheckoutController::class,'store']);
