<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAttendeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $attendeeId = $this->route('attendee')->id;

        return [
            'name' => 'sometimes|required|string',
            'email' => "sometimes|required|email|unique:attendees,email,{$attendeeId}",
            'phone' => 'nullable|string',
        ];
    }
}
