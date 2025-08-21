<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\User;

class RegisterUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_register_with_valid_data(): void
    {
        $payload = [
            'name' => 'Тестовый',
            'surname' => 'Пользователь',
            'email' => 'test@example.com',
            'login' => 'testuser',
            'password' => 'secret123',
            'role' => 'admin',
        ];

        $response = $this->post('register', $payload);

        $response->assertRedirect(route('login'));
        $response->assertSessionHas('status', 'Регистрация прошла успешно');

        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
            'login' => 'testuser',
            'name'  => 'Тестовый',
            'surname' => 'Пользователь',
        ]);

        $user = User::where('email', 'test@example.com')->firstOrFail();
        $this->assertTrue(Hash::check('secret123', $user->password));
    }

    /** @test */
    public function registration_validates_required_fields(): void
    {
        $response = $this->post(route('register'), []);
        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'name', 'surname', 'email', 'password', 'role'
        ]);
    }

    /** @test */
    public function email_must_be_unique(): void
    {
        User::factory()->create(['email' => 'test@example.com']);

        $response = $this->post(route('register'), [
            'name'                  => 'Другой',
            'email'                 => 'test@example.com',
            'login'                 => 'another',
            'password'              => 'secret123',
            'password_confirmation' => 'secret123',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['email']);
    }
}
