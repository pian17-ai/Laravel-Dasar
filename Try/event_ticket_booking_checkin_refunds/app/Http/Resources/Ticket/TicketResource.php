<?php

namespace App\Http\Resources\Ticket;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'ticket' => [
                'id' => $this->id,
                'name' => $this->name,
                'price' => $this->price,
                'quota' => $this->quota,
                'event' => [
                    'id' => $this->event->id,
                    'title' => $this->event->title,
                    'start_time' => $this->event->start_time,
                    'end_time' => $this->event->end_time,
                    'is_active' => $this->event->is_active
                ]
            ]
        ];
    }
}
