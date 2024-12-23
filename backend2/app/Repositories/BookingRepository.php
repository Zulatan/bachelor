<?php

namespace App\Repositories;

use App\Models\Bookings;
use Illuminate\Database\Eloquent\Collection;

class BookingRepository
{
    // Hent alle bookinger med tilhørende bruger
    public function getAllBookings(): Collection
    {
        return Bookings::with('user')->get();
    }

    // fetch kunden bookinger
    public function getCustomerBookings(int $userId): Collection
    {
        return Bookings::with('user')
            ->whereHas('user', function ($query) use ($userId) {
                $query->where('id', $userId)->where('customer', true);
            })
            ->get();
    }

    // fetch arbejder bookinger
    public function getWorkerBookings(int $userId): Collection
    {
        return Bookings::with('user')
            ->whereHas('user', function ($query) use ($userId) {
                $query->where('id', $userId)->where('worker', true);
            })
            ->get();
    }

    // Opret en ny booking
    public function createBooking(array $data): Bookings
    {
        return Bookings::create($data);
    }
}
