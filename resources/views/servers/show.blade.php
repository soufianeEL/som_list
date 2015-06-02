@extends('app')

@section('content')
    <h2>{{ $server->name }}</h2>
    <h4>main_ip :  {{ $server->main_ip }}</h4>
    <h4>provider :  {{ $server->provider }}</h4>
    <h4>Status: {{ $server->status }}</h4>
    <h4>active: {{ $server->active }}</h4>
    <h4>add_date: {{ $server->add_date }}</h4>
    <h4>return_date: {{ $server->return_date }}</h4>

    <h2>IPs | <a onclick="Modal($(this));" data-href="{{URL::route('servers.ips.create', $server)}}">Create Ip</a> </h2>
    {{-- @include('ips/_index', ['ips' => $server->ips]) --}}

    @if( !$server->ips->count() )
        <b>there is no ips</b>
    @else
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <td>ID</td>
                <td>domain</td>
                <td>ip</td>
                <td>active</td>
                <td>Actions</td>
            </tr>
            </thead>
            <tbody>

            @foreach($server->ips as $ip)
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

                    <td>
                        {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('servers.ips.destroy', $server, $ip))) !!}

                        <a class="btn btn-small btn-success" onclick="Modal($(this));" data-href="{{$server->id .'/ips/' . $ip->id }}"><i class="glyphicon glyphicon-info-sign"></i> Show</a>
                        <a class="btn btn-small btn-info" onclick="Modal($(this));" data-href="{{$server->id .'/ips/'.$ip->id.'/edit'}}"><i class="glyphicon glyphicon-edit"></i> Edit</a>

                        {!! Form::submit('Delete', array('class' => 'btn btn-small btn-danger')) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    @endif

    <p>
        <a class="btn btn-info" href="{{ URL::route('servers.index') }}">Back to servers</a>
    </p>
    <div id="modal" class="modal fade"></div>
@endsection

@section('js')
    <script src="{{ asset('/js/laravel.js') }}"></script>
    <script type="text/javascript" >
        function Modal(a)
        {
            $.ajax({
                type: 'get',
                url: a.attr('data-href'),
                //data: $('form').serialize(),
                success: function (data) {
                    $("#modal").html(data);
                    $("#modal").modal("show");
                },
                error: function() {
                    alert("error: try later !!");
                }
            });
        }
    </script>
@endsection