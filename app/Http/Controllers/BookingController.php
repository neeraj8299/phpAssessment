<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponse;
use App\Services\BookingService;
use App\Http\Requests\StoreBookingRequest;

class BookingController extends Controller
{
    use ApiResponse;

    public function __construct(protected BookingService $bookingService)
    {
        //
    }

    public function index()
    {
        return $this->success($this->bookingService->getAllBookings());
    }

    public function store(StoreBookingRequest $request)
    {
        try {
            $booking = $this->bookingService->create($request->validated());
            return $this->success($booking, 'Booking successful');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return $this->error($e->getMessage(), $e->errors(), 422);
        }
    }
}
