@extends('app')

@section('content')
    <h2>Create Ip</h2>

    {!! Form::model($ip = new App\Models\Server, ['route' => ['servers.ips.store', $server]]) !!}
    @include('ips/_form', ['submit_text' => 'Create Ip'])
    {!! Form::close() !!}

@endsection