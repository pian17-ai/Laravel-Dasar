<?php

namespace App\Http\Controllers;

use App\Http\Requests\Ticket\TicketRequest;
use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function store(TicketRequest $request, Event $event) {
        $this->authorize('create', [Ticket::class, $event]);
        $request->validated();

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

    public function update(TicketRequest $request, Ticket $ticket) {
        $this->authorize('update', $ticket);
        $validated = $request->validated();
        
        $ticket->update($validated);
        
        return response()->json([
            'message' => 'event updated'
        ], 200);
    }
    
    public function destroy(Ticket $ticket) {
        $this->authorize('update', $ticket);
        $ticket->delete();

        return response()->json([
            'message' => 'ticket deleted'
        ], 200);
    }
}
