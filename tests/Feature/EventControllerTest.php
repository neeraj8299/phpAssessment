<?php
namespace Tests\Feature;

use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // Run the migrations before each test
        $this->artisan('migrate');
    }

    public function test_can_list_events()
    {
        Event::factory()->count(3)->create();
        $response = $this->getJson('/api/events');
        $response->assertStatus(200)
                 ->assertJsonStructure(['data', 'links']);
    }

    public function test_can_create_event()
    {
        $data = [
            'name' => 'Sample Event',
            'description' => 'Some description',
            'country' => 'India',
            'capacity' => 50,
            'start_time' => now()->addHour()->toDateTimeString(),
            'end_time' => now()->addHours(2)->toDateTimeString(),
        ];

        $response = $this->postJson('/api/events', $data);

        $response->assertStatus(200)
                 ->assertJsonFragment(['message' => 'Event created successfully.']);
        $this->assertDatabaseHas('events', ['name' => 'Sample Event']);
    }

    public function test_can_view_event()
    {
        $event = Event::factory()->create();
        $response = $this->getJson("/api/events/{$event->id}");
        $response->assertStatus(200)
                 ->assertJsonFragment(['id' => $event->id]);
    }

    public function test_can_update_event()
    {
        $event = Event::factory()->create();

        $updateData = [
            'name' => 'Updated Event Name',
            'country' => 'USA',
        ];

        $response = $this->putJson("/api/events/{$event->id}", $updateData);
        $response->assertStatus(200)
                 ->assertJsonFragment(['message' => 'Event updated successfully.']);

        $this->assertDatabaseHas('events', ['id' => $event->id, 'name' => 'Updated Event Name']);
    }

    public function test_can_delete_event()
    {
        $event = Event::factory()->create();

        $response = $this->deleteJson("/api/events/{$event->id}");
        $response->assertStatus(200)
                 ->assertJsonFragment(['message' => 'Event deleted successfully.']);

        $this->assertDatabaseMissing('events', ['id' => $event->id]);
    }
}
