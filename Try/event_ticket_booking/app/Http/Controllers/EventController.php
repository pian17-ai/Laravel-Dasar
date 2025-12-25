<?php

namespace App\Http\Controllers;

use App\Http\Requests\Event\StoreEventRequest;
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

    public function store(StoreEventRequest $request) {
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

    public function update(Request $request, Event $event) {
        $this->authorize('update', $event);
        $user = $request->user();

    }

    public function delete() {

    }
}
