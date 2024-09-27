<?php

namespace App\Http\Controllers;

use App\Http\Requests\instructors\StoreInstructorRequest;
use App\Http\Requests\instructors\UpdateInstructorRequest;
use App\Models\Instructor;

class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $instructors = Instructor::all();
        return self::success($instructors , 'instructors retrieved successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInstructorRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $instructor = Instructor::create($data);
        return self::success($instructor, 'instructor created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Instructor $instructor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInstructorRequest $request, Instructor $instructor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Instructor $instructor)
    {
        //
    }
}
