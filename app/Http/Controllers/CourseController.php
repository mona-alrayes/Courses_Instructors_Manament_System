<?php

namespace App\Http\Controllers;

use App\Http\Requests\courses\StoreCourseRequest;
use App\Http\Requests\courses\UpdateCourseRequest;
use App\Models\Course;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::with(['instructors' => function($query) {
            $query->select('id', 'name');
        }])->get();
        return self::success($courses, 'Courses retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request)
    {
        $data = $request->validated();
        $course=Course::create($data);
        $course->instructors()->sync('instructors');
        $course->load('instructors');
        return self::success($course, 'Course created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }
}
