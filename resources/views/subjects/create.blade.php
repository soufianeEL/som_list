@extends('app')

@section('content')
    <h2>Create Subject for offer "{{ $offer->name }}"</h2>

    {!! Form::model(new App\Models\Subject, ['route' => ['offers.subjects.store', $offer]]) !!}
    @include('subjects/_form', ['submit_text' => 'Create Subject'])
    {!! Form::close() !!}

@endsection