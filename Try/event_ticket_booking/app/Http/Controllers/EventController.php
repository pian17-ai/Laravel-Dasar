<?php

namespace App\Http\Controllers;

use App\Http\Requests\Event\EventRequest;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index() {
        $events = Event::all();

        return response()->json([
            'data' => $events
        ], 200);
    }

    public function show($id) {
        $event = Event::where('id', $id)->first();

        if (!$event) {
            return response()->json([
                'messages' => 'event not found'
            ], 404);
        }

        return response()->json([
            'data' => $event
        ], 200);
    }

    public function store(EventRequest $request) {
        $request->validated();
        $user = $request->user();
        
        $data = Event::create([
            'title' => $request->title,
            'location' => $request->location,
            'event_date' => $request->event_date,
            'price' => $request->price,
            'created_by' => $user->id
        ]);

        return response()->json([
            'message' => 'event added',
            'data' => $data
        ], 201);
    }

    public function update(EventRequest $request, Event $event) {
        $this->authorize('update', $event);
        $request->validated();
        //$event = Event::where('id', $event->id)->first(); (no need, because the Model Event give permission)

        $event->update($request->all());

        return response()->json([
            'message' => 'event updated',
            'data' => $event
        ], 200);
    }

    public function destroy(Event $event) {
        $this->authorize('delete', $event);
        
        $event->delete(); // If you use Event $event -> Event::where('id', $id)

        return response()->json([
            'message' => 'event deleted'
        ], 200);
    }
}
