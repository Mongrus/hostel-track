<?php

namespace Database\Seeders;

use App\Models\Bed;
use App\Models\Booking;
use App\Models\Resident;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Enums\BookingLevel;
use App\Enums\BookingStatus;
use Illuminate\Support\Arr;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        $residents = Resident::all();
        $beds = Bed::all();
        $users = User::all();

        // Заселяем первых 20 жильцов (или сколько есть)
        foreach ($residents->take(20) as $resident) {
            $bed = $beds->random();
            $user = $users->random();

            Booking::create([
                'room_id' => $bed->room_id,
                'bed_id' => $bed->id,
                'user_id' => $user->id,
                'resident_id' => $resident->id,
                'booking_level' => Arr::random(BookingLevel::cases())->value,
                'status'        => Arr::random(BookingStatus::cases())->value,
                'start_date' => now(),
                'end_date' => now()->addDays(7),
                'comment' => 'Тестовое бронирование',
            ]);
        }
    }
}
