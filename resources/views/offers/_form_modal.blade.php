<div class="form-group">
    {!! Form::label('name', 'Name:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::text('name',null,['class' => 'form-control', 'required' => 'true']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('code', 'Code:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::text('code',null,['class' => 'form-control', 'required' => 'true']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('description', 'Description:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::textarea('description',null,['class' => 'form-control','rows' => '3']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('vertical', 'Vertical:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::text('vertical',null,['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('price_format', 'Price Format:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::text('price_format',null,['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('price_range', 'Price Range:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::text('price_range',null,['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('unsub_link', 'Unsubscribe Link:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::text('unsub_link',null,['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('active', 'Active:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::checkbox('active',null,['class' => 'form-control']) !!}
    </div>
</div>
