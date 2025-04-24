<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Event;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;

class BookingService
{
    public function getAllBookings()
    {
        return Booking::with(['event', 'attendee'])->get();
    }

    public function create(array $data)
    {
        $event = Event::find($data['event_id']);

        if (Booking::where('event_id', $data['event_id'])->where('attendee_id', $data['attendee_id'])->exists()) {
            throw ValidationException::withMessages(['attendee_id' => 'Attendee already booked for this event']);
        }

        $bookedCount = Booking::where('event_id', $data['event_id'])->count();
        if ($bookedCount >= $event->capacity) {
            throw ValidationException::withMessages(['event_id' => 'Event capacity full']);
        }

        return Booking::create([
            'event_id' => $data['event_id'],
            'attendee_id' => $data['attendee_id'],
            'booked_at' => Carbon::now(),
        ]);
    }
}
