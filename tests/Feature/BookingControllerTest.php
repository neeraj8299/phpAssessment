<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Event;
use App\Models\Attendee;
use App\Models\Booking;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookingControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // Run the migrations before each test
        $this->artisan('migrate');
    }

    public function test_can_list_bookings()
    {
        $this->getJson('/api/bookings')
            ->assertStatus(200)
            ->assertJsonStructure(['success', 'message', 'data']);
    }

    public function test_can_store_a_booking()
    {
        $event = Event::factory()->create(['capacity' => 1]);
        $attendee = Attendee::factory()->create();

        $response = $this->postJson('/api/bookings', [
            'event_id' => $event->id,
            'attendee_id' => $attendee->id,
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Booking successful',
            ]);
    }

    public function test_booking_fails_when_capacity_is_full()
    {
        $event = Event::factory()->create(['capacity' => 1]);
        $attendee1 = Attendee::factory()->create();
        $attendee2 = Attendee::factory()->create();

        Booking::create([
            'event_id' => $event->id,
            'attendee_id' => $attendee1->id,
            'booked_at' => now(),
        ]);

        $response = $this->postJson('/api/bookings', [
            'event_id' => $event->id,
            'attendee_id' => $attendee2->id,
        ]);

        $response->assertStatus(422)
            ->assertJsonFragment(['event_id' => ['Event capacity full']]);
    }

    public function test_booking_fails_when_already_booked()
    {
        $event = Event::factory()->create(['capacity' => 2]);
        $attendee = Attendee::factory()->create();

        Booking::create([
            'event_id' => $event->id,
            'attendee_id' => $attendee->id,
            'booked_at' => now(),
        ]);

        $response = $this->postJson('/api/bookings', [
            'event_id' => $event->id,
            'attendee_id' => $attendee->id,
        ]);

        $response->assertStatus(422)
            ->assertJsonFragment(['attendee_id' => ['Attendee already booked for this event']]);
    }
}
