<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Repositories\BookingRepository;

class BookingRepositoryTest extends TestCase
{
    public function test_createBooking()
    {
        // Arrange: Opret bruger
        $user = User::factory()->create();

        $data = [
            'user_id' => $user->id,
            'scheduled_time' => now(),
            'status' => 'pending',
            'accepted' => true,
        ];

        $repository = new BookingRepository();

        // Act: Opret booking
        $booking = $repository->createBooking($data, [2]); 

        // Assert: Tjek at booking blev oprettet
        $this->assertDatabaseHas('bookings', ['user_id' => $user->id]);
        $this->assertTrue($booking->services()->exists());
    }

    // public function test_getAllBookings()
    // {
    //     // Arrange: Lav dummy bookings
    //     User::factory()->create();
    //     Bookings::factory(5)->create();

    //     $repository = new BookingRepository();
 
    //     // Act: Hent alle bookings
    //     $bookings = $repository->getAllBookings();

    //     // Assert: Tjek om vi har fået de rigtige data
    //     $this->assertCount(5, $bookings);
    // }

}

