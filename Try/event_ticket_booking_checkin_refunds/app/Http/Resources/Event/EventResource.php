<?php

namespace App\Http\Resources\Event;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'event' => [
                'id' => $this->id,
                'title' => $this->title,
                'start_time' => $this->start_time,
                'end_time' => $this->end_time,
                'is_active' => $this->is_active,
                'creator' => [
                    'id' => $this->creator->id,
                    'name' => $this->creator->name,
                    'email' => $this->creator->email,
                    'role' => $this->creator->role
                ]
            ]
        ];
    }
}
