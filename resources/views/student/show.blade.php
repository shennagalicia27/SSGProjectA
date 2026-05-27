@extends('layouts.app')

@section('content')
    <section class="panel">
        <div class="panel-header">
            <div>
                <p class="eyebrow">Student Record</p>
                <h1>{{ $student->full_name }}</h1>
            </div>
            <a href="{{ route('student.edit', $student) }}" class="btn">Edit</a>
        </div>

        <div class="detail-grid">
            <article class="detail-card">
                <dl class="detail-list">
                    <div><dt>Email</dt><dd>{{ $student->email }}</dd></div>
                    <div><dt>Username</dt><dd>{{ $student->userAccount?->username }}</dd></div>
                    <div><dt>Degree</dt><dd>{{ $student->degree?->degree_title ?? 'Not assigned' }}</dd></div>
                    <div><dt>Contact</dt><dd>{{ $student->contactno }}</dd></div>
                </dl>
            </article>
        </div>
    </section>
@endsection
