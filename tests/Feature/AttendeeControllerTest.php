<?php

namespace Tests\Feature;

use App\Models\Attendee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AttendeeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // Run the migrations before each test
        $this->artisan('migrate');
    }

    public function test_can_list_attendees()
    {
        Attendee::factory()->count(3)->create();

        $response = $this->getJson('/api/attendees');

        $response->assertOk()
            ->assertJsonStructure(['success', 'data']);
    }

    public function test_can_create_attendee()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '1234567890',
        ];

        $response = $this->postJson('/api/attendees', $data);

        $response->assertOk()
            ->assertJsonFragment(['email' => 'john@example.com']);
    }

    public function test_can_show_attendee()
    {
        $attendee = Attendee::factory()->create();

        $response = $this->getJson("/api/attendees/{$attendee->id}");

        $response->assertOk()
            ->assertJsonFragment(['id' => $attendee->id]);
    }

    public function test_can_update_attendee()
    {
        $attendee = Attendee::factory()->create();

        $response = $this->putJson("/api/attendees/{$attendee->id}", [
            'name' => 'Updated Name',
        ]);

        $response->assertOk()
            ->assertJsonFragment(['name' => 'Updated Name']);
    }

    public function test_can_delete_attendee()
    {
        $attendee = Attendee::factory()->create();

        $response = $this->deleteJson("/api/attendees/{$attendee->id}");

        $response->assertOk()
            ->assertJsonFragment(['message' => 'Attendee deleted']);
    }
}
