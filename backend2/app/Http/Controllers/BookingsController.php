<?php

namespace App\Http\Controllers;

use App\Models\User;

class BookingsController extends Controller
{
    public function showCustomerBookings($customerId)
    {
        // Fetch the customer by ID
        $customer = User::find($customerId);

        // Get the bookings related to this customer
        $bookings = $customer->customerBookings;

        // Return a view and pass the bookings data
        // return view('bookings.customer', compact('bookings'));
        return response()->json([
            "bookings" => $bookings
        ], 200);

    }

    public function showAdminBookings($adminId)
    {
        // Fetch the admin by ID
        $admin = User::find($adminId);

        // Get the bookings related to this admin
        $bookings = $admin->adminBookings;

        // Return a view and pass the bookings data
        return view('admin.bookings', compact('bookings'));
    }
}
