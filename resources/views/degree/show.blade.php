@extends('layouts.app')

@section('content')
    <section class="panel narrow">
        <div class="panel-header">
            <div>
                <p class="eyebrow">Degree Record</p>
                <h1>{{ $degree->degree_title }}</h1>
            </div>
            <a href="{{ route('degree.edit', $degree) }}" class="btn">Edit</a>
        </div>

        <div class="detail-grid">
            <article class="detail-card">
                <dl class="detail-list">
                    <div><dt>Degree Title</dt><dd>{{ $degree->degree_title }}</dd></div>
                    <div><dt>Students Assigned</dt><dd>{{ $degree->students_count }}</dd></div>
                </dl>
            </article>
        </div>
    </section>
@endsection
