@extends('layouts.app')

@section('content')
    <section class="panel narrow">
        <div class="panel-header">
            <div>
                <p class="eyebrow">Admin Management</p>
                <h1>Create Degree</h1>
            </div>
        </div>

        @include('degree.partials.form', [
            'action' => route('degree.store'),
            'degree' => null,
            'buttonText' => 'Create Degree'
        ])
    </section>
@endsection
