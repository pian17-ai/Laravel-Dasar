<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;

use function Symfony\Component\Clock\now;

class EnrollmentsController extends Controller
{
    public function store(Request $request) {
        $user = $request->user();

        $request->validate([
            'course_id' => 'required'
        ]);

        $alreadyEnrolled = Enrollment::where('user_id', $user->id)
            ->where('course_id', $request->course_id)
            ->exists();

        if ($alreadyEnrolled) {
            return response()->json([
                'messages' => 'you already enrolled this course'
            ], 409);
        }

        $enroll = Enrollment::create([
            'user_id' => $user->id,
            'course_id' => $request->course_id,
            'enrolled_at' => now()
        ]);

        return response()->json([
            'messages' => 'enrolled success',
            'enroll' => $enroll
        ], 201);
    }
}
