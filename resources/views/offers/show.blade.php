@extends('app')

@section('content')
    <h2>{{ $offer->name }}</h2>

    <h4 class="col-sm-4"><b>Code :</b>         {{ $offer->code }}</h4>
    <h4 class="col-sm-8"><b>Description :</b>  {{ $offer->description }}</h4>

    <h4 class="col-sm-4">Vertical:     {{ $offer->vertical }}</h4>
    <h4 class="col-sm-4">Price Format:  {{ $offer->price_format }}</h4>
    <h4 class="col-sm-4">Price Range:   {{ $offer->price_range }}</h4>

    <h3> Subjects | <a onclick="Modal($(this));" data-href="{{URL::route('offers.subjects.create', [$offer])}}">Create subject</a></h3>
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
                            <a class="btn btn-small btn-success" href="{{$offer->id}}/subjects/{{$subject->id}}">Show</a>
                            <a class="btn btn-small btn-info" onclick="Modal($(this));" data-href="{{$offer->id}}/subjects/{{$subject->id}}/edit">Edit</a>
                            <a class="btn btn-small btn-danger" data-method="DELETE" data-token="{{csrf_token()}}" data-confirm="Are you sure?" href="{{$offer->id}}/subjects/{{$subject->id}}">delete</a>
                        </td>
                    </tr>
            @endforeach
            </tbody>
        </table>
    @endif
    <h3> Creatives | <a onclick="Modal($(this));" data-href="{{URL::route('offers.creatives.create', [$offer])}}">Create Creative</a></h3>
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
                        {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('offers.creatives.destroy', $offer, $creative))) !!}
                        <a class="btn btn-small btn-success" href="{{$offer->id}}/creatives/{{$creative->id}}">Show</a>
                        <a class="btn btn-small btn-info" onclick="Modal($(this));" data-href="{{$offer->id}}/creatives/{{$creative->id}}/edit">Edit</a>
                        {!! Form::submit('Delete', array('class' => 'btn btn-small btn-danger')) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

    <h3> From Lines |<a onclick="Modal($(this));" data-href="{{URL::route('offers.from_lines.create', [$offer])}}">Create fromLine</a></h3>
    @if ( !$offer->from_lines->count() )
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
            @foreach( $offer->from_lines as $fromLine )
                <tr>
                    <td>{{ $fromLine->id }}</td>
                    <td>{{ $fromLine->from }}</td>

                    <td>
                        <a class="btn btn-small btn-success" href="{{ URL::to('/from_lines/' . $fromLine->id) }}">Show</a>
                        <a class="btn btn-small btn-info" onclick="Modal($(this));" data-href="{{$offer->id}}/from_lines/{{$fromLine->id}}/edit">Edit</a>
                        <a class="btn btn-small btn-warning" href="#">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

    <p>
        <a class="btn btn-info" href="{{ URL::route('offers.index') }}">Back to offers</a>
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
                }
            });
        }
    </script>
@endsection