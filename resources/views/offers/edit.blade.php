@extends('app')

@section('content')
    <h2>Edit Offer</h2>

    {!! Form::model($offer, ['method' => 'PATCH', 'route' => ['offers.update', $offer->id]]) !!}
    @include('offers/_form', ['submit_text' => 'Edit Offer'])
    {!! Form::close() !!}
@endsection