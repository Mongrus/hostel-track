<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Room;
use App\Models\Bed;

class BedCrudTest extends TestCase
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
    public function test_index_shows_beds()
    {

        $room = Room::factory()->create(['number' => 101]);
        $beds = Bed::factory()->count(2)->create(['room_id' => $room->id]);

        $response = $this->get(route('beds.index', ['room' => $room]));
        $response->assertOk()
                ->assertViewIs('beds.index')
                ->assertViewHas('beds')
                ->assertSee((string)$beds[0]->label)
                ->assertSee((string)$beds[1]->label);

    }

    /** @test */
    public function test_show_displays_bed()
    {

        $room = Room::factory()->create(['number' => 101]);
        $bed = Bed::factory()->create(['room_id' => $room->id]);

        $response = $this->get(route('beds.show', ['room' => $room, 'bed' => $bed]));
        $response->assertOk()
                ->assertViewIs('beds.show')
                ->assertViewHas('bed')
                ->assertSee((string)$bed->label);
    }

    /** @test */
    public function test_show_returns_404_for_missing_bed()
    {

        $room = Room::factory()->create();

        $response = $this->get(route('beds.show', [
            'room' => $room->id,
            'bed'  => 999999,
        ]));

        $response->assertNotFound();

    }


    /** @test */
    public function user_can_create_bed_in_room()
    {

        $room = Room::factory()->create(['number' => 101]);

        $payload = [
            'beds' => ['14'],
            'descriptions' => ['Новая кровать'],
        ];

        $response = $this->post(route('beds.store', ['room' => $room->id]), $payload);

        $response->assertSessionHasNoErrors()
                 ->assertRedirect(route('rooms.show', $room));

        $this->assertDatabaseHas('beds', [
            'room_id'     => $room->id,
            'label'       => '14',
            'description' => 'Новая кровать',
        ]);

    }

    /** @test */
    public function user_can_update_bed_in_room()
    {

        $room = Room::factory()->create(['number' => 101]);
        $bed = Bed::factory()->create([
            'room_id' => $room->id,
            'label' => '14',
            'description' => 'Новая кровать',
        ]);

        $payload = [
            'label' => '50',
            'description' => 'Кровать изменена',
        ];

        $response = $this->put(route('beds.update', ['room' => $room, 'bed' => $bed]), $payload);

        $response->assertSessionHasNoErrors()
                ->assertRedirect(route('beds.index', $room));

        $this->assertDatabaseHas('beds', [
            'id' => $bed->id,
            'label' => '50',
            'description' => 'Кровать изменена'
        ]);
    }

    /** @test */
    public function user_can_delete_bed_in_room()
    {

        $room = Room::factory()->create(['number' => 101]);
        $bed = Bed::factory()->create([
            'room_id' => $room->id,
            'label' => '50',
            'description' => 'Крвать создана'
        ]);

        $response = $this->delete(route('beds.destroy', ['room' => $room, 'bed' => $bed]));

        $response->assertSessionHasNoErrors()
                ->assertRedirect(route('beds.index', $room));

        $this->assertDatabaseMissing('beds', ['id' => $bed->id]);

    }

    /** @test */
    public function test_store_validates_required_fields()
    {
        $room = Room::factory()->create();

        $this->post(route('beds.store', ['room' => $room]), [])
             ->assertStatus(302)
             ->assertSessionHasErrors(['beds']);
    }

    /** @test */
    public function test_guest_is_redirected_to_login_on_index()
    {
        auth()->logout();

        $room = Room::factory()->create();

        $this->get(route('beds.index', ['room' => $room]))
             ->assertRedirect(route('login'));
    }
}
