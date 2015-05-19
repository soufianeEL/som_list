@extends('app')

@section('content')
    <h2>Edit Subject</h2>

    {!! Form::model($subject, ['method' => 'PATCH', 'route' => ['offers.subjects.update', $offer->id, $subject->id]]) !!}
    @include('subjects/_form', ['submit_text' => 'Edit Subject'])
    {!! Form::close() !!}

@endsection