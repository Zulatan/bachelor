<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Bookings;
use Illuminate\Http\Request;
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
        try {
            $bookings = $this->bookingRepository->getAllBookings();
            return response()->json([
                $bookings,
                'message' => 'hentede alle bookinger'
            ]);

        } catch (\Throwable $th) {
            report($th);
            return response()->json([
                'message' => 'fejl i hentelsen af bookinger'
            ], 500); // 500 = intern server fejl
        }
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

    public function getBookingWithServices($bookingId)
    {
        $bookings = $this->bookingRepository->getBookingWithServices($bookingId);
        return response()->json($bookings);
    }

    public function storeBooking(Request $request)
    {
        $validateData = $request->validate([
            'date'          => 'required|date',
            'time'          => 'required|date_format:H:i', // tidsformat valideres
            'service_id'    => 'required|exists:services,id', // tjekker at servicen findes i systemet
        ]);
        
        $scheduledTime = $validateData['date']. '' . $validateData['time'];

        try {
            $data = [
                'user_id'           => $request->user()->id,
                'scheduled_time'    => $scheduledTime,
                'status'            => 'pending',
            ];

            $booking = $this->bookingRepository->createBooking($data, [$validateData['service_id']]);
            // $booking->services()->attach($validateData['service_id']);

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


