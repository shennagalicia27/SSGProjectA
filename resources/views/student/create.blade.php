@extends('layouts.app')

@section('content')
    <section class="panel">
        <div class="panel-header">
            <div>
                <p class="eyebrow">Admin Management</p>
                <h1>Create Student</h1>
            </div>
        </div>

        @include('student.partials.form', [
            'student' => null,
            'buttonText' => 'Create Student',
            'submitUrl' => route('student.store'),
            'submitMethod' => 'POST'
        ])
    </section>
@endsection
