@extends('layouts.app')

@section('content')
    <section class="panel">
        <div class="panel-header">
            <div>
                <p class="eyebrow">Admin Management</p>
                <h1>Students</h1>
            </div>
            <a href="{{ route('student.create') }}" class="btn">Add Student</a>
        </div>

        <div id="message"></div>

        <div id="studentsTableRegion" data-url="{{ route('student.index') }}">
            @include('student.partials.table', ['students' => $students])
        </div>
    </section>
@endsection
