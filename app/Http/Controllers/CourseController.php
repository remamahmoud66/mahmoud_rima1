<?php

namespace App\Http\Controllers;

use App\Models\courses as Course;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('lecturer.user')->get();

        return view('courses.index', compact('courses'));
    }
}