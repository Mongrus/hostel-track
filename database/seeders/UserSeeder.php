<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Organization;
use App\Enums\UserRole;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'surname' => 'Hostel',
            'login' => 'admin',
            'email' => 'admin@example.com',
            'role' => UserRole::ADMIN,
        ]);

        User::factory()
        ->count(3)
        ->has(
            Organization::factory()
                ->count(rand(2, 3))
                ->hasResidents(rand(3, 5))
        )
        ->create();
    }
}
