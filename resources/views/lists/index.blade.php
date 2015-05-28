@extends('app')

@section('content')

    <h1> Lists </h1>

    @if( !$lists->count() )
        <b>there is no Lists</b>
    @else
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Isp</td>
                <td>Type</td>
                <td>Description</td>
                <td>add_date</td>
                <td>created_by</td>
                <td>Actions</td>
            </tr>
            </thead>
            <tbody>

            @foreach($lists as $list)
                <tr>
                    <td>{{ $list->id }}</td>
                    <td>{{ $list->name }}</td>
                    <td>{{ $list->isp }}</td>
                    <td>{{ $list->type }}</td>
                    <td>{{ $list->descreption }}</td>
                    <td>{{ $list->add_date }}</td>
                    <td>{{ $list->created_by }}</td>
                    <!-- we will also add show, edit, and delete buttons -->
                    <td>
                        {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('lists.destroy', $list))) !!}
                        <!-- show the affiliate (uses the show method found at GET /affiliate/{id} -->
                        <a class="btn btn-small btn-success" href="{{ URL::to('lists/' . $list->id) }}">Show</a>

                        <!-- edit this affiliate (uses the edit method found at GET /affiliate/{id}/edit -->
                        <a class="btn btn-small btn-info" href="{{ URL::to('lists/' . $list->id . '/edit') }}">Edit</a>

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
        <a class="btn btn-info" href="{{ URL::route('lists.create') }}">Create list</a>
    </p>
@endsection