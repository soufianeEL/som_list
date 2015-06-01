<div class="form-group">
    {!! Form::label('name', 'Name:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::text('name',null,['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('unique_link', 'Unique Link:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::text('unique_link',null,['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('html_code', 'Html Code:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::text('html_code',null,['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('image', 'image:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-8">
        {{--@if(isset($subject->image)){--}}
            <!-- img src="{{--url('/creatives/'. $creative->offer_id.'/'.$creative->image)--}}" alt="ALT NAME" class="img-responsive" / >
            <div class="hidden caption">
            {{--$creative->image--}}
            </div-->
        {{--}--}}
        {!! Form::file('image',['class' => 'form-control']) !!}
    </div>
</div>
