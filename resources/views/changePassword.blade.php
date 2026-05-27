@extends('layouts.app')

@section('content')
    <section class="panel narrow">
        <div class="panel-header">
            <div>
                <p class="eyebrow">Password Update</p>
                <h1>Change password</h1>
            </div>
        </div>

        <form method="POST" action="{{ route('password.change.update') }}" class="form-grid">
            @csrf
            <div>
                <label for="current_password">Current Password</label>
                <input id="current_password" name="current_password" type="password" required>
            </div>
            <div>
                <label for="password">New Password</label>
                <input id="password" name="password" type="password" required>
            </div>
            <div>
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required>
            </div>
            <button type="submit" class="btn">Update Password</button>
        </form>
    </section>
@endsection
