<?php

namespace Database\Factories;

use App\Enums\LogActions;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RoomLog>
 */
class RoomLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'room_id' => Room::inRandomOrder()->first()?->id ?? Room::factory(),
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'actions' => fake()->randomElement([LogActions::CREATED, LogActions::UPDATED, LogActions::DELETED]),
            'description' => fake()->sentence(),
            'data' => json_encode([
        'previous_status' => fake()->randomElement(['available', 'booked', 'under_maintenance']),
        'new_status' => fake()->randomElement(['booked', 'available']),
        'changed_at' => now()->toDateTimeString()
        ]),
        ];
    }
}
