<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'SSG Project') }}</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="app-shell">
    @php($sessionUser = session('user_account'))

    <header class="topbar">
        <div class="container topbar-inner">
            <a href="{{ route('dashboard') }}" class="brand">SSG Project</a>

            <nav class="nav-links">
                <a href="{{ route('dashboard') }}">Home</a>
                @if(($sessionUser['role'] ?? null) === 'admin')
                    <a href="{{ route('student.index') }}">Students</a>
                    <a href="{{ route('teacher.index') }}">Teachers</a>
                    <a href="{{ route('degree.index') }}">Degrees</a>
                @endif
            </nav>

            @if($sessionUser)
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            @endif
        </div>
    </header>

    <main class="container page-content">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                <ul class="error-list">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

</body>
</html>
