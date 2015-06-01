<div class="form-group">
    <label for="name" class="col-sm-2 control-label">Name:</label>
    <div class="col-sm-8">
        {!! Form::text('name',null,['class' => 'form-control', 'required' => 'true']) !!}
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="code">Code:</label>
    <div class="col-sm-8">
        {!! Form::text('code',null,['class' => 'form-control', 'required' => 'true']) !!}
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="link">Link:</label>
    <div class="col-sm-8">
        {!! Form::text('link',null,['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="status">Status:</label>
    <div class="col-sm-8">
        {!! Form::select('status',['' => '','active' => 'Active', 'inactive' => 'Inactive'],null,['class' => 'form-control']) !!}
    </div>
</div>
