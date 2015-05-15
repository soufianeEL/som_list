
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name') !!}
</div>
<div class="form-group">
    {!! Form::label('main_ip', 'Main Ip:') !!}
    {!! Form::text('main_ip') !!}
</div>
<div class="form-group">
    {!! Form::label('provider', 'Provider:') !!}
    {!! Form::text('provider') !!}
</div>
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::text('status') !!}
</div>
<div class="form-group">
    {!! Form::label('active', 'Active:') !!}
    {!! Form::select('active', array('' => '','1' => 'Active', '0' => 'Inactive')) !!}
</div>
<div class="form-group">
    {!! Form::label('add_date', 'Add date:') !!}
    {!! Form::input('datetime-local', 'add_date', str_replace(' ', 'T', $server->add_date) , ['placeholder' => 'Add date']) !!}
</div>
<div class="form-group">
    {!! Form::label('return_date', 'Return date:') !!}
    {!! Form::input('datetime-local', 'return_date', str_replace(' ', 'T', $server->return_date) , ['placeholder' => 'Return date']) !!}
</div>
<div class="form-group">
    {!! Form::submit($submit_text, ['class'=>'btn primary']) !!}
</div>