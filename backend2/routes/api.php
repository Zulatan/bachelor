<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BookingsController;
use Inertia\Inertia;

Route::get('/bookings/customer/{userId}', [BookingsController::class, 'getCustomerBookings']);

Route::get('/bookings/worker/{userId}', [BookingsController::class, 'GetWorkerBookings']);

Route::post('/bookings/customer/{userId}', [BookingsController::class, 'storeBooking']);