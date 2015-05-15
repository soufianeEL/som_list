@extends('app')

@section('content')
    <h2>Edit Ip</h2>

    {!! Form::model($ip, ['method' => 'PATCH', 'route' => ['servers.ips.update', $server->id, $ip->id]]) !!}
    @include('ips/_form', ['submit_text' => 'Edit Ip'])
    {!! Form::close() !!}
@endsection