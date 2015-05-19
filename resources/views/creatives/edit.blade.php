@extends('app')

@section('content')
    <h2>Edit Creative</h2>

    {!! Form::model($creative, ['method' => 'PATCH', 'enctype' => "multipart/form-data", 'route' => ['offers.creatives.update',$offer ,$creative]]) !!}
    @include('creatives/_form', ['submit_text' => 'Edit Creative', 'files' => true])
    {!! Form::close() !!}

@endsection