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
                    <td><a class="el-icon-th-large bs_ttip" title="Prepare It" href="{{ URL::to('offers/'.$offer->id.'/prepare/') }}"></a></td>
                    <td>{{ $offer->name }}</td>
                    <td>{{ $offer->description }}</td>
                    <td>{{ $offer->code }}</td>
                    <td>{{ $offer->vertical }}</td>
                    <td><a class="btn" href="{{ URL::to('affiliates/' . $offer->affiliate_id ) }}">Go</a></td>

                    <!-- we will also add show, edit, and delete buttons -->
                    <td>
                        {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('offers.destroy', $offer))) !!}
                        <!-- show the affiliate (uses the show method found at GET /affiliate/{id} -->
                        <a class="btn btn-small btn-success" href="{{ URL::to('offers/' . $offer->id) }}">Show</a>

                        <!-- edit this affiliate (uses the edit method found at GET /affiliate/{id}/edit -->
                        <a class="btn btn-small btn-info" id="edit-offer" data-href="{{ URL::to('offers/' . $offer->id . '/edit') }}">Edit</a>

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
        <a class="btn btn-info" id="create-offer" data-href="{{ URL::route('offers.create') }}">Create Offer</a>
    </p>
    <div id="modal" class="modal fade"></div>
@endsection

@section('js')
    <script type="text/javascript" >


        function getModal(url)
        {
            $.ajax({
                type: 'get',
                url: url,
                //data: $('form').serialize(),
                success: function (data) {
                    $("#modal").html(data);
                    $("#modal").modal("show");
                }
            });
        }
        $(document).on('click','#create-offer',function (){
            getModal($(this).attr('data-href'));
        });
        $(document).on('click','#edit-offer',function (){
            getModal($(this).attr('data-href'));
        });
    </script>
@endsection