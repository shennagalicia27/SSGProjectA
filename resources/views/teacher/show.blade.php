@extends('layouts.app')

@section('content')
    <section class="panel">
        <div class="panel-header">
            <div>
                <p class="eyebrow">Teacher Record</p>
                <h1>{{ $teacher->full_name }}</h1>
            </div>
            <a href="{{ route('teacher.edit', $teacher) }}" class="btn">Edit</a>
        </div>

        <div class="detail-grid">
            <article class="detail-card">
                <dl class="detail-list">
                    <div><dt>Email</dt><dd>{{ $teacher->email }}</dd></div>
                    <div><dt>Username</dt><dd>{{ $teacher->userAccount?->username }}</dd></div>
                    <div><dt>Contact</dt><dd>{{ $teacher->contactno }}</dd></div>
                    <div><dt>Role</dt><dd>{{ ucfirst($teacher->userAccount?->role ?? 'teacher') }}</dd></div>
                </dl>
            </article>
        </div>
    </section>
@endsection
