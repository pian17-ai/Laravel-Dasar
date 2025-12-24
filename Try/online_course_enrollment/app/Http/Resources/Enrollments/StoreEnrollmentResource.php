<?php

namespace App\Http\Resources\Enrollments;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreEnrollmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'messages' => 'successfully enrolled',
            'data' => [
                'course' => Course::find($request->course_id)->title,
                'enrolled_at' => $this->enrolled_at
            ]
        ];
    }
}
