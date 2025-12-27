<?php

namespace App\Http\Controllers;

use App\Http\Requests\Event\StoreEventRequest;
use App\Http\Requests\Event\UpdateEventRequest;
use App\Models\Event;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();

        return response()->json([
            'message' => 'success get all data',
            'data' => $events
        ], 200);
    }

    public function show(Event $event)
    {
        return response()->json([
            'message' => 'success get data',
            'data' => $event
        ], 200);
    }

    public function store(StoreEventRequest $request)
    {
        $request->validated();
        $user = $request->user();

        $event = Event::create([
            'title' => $request->title,
            'location' => $request->location,
            'event_date' => $request->event_date,
            'price' => $request->price,
            'created_by' => $user->id,
        ]);

        return response()->json([
            'message' => 'event added',
            'data' => $event
        ], 201);
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        $validated = $request->validated();

        $event->update($validated);

        return response()->json([
            'message' => 'event updated'
        ], 200);
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return response()->json([
            'message' => 'event deleted'
        ], 200);
    }
}
