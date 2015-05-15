@extends('app')

@section('content')
    <h2>Create Creative for offer "{{ $offer->name }} </h2>

    {!! Form::model(new App\Models\Creative, ['route' => ['offers.creatives.store', $offer]]) !!}
    @include('creatives/_form', ['submit_text' => 'Create Creative', 'files' => true])
    {!! Form::close() !!}

@endsection