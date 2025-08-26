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
    public function test_show_returns_404_for_missing_organization()
    {

        $this->get(route('organizations.show', 9999999))->assertNotFound();

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

    /** @test */
    public function test_user_can_update_organization()
    {
        $organization = Organization::factory()
            ->for($this->user, 'owner')
            ->create([
                'name' => 'Тестовая организация',
                'phone' => '+375 0000 123 45',
                'email' => 'ivanivanov@gmail.com',
                'description' => 'Информация об организации',
            ]);

        $response = $this->put(route('organizations.update', $organization), [
            'name' => 'Новая организация',
            'phone' => '+375 1234 123 45',
            'email' => 'ivan12345@gmail.com',
            'description' => 'Что-то поменялось',
        ]);

        $response->assertSessionHasNoErrors()
            ->assertRedirect(route('organizations.show', $organization));

        $this->assertDatabaseHas('organizations', [
            'id'       => $organization->id,
            'owner_id' => $this->user->id,
            'name'     => 'Новая организация',
            'phone'    => '+375 1234 123 45',
            'email'    => 'ivan12345@gmail.com',
            'description' => 'Что-то поменялось',
        ]);
    }

    /** @test */
    public function test_user_can_delete_organization()
    {

        $organization = Organization::factory()->create([
            'id' => 100,
            'owner_id' => $this->user->id
        ]);

        $response = $this->delete(route('organizations.destroy', ['organization' => $organization]));

        $response->assertSessionHasNoErrors()
                ->assertRedirect(route('organizations.index'));

        $this->assertDatabaseMissing('organizations', [
            'id' => 100
        ]);

    }

    /** @test */
    public function test_store_validates_required_fields()
    {
        $this->post(route('organizations.store'), [])
             ->assertStatus(302)
             ->assertSessionHasErrors(['name','phone','email']);
    }

    /** @test */
    public function test_guest_is_redirected_to_login_on_index()
    {
        auth()->logout();

        $this->get(route('organizations.index'))
             ->assertRedirect(route('login'));
    }
}
