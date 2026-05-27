<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="auth-page">
    <div class="auth-card">
        <div>
            <p class="eyebrow">Student, Teacher, and Admin Portal</p>
            <h1>Sign in</h1>
            <p class="muted">Use your assigned username and password to continue.</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
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

        <form method="POST" action="{{ route('login.attempt') }}" class="form-grid">
            @csrf
            <div>
                <label for="username">Username</label>
                <input id="username" name="username" type="text" value="{{ old('username') }}" required>
            </div>
            <div>
                <label for="password">Password</label>
                <input id="password" name="password" type="password" required>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
    </div>
</body>
</html>
