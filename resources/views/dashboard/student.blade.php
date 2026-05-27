@extends('layouts.app')

@section('content')
    <section class="panel">
        <div class="panel-header">
            <div>
                <p class="eyebrow">Student</p>
                <h1>Welcome, {{ $student->full_name }}</h1>
            </div>
        </div>

        <div class="detail-grid">
            <article class="detail-card">
                <h2>Profile</h2>
                <dl class="detail-list">
                    <div><dt>Username</dt><dd>{{ $student->userAccount?->username }}</dd></div>
                    <div><dt>Email</dt><dd>{{ $student->email }}</dd></div>
                    <div><dt>Contact</dt><dd>{{ $student->contactno }}</dd></div>
                    <div><dt>Degree</dt><dd>{{ $student->degree?->degree_title ?? 'Not assigned' }}</dd></div>
                </dl>
            </article>
        </div>
    </section>
@endsection
