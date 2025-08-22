<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Room;
use App\Models\User;

class RoomCrudTest extends TestCase
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
    public function test_index_shows_rooms()
    {
        $rooms = Room::factory()->count(2)->create();

        $resp = $this->get(route('rooms.index'));
        $resp->assertOk()
             ->assertViewIs('rooms.index')
             ->assertViewHas('rooms')
             ->assertSee((string)$rooms[0]->number)
             ->assertSee((string)$rooms[1]->number);
    }

    /** @test */
    public function test_show_displays_room()
    {
        $room = Room::factory()->create();

        $this->get(route('rooms.show', $room->id))
             ->assertOk()
             ->assertViewIs('rooms.show')
             ->assertSee((string)$room->number);
    }

    /** @test */
    public function test_show_returns_404_for_missing_room()
    {
        $this->get(route('rooms.show', 999999))->assertNotFound();
    }

    /** @test */
    public function test_user_can_create_room(): void
    {

        $payload = [
            'number' => 50,
            'type' => 'single',
            'description' => 'Комната для персонала'
        ];

        $response = $this->post(route('rooms.store'), $payload);

        $this->assertDatabaseHas('rooms', [
            'number' => 50,
            'type' => 'single',
            'description' => 'Комната для персонала'
        ]);

        $room = Room::where('number', $payload['number'])->firstOrFail();
        $response->assertRedirectToRoute('beds.create', $room->id);
    }

    /** @test */
    public function test_user_can_update_room()
    {
        $room = Room::factory()->create([
            'number' => 50,
            'type' => 'single',
            'description' => 'Комната для персонала',
        ]);

        $resp = $this->put(route('rooms.update', $room->id), [
            'number' => 5,
            'type' => 'multi',
            'description' => 'Данные комнаты изменены',
        ]);

        $resp->assertSessionHasNoErrors()
             ->assertRedirect(route('rooms.show', $room->id));

        $this->assertDatabaseHas('rooms', ['id' => $room->id, 'number' => 5, 'type' => 'multi']);
    }

    /** @test */
    public function test_user_can_delete_room()
    {

        $room = Room::factory()->create([
            'number' => 50,
            'type' => 'single',
            'description' => 'Комната для персонала',
        ]);

        $resp = $this->delete(route('rooms.destroy', $room->id));

        $resp->assertSessionHasNoErrors()
            ->assertRedirect(route('rooms.index'));

        $this->assertDatabaseMissing('rooms', ['id' => $room->id]);

    }

    /** @test */
    public function test_store_validates_required_fields()
    {
        $this->post(route('rooms.store'), [])
             ->assertStatus(302)
             ->assertSessionHasErrors(['number','type']);
    }

    /** @test */
    public function test_guest_is_redirected_to_login_on_index()
    {
        auth()->logout();

        $this->get(route('rooms.index'))
             ->assertRedirect(route('login'));
    }

}
