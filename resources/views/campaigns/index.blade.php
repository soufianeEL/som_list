@extends('app')

@section('content')

    <h1> campaigns </h1>

    @if( !$campaigns->count() )
        <b>there is no campaigns</b>
    @else
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <td>ID</td>
                <td>name</td>
                <td>status</td>
                <td>type</td>
                <td>Lists</td>
                <td>prepared_id</td>
                <td>created_by</td>
                <td>Actions</td>
            </tr>
            </thead>
            <tbody>

            @foreach($campaigns as $campaign)
                <tr>
                    <td>{{ $campaign->id }}</td>
                    <td>{{ $campaign->name }}</td>
                    <td>{{ $campaign->status }}</td>
                    <td>{{ $campaign->type }}</td>
                    <td>
                        @foreach($campaign->lists as $list)
                            <a href="#" class="label label-success" style="margin-right: 4px"> {{ $list->name }} </a>
                        @endforeach
                    </td>
                    <td>{{ $campaign->prepared_offer_id }}</td>
                    <td> <a class="btn btn-primary" href="#"> <span class="el-icon-adult"> {{ \App\User::find($campaign->created_by)->name }} </span> </a></td>
                    <!-- we will also add show, edit, and delete buttons -->
                    <td>
                        {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('campaigns.destroy', $campaign))) !!}
                        <!-- show the affiliate (uses the show method found at GET /affiliate/{id} -->
                        <a class="btn btn-small btn-success" href="{{ URL::to('campaigns/' . $campaign->id) }}">Show</a>

                        <!-- edit this affiliate (uses the edit method found at GET /affiliate/{id}/edit -->
                        <a class="btn btn-small btn-info" href="{{ URL::to('campaigns/' . $campaign->id . '/edit') }}">Edit</a>

                        <!-- delete the affiliate (uses the destroy method DESTROY /affiliate/{id} -->
                        {!! Form::submit('Delete', array('class' => 'btn btn-small btn-danger')) !!}
                        {!! Form::close() !!}

                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    @endif
    <p>
        <a class="btn btn-info" href="{{ URL::route('campaigns.create') }}">Create campaign</a>
    </p>
@endsection