<?php

namespace App\Http\Controllers;

use App\Http\Resources\CourseResource;
use App\Models\Course;
use Database\Seeders\CourseSeed;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index() {
        $courses = Course::all();

        return response()->json([
            'courses' => $courses
        ]);
    }

    public function show($id) {
        $course = Course::with('creator')->findOrFail($id);

        return response()->json([
            'course' => new CourseResource($course)
        ]);
    }

    public function store(Request $request) {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'messages' => 'Unauthorized'
            ]);
        }

        if ($user->role == 'student') {
            return response()->json([
                'messages' => 'you cant create course'
            ]);
        }

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required'
        ]);

        $course = Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'created_by' => $user->id
        ]);

        return response()->json([
            'messages' => 'course added',
            'course' => $course
        ], 201);
    }

    public function update(Request $request, $id) {
        $user = $request->user();

        if ($user->role == 'student') {
            return response()->json([
                'messages' => 'you cant update the course'
            ]);
        }

        $course = Course::where('id', $id)->first();

        if (!$course) {
            return response()->json([
                'messages' => 'course not found'
            ], 404);
        }

        $course->update($request->all());

        return response()->json([
            'messages' => 'course updated',
            'course' => $course
        ], 202);
    }

    public function delete(Request $request, $id) {
        $user = $request->user();

        if ($user->role == 'student') {
            return response()->json([
                'messages' => 'you cant delete the course'
            ]);
        }

        $course = Course::where('id', $id)->first();

        if (!$course) {
            return response()->json([
                'messages' => 'courses not found'
            ]);
        }

        $course->delete();

        return response()->json([
            'messages' => 'course deleted'
        ]);
    }
}
