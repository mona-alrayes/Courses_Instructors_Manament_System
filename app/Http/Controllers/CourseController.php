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
    public function index(): \Illuminate\Http\JsonResponse
    {
        $courses = Course::with(['instructors' => function($query) {
            $query->select('instructors.id', 'name');  // I specified id that belongs to instructors so it doesn't make config in query since both courses and instructors have id
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
        if(isset($request->instructor_id)) {
            $course->instructors()->sync($request->instructor_id);
        }
        $course->load('instructors');
        return self::success($course, 'Course created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course): \Illuminate\Http\JsonResponse
    {
        return self::success($course->load('instructors'), 'Course retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $course->update($data);
        if(isset($request->instructor_id)) {
            $course->instructors()->sync($request->instructor_id);
        }
        $course->load('instructors');
        return self::success($course, 'Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course): \Illuminate\Http\JsonResponse
    {
        $course->delete();
        return self::success( 'Course deleted successfully.');
    }
}
