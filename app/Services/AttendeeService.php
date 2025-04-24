<?php

namespace App\Services;

use App\Models\Attendee;
use Illuminate\Http\Request;

class AttendeeService
{
    public function all()
    {
        return Attendee::all();
    }

    public function store(array $data)
    {
        return Attendee::create($data);
    }

    public function show(Attendee $attendee)
    {
        return $attendee;
    }

    public function update(array $data, Attendee $attendee)
    {
        $attendee->update($data);
        return $attendee;
    }

    public function destroy(Attendee $attendee)
    {
        $attendee->delete();
        return $attendee;
    }
}
