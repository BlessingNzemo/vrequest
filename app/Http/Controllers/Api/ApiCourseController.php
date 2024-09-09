<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class ApiCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function statusCourse(Request $request)
    {
        $request->validate([
            "course_id" => ["required", "int"],
            "started_at" => ["nullable","min:1"],
            "ended_at" => ["nullable","min:1"]
        ]);

        $course = Course::findOrFail($request->input('course_id'));

        if (($course->started_at == null ) && ($course->ended_at == null) && (!empty($request->input('started_at')))) {
            $course->started_at = now();
            $course->status = 'en_cours';
            $message = '';
        }else if (($course->ended_at == null ) && ($course->started_at != null) && !empty($request->input('ended_at'))) {
            $course->ended_at = now();
            $course->status = 'terminer';
            $message = '';
        }else{
            return response()->json([
                'course' => $course,
                'message' => '',
            ], 500);
        }

        $course->update();
        return response()->json([
            'course' => $course,
            'message' => $message,
        ], 200);
    }
}
