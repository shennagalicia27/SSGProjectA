@extends('layouts.app')

@section('content')
    <section class="panel narrow">
        <div class="panel-header">
            <div>
                <p class="eyebrow">Admin Management</p>
                <h1>Edit Degree</h1>
            </div>
        </div>

        @include('degree.partials.form', [
            'action' => route('degree.update', $degree),
            'degree' => $degree,
            'buttonText' => 'Update Degree'
        ])
    </section>
@endsection
