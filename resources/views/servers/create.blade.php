@extends('app')

@section('content')
    <h2>Create Server</h2>

    {!! Form::model($server = new App\Models\Server, ['route' => ['servers.store']]) !!}
    @include('servers/_form', ['submit_text' => 'Create Server'])
    {!! Form::close() !!}

@endsection