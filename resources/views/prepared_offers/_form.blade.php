<h2>{{ $offer->name }}</h2>
{!! Form::hidden('offer_id', $offer->id ) !!}
<div class="form-group">
    {!! Form::label('subject_id','Subject:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-8">
        {{--{!! Form::select('active', ['' => '','1' => 'Active', '0' => 'Inactive'], null, ['class' => 'form-control']) !!}--}}
    @if ( !$offer->subjects->count() )
        Your offer has no subjects.
    @else
        <select class="form-control" name="subject_id">
            <option value="" selected="selected"></option>
            @foreach( $offer->subjects as $subject )
                <option value="{{$subject->id}}">{{$subject->name}}</option>
            @endforeach
        </select>
    @endif
    </div>
</div>
<div class="form-group">
    {!! Form::label('creative_id','Creative:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-8">
    @if ( !$offer->creatives->count() )
        Your offer has no creatives.
    @else
        <select class="form-control" name="creative_id">
            <option value="" selected="selected"></option>
            @foreach( $offer->creatives as $creative )
                <option value="{{$creative->id}}">{{$creative->name}}</option>
            @endforeach
        </select>
    @endif
    </div>
</div>
<div class="form-group">
    {!! Form::label('from_line_id','From Line:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-8">
    @if ( !$offer->from_lines->count() )
        Your offer has no From Lines.
    @else
        <select class="form-control" name="from_line_id">
            <option value="" selected="selected"></option>
            @foreach( $offer->from_lines as $from_line )
                <option value="{{$from_line->id}}">{{$from_line->from}}</option>
            @endforeach
        </select>
    @endif
    </div>
</div>