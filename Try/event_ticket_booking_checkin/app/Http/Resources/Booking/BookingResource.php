<?php

namespace App\Http\Resources\Booking;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'user' => [
                'email' => $this->user->email,
                'name' => $this->user->name
            ],
            'ticket' => [
                'name' => $this->ticket->name
            ]
        ];
    }
}
