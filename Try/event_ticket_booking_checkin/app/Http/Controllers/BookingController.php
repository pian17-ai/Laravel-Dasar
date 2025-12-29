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
    public function index(Request $request)
    {
        $user = $request->user();

        $bookings = Booking::where('user_id', $user->id)->get();

        $bookings->load('user');
        $bookings->load('ticket');
        return response()->json([
            'message' => 'success get all bookings',
            'data' => BookingResource::collection($bookings)
        ], 200);
    }

    public function show(Booking $booking)
    {
        $this->authorize('view', $booking);
        $booking->load('user');
        $booking->load('ticket');

        return response()->json([
            'message' => 'success get booking',
            'data' => new BookingResource($booking)
        ], 200);
    }

    public function store(Request $request, Ticket $ticket)
    {
        $user = $request->user();
        $checkAlreadyBook = Booking::where('user_id', $user->id)->where('ticket_id', $ticket->id)->first();

        if ($checkAlreadyBook) {
            return response()->json([
                'message' => 'booked already'
            ], 409);
        }

        $booking = DB::transaction(function () use ($ticket, $user) {
            $ticket->lockForUpdate(); // LKSN Concept

            if ($ticket->quota <= 0) {
                abort(400, 'quota exhausted');
            }

            $booking = Booking::create([
                'user_id' => $user->id,
                'ticket_id' => $ticket->id,
                'status' => 'booked',
                'booked_at' => now()
            ]);

            $ticket->decrement('quota');

            return $booking;
        });

        $booking->load(['user', 'ticket']);


        return response()->json([
            'message' => 'book added',
            'data' => new BookingResource($booking)
        ], 200);
    }

    public function destroy(Booking $booking)
    {
        $this->authorize('delete', $booking);
        $booking->delete();

        return response()->json([
            'message' => 'book deleted'
        ]);
    }

    public function indexAdmin(Ticket $ticket)
    {
        $event = Event::where('id', $ticket->event_id)->first();
        $this->authorize('viewAny', [Booking::class, $event]);
        $bookings = Booking::where('ticket_id', $ticket->id)->get();

        return response()->json([
            'message' => 'success get booking',
            'data' => BookingResource::collection($bookings)
        ], 200);
    }
}
