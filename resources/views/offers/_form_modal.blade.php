<div class="form-group">
    {!! Form::label('name', 'Name:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::text('name') !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('code', 'Code:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-8"></div>
        {!! Form::text('code') !!}
    </div>
<div class="form-group">
    {!! Form::label('description', 'Description:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::textarea('description',null,['rows' => '3']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('vertical', 'Vertical:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::text('vertical') !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('price_format', 'Price Format:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::text('price_format') !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('price_range', 'Price Range:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::text('price_range') !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('unsub_link', 'Unsubscribe Link:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::text('unsub_link') !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('active', 'Active:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::checkbox('active') !!}
    </div>
</div>
