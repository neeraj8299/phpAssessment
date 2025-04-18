<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    use ApiResponse;

    public function index()
    {
        return $this->success(Booking::with(['event', 'attendee'])->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'attendee_id' => 'required|exists:attendees,id',
        ]);

        $event = Event::find($validated['event_id']);

        if (Booking::where('event_id', $validated['event_id'])->where('attendee_id', $validated['attendee_id'])->exists()) {
            return $this->error('Attendee already booked for this event', [], 409);
        }

        $bookedCount = Booking::where('event_id', $validated['event_id'])->count();
        if ($bookedCount >= $event->capacity) {
            return $this->error('Event capacity full', [], 403);
        }

        $booking = Booking::create([
            'event_id' => $validated['event_id'],
            'attendee_id' => $validated['attendee_id'],
            'booked_at' => now(),
        ]);

        return $this->success($booking, 'Booking successful');
    }
}

