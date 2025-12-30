<?php

namespace App\Http\Controllers;

use App\Http\Requests\Ticket\TicketRequest;
use App\Http\Resources\Ticket\TicketResource;
use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index() {
        $tickets = Ticket::get();
        $tickets->load('event');

        return response()->json([
            'message' => 'success get all tickets',
            'data' => TicketResource::collection($tickets)
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

        return response()->json([
            'message' => 'ticket added',
            'data' => new TicketResource($ticket)
        ], 201);
    }

    public function update(TicketRequest $request, Ticket $ticket) {
        $event = Event::where('id', $ticket->event_id)->first();
        $this->authorize('update', [Ticket::class, $event]);
        $request->validated();

        $ticket->update($request->validated());

        return response()->json([
            'message' => 'event updated',
            'data' => new TicketResource($ticket)
        ], 200);
    }

    public function destroy(Ticket $ticket) {
        $event = Event::where('id', $ticket->event_id)->first();
        $this->authorize('delete', [Ticket::class, $event]);
        $ticket->delete();

        return response()->json([
            'message' => 'event deleted'
        ], 200);
    }
}
