@extends('layouts.master')

@section('title', 'Lectures')

@section('content')
    <h1>Lectures</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Course</th>
                <th>Title</th>
                <th>Topic Summary</th>
                <th>Hall</th>
                <th>Scheduled At</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($lectures as $lecture)
                <tr>
                    <td>{{ $lecture->course->title ?? 'No course' }}</td>
                    <td>{{ $lecture->title }}</td>
                    <td>{{ $lecture->topic_summary }}</td>
                    <td>{{ $lecture->hall_name }}</td>
                    <td>{{ $lecture->scheduled_at }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No lectures found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection