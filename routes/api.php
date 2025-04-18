<?php

use App\Http\Controllers\AttendeeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

Route::apiResource('events', EventController::class);
Route::apiResource('attendees', AttendeeController::class);
Route::get('bookings', [BookingController::class, 'index']);
Route::post('bookings', [BookingController::class, 'store']);
