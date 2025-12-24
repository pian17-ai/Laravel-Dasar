<?php

namespace App\Http\Controllers;

use App\Http\Resources\Enrollments\ShowEnrollmentResource;
use App\Http\Resources\Enrollments\StoreEnrollmentResource;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;
use function Symfony\Component\Clock\now;

class EnrollmentController extends Controller
{
    public function show(Request $request) {
        $user = $request->user();

        $enrollments = Enrollment::where('user_id', $user->id)->get();

        if ($enrollments->isEmpty()) {
            return response()->json([
                'messages' => 'your course is null'
            ], 200);
        }

        $enrollments->load('course');

        return ShowEnrollmentResource::collection($enrollments);
    }

    public function store(Request $request) {
        $student = $request->user();

        $request->validate([
            'course_id' => 'required'
        ]);

        $course = Course::find($request->course_id);
        $enroll = Enrollment::where('course_id', $request->course_id)->where('user_id', $student->id)->first();

        if ($course == null) {
            return response()->json([
                'messages' => 'course not found'
            ], 404);
        }

        if ($enroll) {
            return response()->json([
                'messages' => 'you done enroll this course'
            ]);
        }

        $enrollment = Enrollment::create([
            'user_id' => $student->id,
            'course_id' => $request->course_id,
            'enrolled_at' => now()->format('Y-m-d')
        ]);

        $enrollment->load('course');

        return new StoreEnrollmentResource($enrollment);
    }
}
