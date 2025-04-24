<?php

namespace App\Services;

use App\Models\Event;

class EventService
{
    public function listEvents()
    {
        return Event::paginate(10);
    }

    public function createEvent(array $data): Event
    {
        return Event::create($data);
    }

    public function updateEvent(Event $event, array $data): Event
    {
        $event->update($data);
        return $event;
    }

    public function deleteEvent(Event $event): bool
    {
        return $event->delete();
    }

    public function getEvent(Event $event): Event
    {
        return $event;
    }
}
