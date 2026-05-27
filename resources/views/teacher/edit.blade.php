@extends('layouts.app')

@section('content')
    <section class="panel">
        <div class="panel-header">
            <div>
                <p class="eyebrow">Admin Management</p>
                <h1>Edit Teacher</h1>
            </div>
        </div>

        @include('teacher.partials.form', [
            'action' => route('teacher.update', $teacher),
            'teacher' => $teacher,
            'buttonText' => 'Update Teacher'
        ])
    </section>
@endsection
