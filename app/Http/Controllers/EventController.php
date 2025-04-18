<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class EventController extends Controller
{
    use ApiResponse;

    public function index()
    {
        return Event::paginate(10); // Supports bonus: pagination
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'country' => 'required|string',
            'capacity' => 'required|integer|min:1',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        $event = Event::create($validated);
        return $this->success($event, 'Event created successfully.');
    }

    public function show(Event $event)
    {
        return $event;
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string',
            'description' => 'nullable|string',
            'country' => 'sometimes|required|string',
            'capacity' => 'sometimes|required|integer|min:1',
            'start_time' => 'sometimes|required|date',
            'end_time' => 'sometimes|required|date|after:start_time',
        ]);

        $event->update($validated);
        return $this->success($event, 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return $this->success($event, 'Event deleted successfully.');
    }
}

