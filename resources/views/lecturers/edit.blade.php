@extends('layouts.master')

@section('title', 'Edit Lecturer')

@section('content')
    <h1 class="mb-4">Edit Lecturer</h1>

    @include('lecturers._form', ['lecturer' => $lecturer])
@endsection