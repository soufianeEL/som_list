<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name') !!}
</div>
<div class="form-group">
    {!! Form::label('code', 'Code:') !!}
    {!! Form::text('code') !!}
</div>
<div class="form-group">
    {!! Form::label('link', 'Link:') !!}
    {!! Form::text('link') !!}
</div>
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::select('status', array('' => '','active' => 'Active', 'inactive' => 'Inactive')) !!}
</div>
<div class="form-group">
    {!! Form::submit($submit_text, ['class'=>'btn primary']) !!}
</div>