@extends('app')

@section('head')
    <link rel="stylesheet" href="{{ asset('/lib/selectize/css/selectize.css')}}">
@endsection

@section('content')

    {!! Form::model($campaign,['route' => ['campaigns.store']]) !!}
    {!! Form::hidden('offer_id') !!}
    {!! Form::hidden('subject_id') !!}
    {!! Form::hidden('creative_id') !!}
    {!! Form::hidden('from_line_id') !!}
    <div class="row">
        <div class="col-md-6">
            <label for="select-vmta">Ips :</label>
            <select id="select-vmta" name="vmta[]" multiple class="selectized" value="[1,2]">

                @foreach ($select as $servername=>$ips)
                    <?php
                    $tmp = explode('|',$servername);
                    $server_name = $tmp[1];
                    $server_id = $tmp[0];
                    ?>
                    <optgroup label="{{$server_name}}">
                        @foreach($ips as $idip => $ip)
                            <option value="{{$server_id.'-'.$idip}}">{{$ip}}</option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label for="msg_vmta">Msg/Ip</label>
            <input type="number" name="msg_vmta" value="" class="form-control" required>
        </div>
        <div class="col-md-3">
            <label for="delay">X-delay</label>
            <input type="text" id="delay" name="delay" value="" class="form-control" required>
            <span class="help-block">Message/second</span>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <label for="offre" class="req">Offre</label>
            <input type="text" name="offre" required="true" class="form-control" value="{{$var['offre']}}" readonly>
        </div>
        <div class="col-md-3">
            <label for="from" class="req">Mail from</label>
            <input type="text" name="from" required="true" class="form-control" value="{{$var['from']}}" readonly>
        </div>
        <div class="col-md-3">
            <label for="lists" class="req">List(s)</label>
            <select id="select-list" name="lists[]" multiple class="selectized">
                @foreach($lists as $list)
                    <option value="{{$list->id}}">{{$list->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label for="fraction" class="req">Fraction</label>
            <input type="text" name="fraction" class="form-control" value="">
        </div>
    </div>
    <div class="row">
        <label for="subject" class="col-sm-2 control-label">Subject</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="subject" value="{{$var['subject']}}" readonly>
        </div>
    </div>

    <div class="row">
        <label for="headers" class="col-sm-2 control-label">Headers</label>
        <div class="col-sm-10">
            <textarea class="form-control" name="headers" rows="3" style="resize: vertical;">From: soufiane elh <soufiane@good.somsales.com>
Content-Type: text/plain;</textarea>
        </div>
    </div>

    <div class="row">
        <label for="message" class="col-sm-2 control-label">Message</label>
        <div class="col-sm-10">
            <textarea class="form-control" name="message" rows="3" placeholder="your msg here" style="resize: vertical;"></textarea>
        </div>
    </div>

    <div class="row">
        <div class="text-center">
            {!! Form::submit('send', ['class'=>'btn btn-primary']) !!}
        </div>
    </div>

    {!! Form::close() !!}
@endsection

@section('js')
    <script src="{{ asset('/lib/selectize/js/selectize.min.js') }}"></script>
    <script src="{{ asset('/lib/inputmask/jquery.inputmask.bundle.min.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            $('#select-vmta').selectize();
            $('#select-list').selectize();
            $("#delay").inputmask({mask:"099999/99",oncomplete:function(){/*alert("ook: "+$(this).val())*/}});

        });
    </script>
@endsection