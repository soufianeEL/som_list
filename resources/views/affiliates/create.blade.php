@extends('app')

@section('content')
    <h2>Create Affiliate</h2>

    {!! Form::model(new App\Models\Affiliate, ['route' => ['affiliates.store']]) !!}
    @include('affiliates/_form', ['submit_text' => 'Create Affiliate'])
    {!! Form::close() !!}

@endsection