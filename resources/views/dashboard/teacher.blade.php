@extends('layouts.app')

@section('content')
    <section class="panel">
        <div class="panel-header">
            <div>
                <p class="eyebrow">Teacher</p>
                <h1>Welcome, {{ $teacher->full_name }}</h1>
            </div>
        </div>

        <div class="detail-grid">
            <article class="detail-card">
                <h2>Profile</h2>
                <dl class="detail-list">
                    <div><dt>Username</dt><dd>{{ $teacher->userAccount?->username }}</dd></div>
                    <div><dt>Email</dt><dd>{{ $teacher->email }}</dd></div>
                    <div><dt>Contact</dt><dd>{{ $teacher->contactno }}</dd></div>
                    <div><dt>Role</dt><dd>{{ ucfirst($teacher->userAccount?->role ?? 'teacher') }}</dd></div>
                </dl>
            </article>
        </div>
    </section>
@endsection
