<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Bookings;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingsModelTest extends TestCase
{
    use RefreshDatabase; // Ensures a fresh database for each test

    public function test_bookings_model_relationships()
    {
        // Create a customer and an admin
        $customer = User::factory()->create();
        $admin = User::factory()->create();

        // Create a booking
        $booking = Bookings::factory()->create([
            'customer' => $customer->id,
            'admin' => $admin->id,
        ]);

        // Test relationships
        $this->assertInstanceOf(User::class, $booking->customerRelation); // Check customer relation
        $this->assertEquals($customer->id, $booking->customerRelation->id);

        $this->assertInstanceOf(User::class, $booking->adminRelation); // Check admin relation
        $this->assertEquals($admin->id, $booking->adminRelation->id);
    }
}
