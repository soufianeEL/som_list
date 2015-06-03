@extends('app')

@section('content')

    <h1> Offers </h1>

    @if( !$offers->count() )
        <b>there is no offers</b>
    @else
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <td>Prepare</td>
                <td>Name</td>
                <td>Description</td>
                <td>Code</td>
                <td>Vertical</td>
                <td>reffered affiliate</td>
                <td>Actions</td>
            </tr>
            </thead>
            <tbody>

            @foreach($offers as $offer)
                <tr>
                    <td><a class="el-icon-th-large bs_ttip" title="Prepare It" onclick="Modal($(this));" data-href="{{ URL::to('offers/'.$offer->id.'/prepare/') }}"></a></td>
                    <td>{{ $offer->name }}</td>
                    <td>{{ $offer->description }}</td>
                    <td>{{ $offer->code }}</td>
                    <td>{{ $offer->vertical }}</td>
                    <td><a class="btn" href="{{ URL::to('affiliates/' . $offer->affiliate_id ) }}">Go</a></td>

                    <td>
                        {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('offers.destroy', $offer))) !!}
                        <a class="btn btn-small btn-success" href="{{ URL::to('offers/' . $offer->id) }}">Show</a>
                        <a class="btn btn-small btn-info" onclick="Modal($(this));" data-href="{{ URL::to('offers/' . $offer->id . '/edit') }}">Edit</a>
                        {!! Form::submit('Delete', array('class' => 'btn btn-small btn-danger')) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    @endif
    <p>
        <a class="btn btn-info" onclick="Modal($(this));" data-href="{{ URL::route('offers.create') }}">Create Offer</a>
    </p>
    <div id="modal" class="modal fade"></div>
@endsection

@section('js')
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