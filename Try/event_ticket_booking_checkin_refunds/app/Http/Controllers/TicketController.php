<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index() {
        $tickets = Ticket::get();

        return response()->json([
            'message' => 'success get all tickets',
            'data' => $tickets
        ], 200);
    }

    public function show(Ticket $ticket) {
        return response()->json([
            'message' => 'success get ticket',
            'data' => $ticket
        ], 200);
    }

    public function store(Event $event, Request $request) {
        $request->validate([
            'name' => 'required',
            'price' => 'required|integer',
            'quota' => 'required|integer'
        ]);

        $ticket = Ticket::create([
            'event_id' => $event->id,
            'name' => $request->name,
            'price' => $request->price,
            'quota' => $request->quota
        ]);

        return response()->json([
            'message' => 'ticket added',
            'data' => $ticket
        ], 201);
    }

    public function update(Request $request, Ticket $ticket) {
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required|integer',
            'quota' => 'required|integer'
        ]);

        $ticket->update($validated);

        return response()->json([
            'message' => 'event updated',
            'data' => $ticket
        ], 200);
    }

    public function destroy(Ticket $ticket) {
        $ticket->delete();

        return response()->json([
            'message' => 'event deleted'
        ], 200);
    }
}
