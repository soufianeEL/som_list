@extends('app')

@section('content')

    <h1> Affiliates </h1>

    @if( !$affiliates->count() )
        <b>there is no affiliates</b>
    @else
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Code</td>
                <td>Link</td>
                <td>Offers</td>
                <td>Actions</td>
            </tr>
            </thead>
            <tbody>

            @foreach($affiliates as $aff)
                <tr>
                    <td>{{ $aff->id }}</td>
                    <td>{{ $aff->name }}</td>
                    <td>{{ $aff->code }}</td>
                    <td>{{ $aff->link }}</td>
                    <td>offers (lien ici) </td>

                    <!-- we will also add show, edit, and delete buttons -->
                    <td>
                        {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('affiliates.destroy', $aff) )) !!}
                        <!-- show the affiliate (uses the show method found at GET /affiliate/{id} -->
                        <a class="btn btn-small btn-success" href="{{ URL::to('affiliates/' . $aff->id) }}">Show</a>

                        <!-- edit this affiliate (uses the edit method found at GET /affiliate/{id}/edit -->
                        <a class="btn btn-small btn-info" id="edit-affiliate" data-href="{{ URL::to('affiliates/' . $aff->id . '/edit') }}">Edit</a>

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
        <!--a class="btn btn-info" data-remote="true" data-method="get" href="{{URL::route('affiliates.create')}}">Create Affiliate</a-->
        <a class="btn btn-info" id="create-affiliate" data-href="{{URL::route('affiliates.create')}}" data-remote="true" >Create Affiliate</a>
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
        $(document).on('click','#create-affiliate',function (){
            getModal($(this).attr('data-href'));
        });
        $(document).on('click','#edit-affiliate',function (){
            getModal($(this).attr('data-href'));
        });
    </script>
@endsection
