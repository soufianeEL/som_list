@extends('app')

@section('content')
    <h2>Domain : {{ $ip->domain }}</h2>
    <h4>ip :  {{ $ip->ip }}</h4>
    <h4>vmta :  {{ $ip->vmta }}</h4>
    <h4>active: {{ $ip->active }}</h4>


    <p>
        <a class="btn btn-small btn-info" href="{{$ip->id}}/edit"><i class="glyphicon glyphicon-edit"></i> Edit</a>
        |
        <a class="btn btn-info" href="{{ URL::route('servers.show',$server) }}">Back</a>
    </p>
@endsection