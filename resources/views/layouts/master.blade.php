<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Academic Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark px-3">
        <a class="navbar-brand" href="{{ route('dashboard') }}">Academic Dashboard</a>

        <div class="text-white">
            {{ auth()->user()->name }}

            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button class="btn btn-outline-light btn-sm ms-2" type="submit">
                    Logout
                </button>
            </form>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <aside class="col-md-2 bg-light min-vh-100 p-3">
                <nav class="nav flex-column">
                    <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>

                    @if (auth()->user()->role === 'admin')
                        <a class="nav-link" href="{{ route('lecturers.index') }}">Lecturers</a>
                    @endif

                    <a class="nav-link" href="{{ route('courses.index') }}">Courses</a>
                    <a class="nav-link" href="{{ route('lectures.index') }}">Lectures</a>
                </nav>
            </aside>

            <main class="col-md-10 p-4">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>