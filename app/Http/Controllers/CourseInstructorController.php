<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorecourseInstructorRequest;
use App\Http\Requests\UpdatecourseInstructorRequest;
use App\Models\courseInstructor;

class CourseInstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorecourseInstructorRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(courseInstructor $courseInstructor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecourseInstructorRequest $request, courseInstructor $courseInstructor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(courseInstructor $courseInstructor)
    {
        //
    }
}
