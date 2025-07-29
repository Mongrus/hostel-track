<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\RoomLog;
use Illuminate\Database\Seeder;

class RoomLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RoomLog::factory()->count(1000)->create();
    }
}
