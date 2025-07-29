<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\RoomType;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected static int $counter = 1;

    public function definition(): array
    {
        return [
            'number' => sprintf('R-%02d', self::$counter++),
            'type' => fake()->randomElement([RoomType::SINGLE, RoomType::MULTI]),
            'description' => fake()->text(100)
        ];
    }
}
