
<div class="form-group">
    {!! Form::label('domain', 'Domain:') !!}
    {!! Form::text('domain') !!}
</div>
<div class="form-group">
    {!! Form::label('ip', 'Ip:') !!}
    {!! Form::text('ip') !!}
</div>
<div class="form-group">
    {!! Form::label('vmta', 'Vmta:') !!}
    {!! Form::text('vmta') !!}
</div>
<div class="form-group">
    {!! Form::label('active', 'Active:') !!}
    {!! Form::select('active', array('' => '','1' => 'Active', '0' => 'Inactive')) !!}
</div>
<div class="form-group">
    {!! Form::submit($submit_text, ['class'=>'btn primary']) !!}
</div>