@extends('layouts.app')

@section('content')
    <section class="panel">
        <div class="panel-header">
            <div>
                <p class="eyebrow">Admin Management</p>
                <h1>Edit Student</h1>
            </div>
        </div>

        @include('student.partials.form', [
            'student' => $student,
            'buttonText' => 'Update Student',
            'submitUrl' => route('student.update', $student),
            'submitMethod' => 'PUT'
        ])
    </section>
@endsection
