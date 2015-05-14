@extends('app')

@section('content')
    <h2>{{ $offer->name }}</h2>
    <h4><b>Code :</b>         {{ $offer->code }}</h4>
    <h4><b>Description :</b>  {{ $offer->description }}</h4>
    <h4><b>Vertical:</b>      {{ $offer->vertical }}</h4>
    <h4><b>Price Format:</b>  {{ $offer->price_format }}</h4>
    <h4><b>Price Range:</b>   {{ $offer->price_range }}</h4>

    <h3> Subjects </h3>
    @if ( !$offer->subjects->count() )
        Your offer has no subjects.
    @else
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>----</td>
                <td>Actions</td>
            </tr>
            </thead>
            <tbody>
            @foreach( $offer->subjects as $subject )
                    <tr>
                        <td>{{ $subject->id }}</td>
                        <td>{{ $subject->name }}</td>
                        <td></td>

                        <td>

                            <a class="btn btn-small btn-success" href="{{ URL::to('$subjects/' . $subject->id) }}">Show</a>

                            <a class="btn btn-small btn-info" href="{{ URL::to('$subjects/' . $subject->id . '/edit') }}">Edit</a>

                            <a class="btn btn-small btn-warning" href="#">Delete</a>

                        </td>
                    </tr>
            @endforeach
            </tbody>
        </table>
        <p>
            {!! link_to_route('offers.create', 'Create offer', $offer) !!}
        </p>
    @endif
    <h3> Creatives </h3>
    @if ( !$offer->creatives->count() )
        Your offer has no creatives.
    @else
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Unique Link</td>
                <td>Actions</td>
            </tr>
            </thead>
            <tbody>
            @foreach( $offer->creatives as $creative )
                <tr>
                    <td>{{ $creative->id }}</td>
                    <td>{{ $creative->name }}</td>
                    <td>{{ $creative->unique_link }}</td>

                    <td>

                        <a class="btn btn-small btn-success" href="{{ URL::to('$subjects/' . $subject->id) }}">Show</a>

                        <a class="btn btn-small btn-info" href="{{ URL::to('$subjects/' . $subject->id . '/edit') }}">Edit</a>

                        <a class="btn btn-small btn-warning" href="#">Delete</a>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <p>
            {!! link_to_route('offers.create', 'Create offer', $offer) !!}
        </p>
    @endif
    <h3> From Lines </h3>
    @if ( !$offer->fromLines->count() )
        Your offer has no From Lines.
    @else
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Actions</td>
            </tr>
            </thead>
            <tbody>
            @foreach( $offer->fromLines as $fromLine )
                <tr>
                    <td>{{ $fromLine->id }}</td>
                    <td>{{ $fromLine->from }}</td>

                    <td>

                        <a class="btn btn-small btn-success" href="{{ URL::to('$fromLine/' . $fromLine->id) }}">Show</a>

                        <a class="btn btn-small btn-info" href="{{ URL::to('$fromLine/' . $fromLine->id . '/edit') }}">Edit</a>

                        <a class="btn btn-small btn-warning" href="#">Delete</a>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <p>
            {!! link_to_route('offers.create', 'Create offer', $offer) !!}
        </p>
    @endif

    <p>
        <a class="btn btn-info" href="{{ URL::route('offers.index') }}">Back to offers</a>
    </p>
@endsection