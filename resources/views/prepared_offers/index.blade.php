@extends('app')

@section('content')

    <h1> Prepared Offers </h1>

    @if( !$p_offers->count() )
        <b>there is no p_offers</b>
    @else
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <td>ID</td>
                <td>offer_id</td>
                <td>subject_id</td>
                <td>creative_id</td>
                <td>from_line_id</td>
                <td>created_by</td>
                <td>Actions</td>
            </tr>
            </thead>
            <tbody>

            @foreach($p_offers as $offer)
                <tr>
                    <td>{{ $offer->id }}</td>
                    <td>{{ $offer->offer_id }}</td>
                    <td>{{ $offer->subject_id }}</td>
                    <td>{{ $offer->creative_id }}</td>
                    <td>{{ $offer->from_line_id }}</td>
                    <td>{{ $offer->created_by }}</td>
                    <!-- we will also add show, edit, and delete buttons -->
                    <td>
                        {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('prepared-offers.destroy', $offer))) !!}
                        <!-- show the affiliate (uses the show method found at GET /affiliate/{id} -->
                        <a class="btn btn-small btn-success" href="{{ URL::to('prepared-offers/' . $offer->id) }}">Show</a>

                        <!-- edit this affiliate (uses the edit method found at GET /affiliate/{id}/edit -->
                        <a class="btn btn-small btn-info" href="{{ URL::to('prepared-offers/' . $offer->id . '/edit') }}">Edit</a>

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
        <a class="btn btn-info" href="{{ URL::route('prepared-offers.create') }}">Create Offer</a>
    </p>
@endsection