<?php

namespace App\Http\Controllers;

use App\Models\Attendee;
use App\Services\AttendeeService;
use App\Traits\ApiResponse;
use App\Http\Requests\StoreAttendeeRequest;
use App\Http\Requests\UpdateAttendeeRequest;

class AttendeeController extends Controller
{
    use ApiResponse;

    public function __construct(protected AttendeeService $attendeeService)
    {
    }

    public function index()
    {
        return $this->success($this->attendeeService->all());
    }

    public function store(StoreAttendeeRequest $request)
    {
        return $this->success($this->attendeeService->store($request->validated()));
    }

    public function show(Attendee $attendee)
    {
        return $this->success($this->attendeeService->show($attendee));
    }

    public function update(UpdateAttendeeRequest $request, Attendee $attendee)
    {
        return $this->success($this->attendeeService->update($request->validated(), $attendee), "Details Updated Successfully");
    }

    public function destroy(Attendee $attendee)
    {
        return $this->success($this->attendeeService->destroy($attendee), 'Attendee deleted');
    }
}
