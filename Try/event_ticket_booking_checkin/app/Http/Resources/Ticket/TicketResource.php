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
            'event' => $this->event->title,
            'ticket' => [
                'id' => $this->id, // 'id'? aowkawoakwokwwakwow
                'name' => $this->name,
                'price' => $this->price,
                'quota' => $this->quota
            ]
        ];
    }
}
