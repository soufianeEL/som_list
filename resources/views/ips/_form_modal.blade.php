
<div class="form-group">
    {!! Form::label('domain', 'Domain:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::text('domain',null,['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('ip', 'Ip:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::text('ip',null,['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('vmta', 'Vmta:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::text('vmta',null,['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('active', 'Active:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::select('active', ['' => '','1' => 'Active', '0' => 'Inactive'], null, ['class' => 'form-control']) !!}
    </div>
</div>