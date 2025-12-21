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

    public function update(Request $request) {
        $course = Course::where('id', $request->id)->first();

        if (!$course) {
            return response()->json([
                'messages' => 'course not found'
            ], 404);
        }

        $course = Course::update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price
        ]);

        return response()->json([
            'messages' => 'course updated',
            'course' => $course
        ], 202);
    }

    public function delete(Request $request) {
        Course::delete($request->id);

        return response()->json([
            'messages' => 'course deleted'
        ]);
    }
}
