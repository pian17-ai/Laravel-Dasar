<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Checkin;
use Illuminate\Http\Request;

use function Symfony\Component\Clock\now;

class CheckinController extends Controller
{
    public function store(Booking $booking) {
        $this->authorize('create', [Checkin::class, $booking]);

        if ($booking->status == 'checked_in') {
            return response()->json([
                'message' => 'chekin already'
            ], 200);
        }

        Checkin::create([
            'booking_id' => $booking->id,
            'checked_in_at' => now()
        ]);

        $booking->update([
            'status' => 'checked_in'
        ]);

        return response()->json([
            'message' => 'checkin done'
        ], 200);
    }
}
