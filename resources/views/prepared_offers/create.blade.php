@extends('app')

@section('content')
    {!! Form::model(new App\Models\PreparedOffer, ['route' => ['prepared-offers.store']]) !!}
    <h2>{{ $offer->name }}</h2>
    {!! Form::hidden('offer_id', $offer->id ) !!}
    <h4>Code :         {{ $offer->code }}</h4>
    <h4>Description :  {{ $offer->description }}</h4>
    <h4>Vertical:      {{ $offer->vertical }}</h4>
    <h4><b>Price Format:</b>  {{ $offer->price_format }}</h4>
    <h4><b>Price Range:</b>   {{ $offer->price_range }}</h4>

    <div class="form-group">
        <label for="subject_id">Subject:</label>
        @if ( !$offer->subjects->count() )
            Your offer has no subjects.
        @else
            <select name="subject_id">
                <option value="" selected="selected"></option>
                @foreach( $offer->subjects as $subject )
                    <option value="{{$subject->id}}">{{$subject->name}}</option>
                @endforeach
            </select>
        @endif
    </div>

    <div class="form-group">
        <label for="creative_id">Creative:</label>
        @if ( !$offer->creatives->count() )
            Your offer has no creatives.
        @else
            <select name="creative_id">
                <option value="" selected="selected"></option>
                @foreach( $offer->creatives as $creative )
                    <option value="{{$creative->id}}">{{$creative->name}}</option>
                @endforeach
            </select>
        @endif
    </div>

    <div class="form-group">
        <label for="from_line_id">From Line:</label>
        @if ( !$offer->from_lines->count() )
            Your offer has no From Lines.
        @else
            <select name="from_line_id">
                <option value="" selected="selected"></option>
                @foreach( $offer->from_lines as $from_line )
                    <option value="{{$from_line->id}}">{{$from_line->from}}</option>
                @endforeach
            </select>
        @endif
    </div>

    <div class="form-group">
        <a class="btn btn-info" href="{{ URL::route('offers.index') }}">Back to offers</a>
        |
        {!! Form::submit('Prepare Offer', ['class'=>'btn primary']) !!}
    </div>

    {!! Form::close() !!}
@endsection