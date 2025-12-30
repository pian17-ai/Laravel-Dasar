<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CheckinController extends Controller
{
    public function store(Request $request, Booking $booking)
    {
        $today = Carbon::today();
        $event = $booking->ticket->event;

        if (
            $today->lt(Carbon::parse($event->start_time)->startOfDay()) ||
            $today->gt(Carbon::parse($event->end_time)->startOfDay())
        ) {
            return response()->json([
                'message' => 'checkin only allowed on event data'
            ], 422);
        }

        if ($booking->status != 'paid') {
            return response()->json([
                'message' => 'reject'
            ]);
        }
    }
}
