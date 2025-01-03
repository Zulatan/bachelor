<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Bookings;
use Illuminate\Http\Request;
// use Illuminate\Container\Attributes\Log;
use App\Repositories\BookingRepository;


class BookingsController extends Controller
{
    protected $bookingRepository;

    public function __construct(BookingRepository $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }

    public function index()
    {
        $bookings = $this->bookingRepository->getAllBookings();
        return response()->json($bookings);
    }
    
    public function getCustomerBookings($userId)
    {
        $bookings = $this->bookingRepository->getCustomerBookings($userId);
        return response()->json($bookings);
    }

    public function getWorkerBookings($userId)
    {
        $bookings = $this->bookingRepository->getWorkerBookings($userId);
        return response()->json($bookings);
    }


    public function storeBooking(Request $request)
    {
        // validate date and time and id of service with built in http request object
        $validateData = $request->validate([
            'date'          => 'required|date',
            'time'          => 'required|date_format:H:i', // validerer time format
            'service_id'    => 'required|exists:services,id', // findes servicen
        ]);
        
        $scheduledTime = $validateData['date']. '' . $validateData['time'];

        try {
            $data = [
                'user_id'           => $request->user()->id,
                'scheduled_time'    => $scheduledTime,
                'status'            => 'pending',
            ];

            $booking = $this->bookingRepository->createBooking($data, [$validateData['service_id']]);
            $booking->services()->attach($validateData['service_id']);

        } catch (\Throwable $th) {
            //throw $th;
            report($th);
            return response()->json([
                'message' => 'Fejl i oprettelsen af en booking'
            ], 500); // 500 = intern server fejl
        }

        return response()->json($booking, 201); // 201= succesful oprettelse
    }
}


