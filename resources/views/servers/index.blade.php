@extends('app')

@section('content')

    <h1> Servers </h1>

    @if( !$servers->count() )
        <b>there is no servers</b>
    @else
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>main_ip</td>
                <td>provider</td>
                <td>status</td>
                <td>add_date</td>
                <td>return_date</td>
                <td>active</td>
                <td>ips</td>
                <td>Actions</td>
            </tr>
            </thead>
            <tbody>

            @foreach($servers as $server)
                <tr>
                    <td>{{ $server->id }}</td>
                    <td>{{ $server->name }}</td>
                    <td>{{ $server->main_ip }}</td>
                    <td>{{ $server->provider }}</td>
                    <td>{{ $server->status }}</td>
                    <td>{{ $server->add_date }}</td>
                    <td>{{ $server->return_date }}</td>
                    <td> @if( $server->active == 1 )
                            <span class="glyphicon glyphicon-ok" style="color: green"></span>
                        @else
                            <span class="glyphicon glyphicon-remove" style="color: red"></span>
                        @endif
                    </td>
                    <td>ips (lien ici)<span class="glyphicon glyphicon-hdd"></span> </td>

                    <!-- we will also add show, edit, and delete buttons -->
                    <td>
                        {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('servers.destroy', $server))) !!}
                        <!-- show the Server (uses the show method found at GET /Server/{id} -->
                        <a class="btn btn-small btn-success" href="{{ URL::to('servers/' . $server->id) }}"><i class="glyphicon glyphicon-info-sign"></i> Show</a>
                        <!-- edit this Server (uses the edit method found at GET /Server/{id}/edit -->
                        <a class="btn btn-small btn-info" href="{{ URL::to('servers/' . $server->id . '/edit') }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                        <!-- delete the Server (uses the destroy method DESTROY /Server/{id} -->
                        {!! Form::submit('Delete', array('class' => 'btn btn-small btn-danger')) !!}
                        {!! Form::close() !!}

                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    @endif
    <p>
        <a class="btn btn-info" href="{{ URL::route('servers.create') }}">Create Server</a>
    </p>
@endsection