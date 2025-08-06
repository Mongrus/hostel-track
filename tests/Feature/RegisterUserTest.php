<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class RegisterUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_register_with_valid_data(): void
    {
        $payload = [
            'name' => 'Тестовый пользователь',
            'email' => 'test@example.com',
            'login' => 'testuser',
            'password' => 'password',
            'role' => 'admin',
        ];

        $response = $this->postJson('/api/register', $payload);

        $response->assertStatus(201);
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com'
        ]);
    }
}
