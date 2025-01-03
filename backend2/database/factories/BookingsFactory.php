<?php

namespace Database\Factories;

use App\Models\Bookings;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingsFactory extends Factory
{
    protected $model = Bookings::class;

    public function definition()
    {
        return [
            'user_id' => 1, // Erstat evt. med dynamisk bruger-id
            'scheduled_time' => $this->faker->dateTimeBetween('+1 days', '+2 weeks'),
            'status' => 'pending',
        ];
    }
}
