@extends('layouts.master')

@section('title', 'Lecturer Details')

@section('content')
    <h1 class="mb-4">Lecturer Details</h1>

    @if ($lecturer->photo)
        <img
            src="{{ asset('storage/' . $lecturer->photo) }}"
            alt="Lecturer photo"
            width="150"
            class="mb-3"
        >
    @endif

    <p><strong>Name:</strong> {{ $lecturer->user->name }}</p>
    <p><strong>Email:</strong> {{ $lecturer->user->email }}</p>
    <p><strong>Employee number:</strong> {{ $lecturer->employee_number }}</p>
    <p><strong>Department:</strong> {{ $lecturer->department }}</p>
    <p><strong>Academic rank:</strong> {{ $lecturer->academic_rank }}</p>
    <p><strong>Office room:</strong> {{ $lecturer->office_room }}</p>
    <p><strong>Status:</strong> {{ $lecturer->is_active == '1' ? 'Active' : 'Inactive' }}</p>

    <h2 class="mt-4">Assigned courses</h2>

    @forelse ($lecturer->courses as $course)
        <p>{{ $course->course_code }} — {{ $course->title }}</p>
    @empty
        <p>No courses assigned.</p>
    @endforelse

    <a href="{{ route('lecturers.index') }}" class="btn btn-secondary">
        Back to lecturers
    </a>
@endsection