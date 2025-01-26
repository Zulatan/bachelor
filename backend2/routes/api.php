<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingsController;
use App\Http\Controllers\CsrfTokenController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;


# Bookings
// Route::get('/bookings/customers', [BookingsController::class, 'index']);
// Route::get('/bookings/customer/{userId}', [BookingsController::class, 'getCustomerBookings']);
// Route::get('/bookings/worker/{userId}', [BookingsController::class, 'GetWorkerBookings']);
// Route::get('/bookings/{id}', [BookingsController::class, 'getBookingWithServices']);
// Route::post('/bookings', [BookingsController::class, 'storeBooking']);

# users
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);





// auth routes

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::post('/login', [AuthController::class, 'login']);
// Route::post('/register', [AuthController::class, 'register']);
// Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);


// Route::get('csrf-token', [CsrfTokenController::class, 'getCsrfToken']);

Route::get('/test', function () {
    return 'Hello, world!';
});


// Route::get('/sanctum/csrf-cookie', function () {
//     return response()->json(['message' => 'CSRF Cookie set']);
// });