<?php

namespace App\Repositories;

interface BookingRepositoryInterface
{
    public function getAllBookings();
    public function getBookingById($id);
    public function createBooking(array $data);
    public function updateBooking($id, array $data);
    public function deleteBooking($id);
}
