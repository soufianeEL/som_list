@extends('app')

@section('content')

    <h1> Ips </h1>
    @if( !$ips->count() )
        <b>there is no ips</b>
    @else
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <td>ID</td>
                <td>domain</td>
                <td>ip</td>
                <td>active</td>
                <td>referred server</td>
                <td>Actions</td>
            </tr>
            </thead>
            <tbody>

            @foreach($ips as $ip)
                <tr>
                    <td>{{ $ip->id }}</td>
                    <td>{{ $ip->domain }}</td>
                    <td>{{ $ip->ip }}</td>
                    <td> @if( $ip->active == 1 )
                            <span class="glyphicon glyphicon-ok" style="color: green"></span>
                        @else
                            <span class="glyphicon glyphicon-remove" style="color: red"></span>
                        @endif
                    </td>

                    <td><a class="glyphicon glyphicon-eject" href="{{ URL::to('servers/' . $ip->server_id ) }}"> {{ $ip->server->name }} </a> </td>
                    <td>
                        {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('ips.destroy', $ip))) !!}

                        <a class="btn btn-small btn-success" href="{{ URL::to('ips/' . $ip->id) }}"><i class="glyphicon glyphicon-info-sign"></i> Show</a>
                        <a class="btn btn-small btn-info" href="{{ URL::to('ips/' . $ip->id . '/edit') }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>

                        {!! Form::submit('Delete', array('class' => 'btn btn-small btn-danger')) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    @endif


    <p>
        <a class="btn btn-info" href="{{ URL::route('servers.ips.create') }}">Create Ip</a>
    </p>
@endsection