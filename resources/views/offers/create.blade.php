@extends('app')

@section('content')
    <h2>Create Offer</h2>

    {!! Form::model(new App\Models\Offer, ['route' => ['offers.store']]) !!}
    @include('offers/_form', ['submit_text' => 'Create Offer'])
    {!! Form::close() !!}

@endsection