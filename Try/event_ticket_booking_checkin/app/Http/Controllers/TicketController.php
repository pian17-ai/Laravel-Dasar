<?php

namespace App\Http\Controllers;

use App\Http\Requests\Ticket\TicketRequest;
use App\Http\Resources\Ticket\TicketResource;
use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(Event $event) {
        $ticket = Ticket::where('event_id', $event->id)->get();

        $ticket->load('event');
        return response()->json([
            'message' => 'success get all tickets',
            'data' => TicketResource::collection($ticket)
        ], 200);
    }

    public function show(Ticket $ticket) {
        return response()->json([
            'message' => 'success get ticket',
            'data' => new TicketResource($ticket)
        ], 200);
    }

    public function store(TicketRequest $request, Event $event) {
        $this->authorize('create', [Ticket::class, $event]);
        $request->validated();

        $ticket = Ticket::create([
            'event_id' => $event->id,
            'name' => $request->name,
            'price' => $request->price,
            'quota' => $request->quota
        ]);

        $ticket->load('event');
        return response()->json([
            'message' => 'ticket added',
            'data' => new TicketResource($ticket)
        ], 200);
    }

    public function update(TicketRequest $request, Ticket $ticket) {
        $this->authorize('update', $ticket);
        $validated = $request->validated();
        
        $ticket->update($validated);

        $ticket->load('event');
        return response()->json([
            'message' => 'ticket updated',
            'data' => new TicketResource($ticket)
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
