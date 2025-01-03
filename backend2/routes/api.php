<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingsController;

Route::get('/bookings/customers', [BookingsController::class, 'index']);

Route::get('/bookings/customer/{userId}', [BookingsController::class, 'getCustomerBookings']);

Route::get('/bookings/worker/{userId}', [BookingsController::class, 'GetWorkerBookings']);

Route::post('/bookings', [BookingsController::class, 'storeBooking']);