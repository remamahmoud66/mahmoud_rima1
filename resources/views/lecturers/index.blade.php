@extends('layouts.master')

@section('title', 'Lecturers')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Lecturers</h1>
        <a href="{{ route('lecturers.create') }}" class="btn btn-primary">
            Add Lecturer
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Full name</th>
                    <th>Email</th>
                    <th>Employee number</th>
                    <th>Department</th>
                    <th>Academic rank</th>
                    <th>Office room</th>
                    <th>Courses count</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($lecturers as $lecturer)
                    <tr>
                        <td>
                            @if ($lecturer->photo)
                                <img
                                    src="{{ asset('storage/' . $lecturer->photo) }}"
                                    alt="Lecturer photo"
                                    width="70"
                                >
                            @else
                                No photo
                            @endif
                        </td>
                        <td>{{ $lecturer->user->name }}</td>
                        <td>{{ $lecturer->user->email }}</td>
                        <td>{{ $lecturer->employee_number }}</td>
                        <td>{{ $lecturer->department }}</td>
                        <td>{{ $lecturer->academic_rank }}</td>
                        <td>{{ $lecturer->office_room }}</td>
                        <td>{{ $lecturer->courses_count }}</td>
                        <td>
                            <a href="{{ route('lecturers.show', $lecturer->id) }}"
                               class="btn btn-sm btn-info">View</a>

                            <a href="{{ route('lecturers.edit', $lecturer->id) }}"
                               class="btn btn-sm btn-warning">Edit</a>

                            <form
                                action="{{ route('lecturers.destroy', $lecturer->id) }}"
                                method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Delete this lecturer?')"
                            >
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" type="submit">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">No active lecturers found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection