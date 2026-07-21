<?php

namespace App\Http\Controllers;

use App\Http\Resources\Booking\BookingResource;
use App\Models\Booking;
use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Symfony\Component\Clock\now;

class BookingController extends Controller
{
    public function index(Request $request) {
        $user = $request->user();

        $booking = Booking::where('user_id', $user->id)->get();
        $booking->load(['user', 'ticket']);

        return response()->json([
            'message' => 'success get all bookings',
            'data' => BookingResource::collection($booking)
        ], 200);
    }

    public function show(Booking $booking) {
        $this->authorize('view', $booking);
        $booking->load(['user', 'ticket']);

        return response()->json([
            'message' => 'success get booking',
            'data' => new BookingResource($booking)
        ], 200);
    }

    public function store(Request $request, Event $event, Ticket $ticket) {
        $user = $request->user();
        
        $checkAlready = Booking::where('user_id', $user->id)->where('ticket_id', $ticket->id)->first();
        if ($checkAlready) {
            return response()->json([
                'message' => 'reject, already booking'
            ], 400);
        }

        if ($event->is_active == false) {
            return response()->json([
                'message' => 'reject, event not ready'
            ], 400);
        }

        $booking = DB::transaction(function () use ($ticket, $user) {
            $ticket->lockForUpdate();

            if ($ticket->quota <= 0) {
                abort(400, 'reject, exhauted quota');
            }

            $booking = Booking::create([
                'user_id' => $user->id,
                'ticket_id' => $ticket->id,
                'status' => 'paid',
                'booked_at' => now()
            ]);
            
            $ticket->decrement('quota');

            return $booking;
        });

        $booking->load(['user', 'ticket']);
        
        return response()->json([
            'message' => 'booking success',
            'data' => new BookingResource($booking)
        ], 200);
    }

    public function adminIndex(Ticket $ticket) {
        $event = Event::where('id', $ticket->event_id)->first();
        $this->authorize('adminView', [Booking::class, $event]);
        $booking = Booking::where('ticket_id', $ticket->id)->get();

        return response()->json([
            'message' => 'all bookings',
            'data' => BookingResource::collection($booking)
        ], 200);
    }
}
