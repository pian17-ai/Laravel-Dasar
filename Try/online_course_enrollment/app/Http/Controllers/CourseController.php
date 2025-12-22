<?php

namespace App\Http\Controllers;

use App\Http\Requests\Course\StoreCourseRequest;
use App\Http\Requests\Course\StoreRequest;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index() {
        $courses = Course::get()->all();

        return response()->json([
            'courses' => $courses
        ]);
    }

    public function show($id) {
        $course = Course::where('id', $id)->first();

        return response()->json([
            'course' => $course
        ]);
    }

    public function store(StoreCourseRequest $request) {
        $user = $request->user();

        if ($user->role == 'student') {
            return response()->json([
                'messages' => 'you cant create course'
            ]);
        }

        $validated = $request->validated();

        $course = Course::create([
            $validated,
            'created_by' => $user->id
        ]);

        return response()->json([
            'messages' => 'create course successfully',
            'course' => $course
        ], 201);
    }

    public function update() {

    }

    public function delete() {

    }
}
