@extends('app')

@section('content')

    <h1> campaigns <span class="el-icon-random bs_ttip" title="send request" onclick="pause($(this));" data-href="{{ URL::to('campaigns/3/pause') }}"></span></h1>

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
                    <td>{{$campaign->status}}
                        @if($campaign->status=='in progress')
                            : <span class="el-icon-pause bs_ttip" title="click to pause" onclick="pause($(this));" data-id="{{ $campaign->id}}"></span>
                        @elseif($campaign->status=='paused')
                            : <span class='el-icon-play bs_ttip' title='click to resume' onclick='resume($(this));' data-href='{{ URL::to('campaigns/'.$campaign->id.'/resume') }}'></span>
                        @endif
                    </td>
                    <td>{{ $campaign->type }}</td>
                    <td>@foreach($campaign->lists as $list)<a href="#" class="label label-success" style="margin-right: 4px"> {{ $list->name }} </a>@endforeach</td>
                    <td>{{ $campaign->prepared_offer_id }}</td>
                    <td> <a class="btn btn-primary" href="#"> <span class="el-icon-adult"> {{-- \App\User::find($campaign->created_by)->name --}} </span> </a></td>
                    <!-- we will also add show, edit, and delete buttons -->
                    <td>
                        {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('campaigns.destroy', $campaign))) !!}
                        <!-- show the affiliate (uses the show method found at GET /affiliate/{id} -->
                        <a class="btn btn-small btn-success" href="{{ URL::to('campaigns/'.$campaign->id.'/'.$campaign->prepared_offer_id) }}">Show</a>
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
    {{--<p>--}}
        {{--<a class="btn btn-info" href="{{ URL::route('campaigns.create') }}">Create campaign</a>--}}
    {{--</p>--}}
@endsection

@section('js')
    <script type="text/javascript" >
        var nbr_interval = 0;
        $(document).ready(function() {
            all_status();
        });

        function all_status(){
            if(nbr_interval==0){
                var id = setInterval(function(){ status(id) ;},3000);
                nbr_interval++;
            }
        }

        function resume(a)
        {
            a.parent().html("in progress : " +
            "<span class='el-icon-pause bs_ttip' title='click to pause' onclick='pause($(this));' data-href='{{$campaign->id}}'></span>");
            all_status();
        }
        function pause(a)
        {
            $.ajax({
                type: 'post',
                url: "campaigns/"+ a.data('id')+"/pause",//a.data('href'),
                data: {_token: '{{csrf_token()}}' },
                success: function (data) {
                    alert('paused');
                    a.parent().html("paused : " +
                    "<span class='el-icon-play bs_ttip' title='click to resume' onclick='resume($(this));' data-href='{{ URL::to('campaigns/'.$campaign->id.'/resume') }}'></span>");
                }
            });

        }
        function status(id)
        {
            console.log('id :' + id);
            var arr = $("table td:nth-child(3) span.el-icon-pause");
            if(arr.length == 0){
                clearInterval(id);
                nbr_interval =0;
                }
            else{
                var ids = $.map(arr,function(n){return $(n).data('id');});
                $.ajax({
                    type: 'post',
                    url: "{{ URL::to('campaigns/status') }}",
                    data: {ids: ids,_token: '{{csrf_token()}}' },
                    success: function (data) {
                        var new_arr = diffArrays(ids,data);
                        if(new_arr.length != 0){
                            $(new_arr).each(function(i,n){
                                //console.log(n); //alert this campaign was sent
                                $("span[data-id='"+n+"']").parent().text('sent');
                            });
                        }
                    }
                });
            }
        }

        function compareArrays(arr1, arr2) {
            return $(arr1).not(arr2).length == 0 && $(arr2).not(arr1).length == 0
        };

        function diffArrays(old_array, new_array) {
            return $(old_array).not(new_array).get();
        };
        function is_sent(a, id)
        {
            $.ajax({
                type: 'get',
                url: a.attr('data-href'),
                success: function (data) {
                    console.log(data);
                    if(data=='sent'){
                        clearInterval(id);
                        a.parent().text('sent');
                    }
                },
                error: function() {
                    alert("error: try later !!");
                }
            });
        };
    </script>
@endsection