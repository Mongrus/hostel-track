<?php

namespace Database\Factories;

use App\Enums\BookingLevel;
use App\Enums\BookingStatus;
use App\Models\Resident;
use App\Models\Room;
use App\Models\Bed;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = fake()->dateTimeBetween('-1 week', '+1 week');
        $end = (clone $start)->modify('+'.fake()->numberBetween(1, 30).' days');

        return [
            'room_id' => Room::factory(),
            'bed_id' => Bed::factory(),
            'user_id' => User::factory(),
            'resident_id' => Resident::factory(),
            'booking_level' => fake()->randomElement([BookingLevel::ROOM, BookingLevel::BED]),
            'status' => fake()->randomElement([BookingStatus::BOOKED, BookingStatus::DAILY, BookingStatus::LONGTERM]),
            'comment' => fake()->text(50),
            'start_date' => $start,
            'end_date' => $end,
        ];
    }
}
