<h1> campaigns </h1>

@if( !$campaigns->count() )
    <b>there is no campaigns</b>
@else
    <table id="datatable" class="table table-striped table-bordered" >
        <thead>
        <tr>
            <td>ID</td>
            <td>name</td>
            <td>status</td>
            <td>type</td>
            <td>Lists</td>
            <td>offer_id</td>
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
                        : <span class="el-icon-play bs_ttip" title="click to resume" onclick="resume($(this));" data-id="{{ $campaign->id}}"></span>
                    @endif
                </td>
                <td>{{ $campaign->type }}</td>
                <td>@foreach($campaign->lists as $list)<a href="#" class="label label-success" style="margin-right: 4px"> {{ $list->name }} </a>@endforeach</td>
                <td>{{ $campaign->offer_id }}</td>
                <td> <a class="btn btn-primary" href="#"> <span class="el-icon-adult"> {{-- \App\User::find($campaign->created_by)->name --}} </span> </a></td>
                <!-- we will also add show, edit, and delete buttons -->
                <td>
                    {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('campaigns.destroy', $campaign))) !!}
                    <!-- edit this affiliate (uses the edit method found at GET /affiliate/{id}/edit -->
                    <a class="btn btn-small btn-info" href="{{ URL::to('campaigns/'.$campaign->id.'/edit') }}">Edit</a>
                    <!-- delete the affiliate (uses the destroy method DESTROY /affiliate/{id} -->
                    {!! Form::submit('Delete', array('class' => 'btn btn-small btn-danger')) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
    {!! $campaigns->render() !!}
@endif