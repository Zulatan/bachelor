<?php

use App\Http\Controllers\BookingsController;
use App\Http\Controllers\ProfileController;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;



##  Handles routes for traditional web pages that render HTML views.                 ##
##  Uses session-based authentication and includes CSRF protection.                  ##
##  Routes defined here expect to return web content (like HTML or Blade templates). ##

// Route::get('/bookings', [BookingsController::class, 'index']);
// Route::get('/customer/{id}/bookings', [BookingsController::class, 'showCustomerBookings']);
// Route::get('/admin/{id}/bookings', [BookingsController::class, 'showCustomerBookings']);


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
