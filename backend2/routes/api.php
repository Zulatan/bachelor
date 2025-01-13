<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingsController;

Route::get('/bookings/customers', [BookingsController::class, 'index']);
Route::get('/bookings/customer/{userId}', [BookingsController::class, 'getCustomerBookings']);
Route::get('/bookings/worker/{userId}', [BookingsController::class, 'GetWorkerBookings']);
Route::get('/bookings', [BookingsController::class, 'getBookingWithServices']);

Route::post('/bookings', [BookingsController::class, 'storeBooking']);


// auth 


Route::post('/register', [AuthController::class, 'register']);
Route::login('/login', [AuthController::class, 'login']);
Route::logout('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');