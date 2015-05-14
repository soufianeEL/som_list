@extends('app')

@section('content')
    <h2>{{ $affiliate->name }}</h2>
    <h4>Code :  {{ $affiliate->code }}</h4>
    <h4>Link :  {{ $affiliate->link }}</h4>
    <h4>Status: {{ $affiliate->status }}</h4>
    @if ( !$affiliate->offers->count() )
        Your affiliate has no offers.
    @else
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Description</td>
                <td>Code</td>
                <td>Vertical</td>
                <td>Actions</td>
            </tr>
            </thead>
            <tbody>
            @foreach( $affiliate->offers as $offer )
                    <tr>
                        <td>{{ $offer->id }}</td>
                        <td>{{ $offer->name }}</td>
                        <td>{{ $offer->description }}</td>
                        <td>{{ $offer->code }}</td>
                        <td>{{ $offer->vertical }}</td>

                        <!-- we will also add show, edit, and delete buttons -->
                        <td>
                            <!-- show the affiliate (uses the show method found at GET /affiliate/{id} -->
                            <a class="btn btn-small btn-success" href="{{ URL::to('offers/' . $offer->id) }}">Show</a>

                            <!-- edit this affiliate (uses the edit method found at GET /affiliate/{id}/edit -->
                            <a class="btn btn-small btn-info" href="{{ URL::to('offers/' . $offer->id . '/edit') }}">Edit</a>

                            <!-- delete the affiliate (uses the destroy method DESTROY /affiliate/{id} -->
                            <a class="btn btn-small btn-warning" href="#">Delete</a>
                        </td>
                    </tr>
            @endforeach
            </tbody>
        </table>
    @endif

    <p>
        <a class="btn btn-info" href="{{ URL::route('affiliates.index') }}">Back to affiliates</a>
        {!! link_to_route('offers.create', 'Create offer', $affiliate) !!}
    </p>
@endsection