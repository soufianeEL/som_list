<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name') !!}
</div>
<div class="form-group">
    {!! Form::label('unique_link', 'Unique Link:') !!}
    {!! Form::text('unique_link') !!}
</div>
<div class="form-group">
    {!! Form::label('html_code', 'Html Code:') !!}
    {!! Form::text('html_code') !!}
</div>
<div class="form-group">
    {!! Form::label('image', 'image:') !!}
    {!! Form::file('image') !!}
</div>
<div class="form-group">
    {!! Form::submit($submit_text, ['class'=>'btn primary']) !!}
</div>