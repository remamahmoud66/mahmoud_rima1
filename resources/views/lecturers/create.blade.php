@extends('layouts.master')

@section('title', 'Create Lecturer')

@section('content')
    <h1 class="mb-4">Create Lecturer</h1>

    @include('lecturers._form', ['lecturer' => null])
@endsection