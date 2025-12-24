<?php

namespace App\Http\Controllers;

use App\Http\Requests\Course\CourseRequest;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all(); //this double work, just write all() is correct

        return response()->json([
            'courses' => $courses
        ]);
    }

    public function show($id)
    {
        $course = Course::where('id', $id)->first();

        return response()->json([
            'course' => $course
        ]);
    }

    public function store(CourseRequest $request)
    {
        $user = $request->user();

        if ($user->role == 'student') {
            return response()->json([
                'messages' => 'you cant create course'
            ]);
        }

        $request->validated();

        $course = Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'created_by' => $user->id
        ]);

        return response()->json([
            'messages' => 'create course successfully',
            'course' => $course
        ], 201);
    }

    public function update(CourseRequest $request, $id) {
        $user = $request->user();

        $course = Course::where('id', $id)->where('created_by', $user->id)->first();

        if (!$course){
            return response()->json([
                'messages' => 'Course not found'
            ], 404);
        }
        
        $course->update($request->all());

        return response()->json([
            'messages' => 'course updated',
            'course' => $course
        ]);
    }

    public function delete(Request $request, $id) {
        $created_by = $request->user();

        $course = Course::where('id', $id)->where('created_by', $created_by->id)->first();

        if (!$course) {
            return response()->json([
                'messages' => 'you cant delete the course, because you not create the course'
            ]);
        }

        $course->delete();

        return response()->json([
            'messages' => 'course deleted'
        ]);
    }
}
