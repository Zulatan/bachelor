<?php

use App\Http\Controllers\BookingsController;
use App\Http\Controllers\ProfileController;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

##  Handles routes for traditional web pages that render HTML views.                 ##
##  Uses session-based authentication and includes CSRF protection.                  ##
##  Routes defined here expect to return web content (like HTML or Blade templates). ##

Route::get('/bookings/customers', [BookingsController::class, 'index']);

Route::get('/bookings/customer/{userId}', [BookingsController::class, 'getCustomerBookings']);

Route::get('/bookings/worker/{userId}', [BookingsController::class, 'GetWorkerBookings']);

// Route::post('/bookings/customer/{userId}', [BookingsController::class, 'storeBooking']);
Route::post('/bookings', [BookingsController::class, 'storeBooking']);

// VUE INERTIA code

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';