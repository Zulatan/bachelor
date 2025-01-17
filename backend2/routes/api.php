<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingsController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// auth 
Route::post('/register', [AuthController::class, 'register']);
Route::login('/login', [AuthController::class, 'login']);
Route::logout('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
