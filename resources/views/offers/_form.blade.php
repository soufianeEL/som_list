<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name') !!}
</div>
<div class="form-group">
    {!! Form::label('code', 'Code:') !!}
    {!! Form::text('code') !!}
</div>
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::text('description') !!}
</div>
<div class="form-group">
    {!! Form::label('vertical', 'Vertical:') !!}
    {!! Form::text('vertical') !!}
</div>
<div class="form-group">
    {!! Form::label('price_format', 'Price Format:') !!}
    {!! Form::text('price_format') !!}
</div>
<div class="form-group">
    {!! Form::label('price_range', 'Price Range:') !!}
    {!! Form::text('price_range') !!}
</div>
<div class="form-group">
    {!! Form::label('unsub_link', 'Unsubscribe Link:') !!}
    {!! Form::text('unsub_link') !!}
</div>
<div class="form-group">
    {!! Form::label('active', 'Active:') !!}
    {!! Form::checkbox('active') !!}
</div>
<div class="form-group">
    {!! Form::submit($submit_text, ['class'=>'btn primary']) !!}
</div>