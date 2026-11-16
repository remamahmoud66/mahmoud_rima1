@extends('layouts.master')

@section('title', 'Courses')

@section('content')
    <h1>Courses</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Code</th>
                <th>Title</th>
                <th>Credit Hours</th>
                <th>Semester</th>
                <th>Lecturer</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($courses as $course)
                <tr>
                    <td>{{ $course->course_code }}</td>
                    <td>{{ $course->title }}</td>
                    <td>{{ $course->credit_hours }}</td>
                    <td>{{ $course->semester }}</td>
                    <td>{{ $course->lecturer->user->name ?? 'No lecturer' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No courses found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection