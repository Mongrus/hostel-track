<?php

namespace Tests\Feature;

use App\Models\Organization;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class OrganizationCrudTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    /** @test */
    public function test_index_shows_organizations()
    {

        $organizations = Organization::factory()->count(2)->create([
            'owner_id' => $this->user->id
        ]);

        $this->get(route('organizations.index'))
            ->assertOk()
            ->assertViewIs('organizations.index')
            ->assertViewHas('organizations', fn ($list) => $list->count() === 2)
            ->assertSee((string)$organizations[0]->phone)
            ->assertSee((string)$organizations[1]->phone);
    }

    /** @test */
    public function test_show_displays_organization()
    {

        $organization = Organization::factory()->create([
            'owner_id' => $this->user->id
        ]);

        $this->get(route('organizations.show', ['organization' => $organization]))
            ->assertOk()
            ->assertViewIs('organizations.show')
            ->assertViewHas('organization')
            ->assertSee((string)$organization->phone);

    }

    /** @test */
    public function test_user_can_create_organization()
    {

        $payload = [
            'owner_id' => $this->user->id,
            'name' => 'Тестовая организация',
            'phone' => '+375 0000 123 45',
            'email' => 'ivanivanov@gmail.com',
            'description' => 'Информация об организации'
        ];

        $response = $this->post(route('organizations.store'), $payload);

        $response->assertRedirect(route('organizations.index'));

        $this->assertDatabaseHas('organizations', $payload);


    }
}
