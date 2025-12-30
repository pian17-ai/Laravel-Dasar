<?php

namespace App\Http\Controllers;

use App\Http\Requests\Event\StoreEventRequest;
use App\Http\Requests\Event\UpdateEventRequest;
use App\Http\Resources\Event\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index() {
        $events = Event::get();
        $events->load('creator');

        return response()->json([
            'message' => 'success get all events',
            'data' => EventResource::collection($events)
        ], 200);
    }

    public function show(Event $event) {
        return response()->json([
            'message' => 'success get event',
            'data' => new EventResource($event)
        ], 200);
    }

    public function store(StoreEventRequest $request) {
        $user = $request->user();
        $request->validated();

        $event = Event::create([
            'title' => $request->title,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'created_by' => $user->id
        ]);

        return response()->json([
            'message' => 'event added',
            'data' => new EventResource($event)
        ], 201);
    }

    public function update(UpdateEventRequest $request, Event $event) {
        $this->authorize('update', $event);
        $request->user();
        $request->validated;

        $event->update($request->validated());

        return response()->json([
            'message' => 'event updated',
            'data' => new EventResource($event)
        ], 200);
    }

    public function destroy(Event $event) {
        $this->authorize('delete', $event);
        $event->delete();

        return response()->json([
            'message' => 'event deleted'
        ], 200);
    }
}
