@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
    <h1 class="mb-4">Dashboard</h1>

    <div class="row g-3">
        <div class="col-md-3">
            <div class="card p-3">
                <h5>Total Lecturers</h5>
                <h2>{{ $lecturersCount }}</h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-3">
                <h5>Total Courses</h5>
                <h2>{{ $coursesCount }}</h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-3">
                <h5>Total Lectures</h5>
                <h2>{{ $lecturesCount }}</h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-3">
                <h5>Active Student Enrollments</h5>
                <h2>{{ $enrollmentsCount }}</h2>
            </div>
        </div>
    </div>
@endsection