<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingsController;
use App\Http\Controllers\CsrfTokenController;
use Illuminate\Http\Request;

Route::get('/bookings/customers', [BookingsController::class, 'index']);
Route::get('/bookings/customer/{userId}', [BookingsController::class, 'getCustomerBookings']);
Route::get('/bookings/worker/{userId}', [BookingsController::class, 'GetWorkerBookings']);
Route::get('/bookings/{id}', [BookingsController::class, 'getBookingWithServices']);

Route::post('/bookings', [BookingsController::class, 'storeBooking']);

Route::post('/tokens/create', function (Request $request) {
    $token = $request->user()->createToken($request->token_name);

    return ['token' => $token->plainTextToken];
});

// auth routes
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::middleware('api')->post('/login', [AuthController::class, 'login']);


Route::get('csrf-token', [CsrfTokenController::class, 'getCsrfToken']);
// Route::get('csrf-token', function () {
//     return response()->json(['token' => csrf_token()]);
// });