<?php

use App\Http\Controllers\BookingsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CsrfTokenController;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

##  Handles routes for traditional web pages that render HTML views.                 ##
##  Uses session-based authentication and includes CSRF protection.                  ##
##  Routes defined here expect to return web content (like HTML or Blade templates). ##

Route::get('/bookings/customers', [BookingsController::class, 'index']);
Route::get('/bookings/customer/{userId}', [BookingsController::class, 'getCustomerBookings']);
Route::get('/bookings/worker/{userId}', [BookingsController::class, 'GetWorkerBookings']);
Route::get('/bookings/{id}', [BookingsController::class, 'getBookingWithServices']);

// Route::post('/bookings/customer/{userId}', [BookingsController::class, 'storeBooking']);
Route::post('/bookings', [BookingsController::class, 'storeBooking']);

// auth 

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::get('csrf-token', [CsrfTokenController::class, 'getCsrfToken']);

// Route::get('csrf-token', function () {
//     return response()->json(['token' => csrf_token()]);
// });