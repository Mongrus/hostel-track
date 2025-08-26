<?php

namespace Tests\Feature;

use App\Models\Resident;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class ResidentCrudTest extends TestCase
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
    public function test_index_shows_residents()
    {

        $resident = Resident::factory()->count(2)->create();

        $response = $this->get(route('residents.index'));
        $response->assertOk()
                ->assertViewIs('residents.index')
                ->assertViewHas('residents')
                ->assertSee((string)$resident[0]->phone)
                ->assertSee((string)$resident[1]->phone);

    }

    /** @test */
    public function test_show_displays_resident()
    {

        $resident = Resident::factory()->create();

        $response = $this->get(route('residents.show', ['resident' => $resident]));
        $response->assertOk()
                ->assertViewIs('residents.show')
                ->assertViewHas('resident')
                ->assertSee((string)$resident->phone);
    }

    /** @test */
    public function test_show_returns_404_for_missing_resident()
    {

        $this->get(route('residents.show', 9999999))->assertNotFound();

    }

    /** @test */
    public function test_user_can_create_resident()
    {

        $payload = [
        'name'               => 'Иван',
        'surname'            => 'Иванов',
        'phone'              => '+375 0000 123 45',
        'organization_mode'  => 'none',
    ];

        $response = $this->post(route('residents.store'), $payload);

        $response->assertSessionHasNoErrors()
                 ->assertRedirect(route('residents.index'));

        $this->assertDatabaseHas('residents', [
            'name'  => 'Иван',
            'surname' => 'Иванов',
            'phone' => '+375 0000 123 45',
            'organization_id' => null,
        ]);
    }

    /** @test */
    public function test_user_can_update_resident()
    {

        $resident = Resident::factory()->create([
        'organization_id'  => null,
        'name'               => 'Иван',
        'surname'            => 'Иванов',
        'phone'              => '+375 0000 123 45',
        ]);

        $response = $this->put(
            route('residents.update', ['resident' => $resident]),
            [
        'name'               => 'Роман',
        'surname'            => 'Романов',
        'phone'              => '+375 0000 123 45',
        ]
        );

        $response->assertSessionHasNoErrors()
                ->assertRedirect(route('residents.show', ['resident' => $resident]));

        $this->assertDatabaseHas('residents', [
        'id' => $resident->id,
        'organization_id'  => null,
        'name'               => 'Роман',
        'surname'            => 'Романов',
        'phone'              => '+375 0000 123 45',
        ]);

    }

    /** @test */
    public function test_user_can_delete_resident()
    {
        $resident = Resident::factory()->create([
        'organization_id'  => null,
        'name'               => 'Иван',
        'surname'            => 'Иванов',
        'phone'              => '+375 0000 123 45',
        ]);

        $response = $this->delete(
            route('residents.destroy', ['resident' => $resident])
        );

        $response->assertSessionHasNoErrors()
                ->assertRedirect(route('residents.index'));

        $this->assertDatabaseMissing('residents', ['id' => $resident->id]);
    }

    /** @test */
    public function test_store_validates_required_fields()
    {
        $this->post(route('residents.store'), [])
             ->assertStatus(302)
             ->assertSessionHasErrors(['name','surname','phone','organization_mode']);
    }

    /** @test */
    public function test_guest_is_redirected_to_login_on_index()
    {
        auth()->logout();

        $this->get(route('residents.index'))
             ->assertRedirect(route('login'));
    }

}
