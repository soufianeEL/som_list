@extends('app')

@section('content')
    <h2>Edit Affiliate</h2>

    {!! Form::model($affiliate, ['method' => 'PATCH', 'route' => ['affiliates.update', $affiliate->id]]) !!}
    @include('affiliates/_form', ['submit_text' => 'Edit Affiliate'])
    {!! Form::close() !!}
@endsection