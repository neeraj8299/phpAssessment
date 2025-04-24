<?php

namespace App\Http\Controllers;

use App\Http\Requests\Event\StoreRequest;
use App\Http\Requests\Event\UpdateRequest;
use App\Models\Event;
use App\Services\EventService;
use App\Traits\ApiResponse;

class EventController extends Controller
{
    use ApiResponse;

    public function __construct(protected EventService $eventService)
    {
    }

    public function index()
    {
        return $this->eventService->listEvents();
    }

    public function store(StoreRequest $request)
    {
        $event = $this->eventService->createEvent($request->validated());
        return $this->success($event, 'Event created successfully.');
    }

    public function show(Event $event)
    {
        return $this->eventService->getEvent($event);
    }

    public function update(UpdateRequest $request, Event $event)
    {
        $event = $this->eventService->updateEvent($event, $request->validated());
        return $this->success($event, 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        $this->eventService->deleteEvent($event);
        return $this->success($event, 'Event deleted successfully.');
    }
}
