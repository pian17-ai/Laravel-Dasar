<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

use function Symfony\Component\Clock\now;

class BookingController extends Controller
{
    public function index(Request $request) {
        $user = $request->user();

        $data = Booking::where('user_id', $user->id)->get();

        return response()->json([
            'message' => 'success get booking',
            'data' => $data
        ], 200);
    }

    public function store(Request $request) {
        $user = $request->user();

        $request->validate([
            'event_id' => 'required|exists:events,id'
        ]);

        $checkAlready = Booking::where('user_id', $user->id)->where('event_id', $request->event_id)->first();

        if ($checkAlready) {
            return response()->json([
                'message' => 'may not book the same event'
            ], 409);
        }

        $data = Booking::create([
            'user_id' => $user->id,
            'event_id' => $request->event_id,
            'booked_at' => now()
        ]);

        return response()->json([
            'message' => 'event booked',
            'data' => $data
        ], 201);
    }
}
