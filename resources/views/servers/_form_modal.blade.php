
<div class="form-group">
    {!! Form::label('name', 'Name:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::text('name',null,['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('main_ip', 'Main Ip:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::text('main_ip',null,['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('provider', 'Provider:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::text('provider',null,['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('status', 'Status:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::text('status',null,['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('active', 'Active:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::select('active', ['' => '','1' => 'Active', '0' => 'Inactive'], null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('add_date', 'Add date:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::input('datetime-local', 'add_date', str_replace(' ', 'T', $server->add_date) , ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('return_date', 'Return date:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::input('datetime-local', 'return_date', str_replace(' ', 'T', $server->return_date) , ['class' => 'form-control']) !!}
    </div>
</div>