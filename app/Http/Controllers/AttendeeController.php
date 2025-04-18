<?php

namespace App\Http\Controllers;

use App\Models\Attendee;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class AttendeeController extends Controller
{
    use ApiResponse;

    public function index()
    {
        return $this->success(Attendee::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:attendees,email',
            'phone' => 'nullable|string',
        ]);

        return $this->success(Attendee::create($validated));
    }

    public function show(Attendee $attendee)
    {
        return $this->success($attendee);
    }

    public function update(Request $request, Attendee $attendee)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string',
            'email' => 'sometimes|required|email|unique:attendees,email,' . $attendee->id,
            'phone' => 'nullable|string',
        ]);

        $attendee->update($validated);
        return $this->success($attendee, "Details Updated Successfully");
    }

    public function destroy(Attendee $attendee)
    {
        $attendee->delete();
        return $this->success($attendee, 'Attendee deleted');
    }
}

