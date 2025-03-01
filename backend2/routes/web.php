<?php

use App\Http\Controllers\BookingsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CsrfTokenController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;


// bookings
Route::get('/bookings/customers', [BookingsController::class, 'index']);
Route::get('/bookings/customer/{userId}', [BookingsController::class, 'getCustomerBookings']);
Route::get('/bookings/worker/{userId}', [BookingsController::class, 'GetWorkerBookings']);
Route::get('/bookings/{id}', [BookingsController::class, 'getBookingWithServices']);
// Route::post('/bookings/customer/{userId}', [BookingsController::class, 'storeBooking']);
Route::post('/bookings', [BookingsController::class, 'storeBooking']);

# users
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);

// auth 
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::get('csrf-token', [CsrfTokenController::class, 'getCsrfToken']);
// Route::get('/sanctum/csrf-cookie', function () {
//     return response()->json(['message' => 'CSRF Cookie set']);
// });