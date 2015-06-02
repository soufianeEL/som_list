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

                    <td>
                        <a class="btn btn-small btn-success" href="{{ URL::to('servers/' . $server->id) }}"><i class="glyphicon glyphicon-info-sign"></i> Show</a>
                        <a class="btn btn-small btn-info" onclick="Modal($(this));" data-href="servers/{{$server->id}}/edit"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                        <a class="btn btn-small btn-danger" data-method="DELETE" data-token="{{csrf_token()}}" data-confirm="Are you sure?" href="servers/{{$server->id}}">Delete</a>

                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    @endif
    <p>
        {{--<a class="btn btn-info" href="{{ URL::route('servers.create') }}">Create Server</a> |--}}
        <a class="btn btn-info" onclick="Modal($(this));" data-href="{{ URL::route('servers.create')}}">Create Server x</a>
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
        {{--function Del(a)--}}
        {{--{--}}
            {{--$.ajax({--}}
                {{--method: 'POST',--}}
                {{--url: a.attr('data-href'),--}}
                {{--data: {_token:"{{csrf_token()}}" , _method:"DELETE"},--}}
                {{--success: function (data) {--}}
                    {{--alert(data);--}}
                {{--},--}}
                {{--error: function() {--}}
                    {{--alert("error: try later !!");--}}
                {{--}--}}
            {{--});--}}
        {{--}--}}
    </script>
@endsection