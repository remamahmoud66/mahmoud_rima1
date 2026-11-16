<?php

namespace App\Http\Controllers;

use App\Models\Lecture;

class LectureController extends Controller
{
    public function index()
    {
        $lectures = Lecture::with('course')
            ->orderBy('scheduled_at')
            ->get();

        return view('lectures.index', compact('lectures'));
    }
}