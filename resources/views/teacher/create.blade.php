@extends('layouts.app')

@section('content')
    <section class="panel">
        <div class="panel-header">
            <div>
                <p class="eyebrow">Admin Management</p>
                <h1>Create Teacher</h1>
            </div>
        </div>

        @include('teacher.partials.form', [
            'action' => route('teacher.store'),
            'teacher' => null,
            'buttonText' => 'Create Teacher'
        ])
    </section>
@endsection
