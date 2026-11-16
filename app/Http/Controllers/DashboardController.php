<?php

namespace App\Http\Controllers;

use App\Models\Lecturers;
use App\Models\courses as Course;
use App\Models\Lecture;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $lecturersCount = Lecturers::count();
        $coursesCount = Course::count();
        $lecturesCount = Lecture::count();
        $enrollmentsCount = DB::table('course_user')
        ->where('is_active', true)
        ->count();
        return view('home_page', compact(
            'lecturersCount',
            'coursesCount',
            'lecturesCount',
            'enrollmentsCount'
        ));
    }
}