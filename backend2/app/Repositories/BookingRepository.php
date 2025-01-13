<?php

namespace App\Repositories;

use App\Models\Bookings;
use Illuminate\Database\Eloquent\Collection;

class BookingRepository
{
    public function getAllBookings(): Collection
    {
        return Bookings::with('user')->get();
    }

    public function getCustomerBookings(int $userId): Collection
    {
        return Bookings::with('user')
            ->whereHas('user', function ($query) use ($userId) {
                $query->where('id', $userId)->where('customer', true);
            })
            ->get();
    }

    public function getWorkerBookings(int $userId): Collection
    {
        return Bookings::with('user')
            ->whereHas('user', function ($query) use ($userId) {
                $query->where('id', $userId)->where('worker', true);
            })
            ->get();
    }

    public function getBookingWithServices(int $bookingId): Bookings
    {
        $booking = Bookings::with('services')->findOrFail($bookingId);
        return $booking;
    }


    public function createBooking(array $data, array $serviceIds): Bookings
    {
        $booking = Bookings::create($data);
        $booking->services()->attach($serviceIds);
        return $booking;
    }
}

// $booking = Bookings::where('id', 5)->first();
// $eksempel = "SELECT * FROM bookings WHERE id = ?";

// $forespørgsel = 
// "SELECT 
//     b.id AS booking_id,
//     b.user_id,
//     b.scheduled_time,
//     b.status,
//     s.name AS service_name,
//     s.description AS service_description
// FROM 
//     bookings b
// JOIN 
//     booking_services bs ON b.id = bs.booking_id
// JOIN 
//     services s ON bs.service_id = s.id
// WHERE 
//     b.id = 1;"

// $eloquentEksempel = Bookings::with('services')->find(1);

