<?php

use App\Http\Controllers\API\AvailableDateController;
use App\Http\Controllers\API\BookingController;
use App\Models\AvailableDate;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// available date
Route::get('available-dates', [AvailableDateController::class, 'index']);
Route::post('available-dates',[AvailableDateController::class, 'store']);
// booking
Route::post('bookings', [BookingController::class, 'store']);