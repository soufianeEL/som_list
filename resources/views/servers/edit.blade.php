@extends('app')

@section('content')
    <h2>Edit Server</h2>

    {!! Form::model($server, ['method' => 'PATCH', 'route' => ['servers.update', $server->id]]) !!}
    @include('servers/_form', ['submit_text' => 'Edit Server'])
    {!! Form::close() !!}
@endsection