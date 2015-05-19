@extends('app')

@section('head')
    <link rel="stylesheet" href="{{ asset('/lib/selectize/css/selectize.css')}}">
@endsection

@section('content')

    {!! Form::open(['route' => ['campaigns.store']]) !!}
    {!! Form::hidden('prepared_offer_id',$var['prepared_offre']) !!}

    <div class="row">
        <div class="col-md-6">
            <label for="select-vmta">vmta :</label>
            <select id="select-vmta" name="vmta[]" multiple class="selectized">

                @foreach ($select as $servername=>$ips)
                    <optgroup label="{{$servername}}">
                        @foreach($ips as $idip => $ip)
                            <option value="{{$idip}}">{{$ip}}</option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label for="server">Msg/Vmta</label>
            <input type="number" name="msg_vmta" value="3" class="form-control">
        </div>
        <div class="col-md-3">
            <label for="port">Msg/Connection</label>
            <input type="number" name="msg_conn" required="true" value="3" class="form-control">
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <label for="offre" class="req">Offre</label>
            <input type="text" name="offre" class="form-control" value="{{$var['offre']}}" readonly>
        </div>
        <div class="col-md-4">
            <label for="from" class="req">Mail from</label>
            <input type="text" name="from" required="tre" class="form-control" value="{{$var['from']}}" readonly>
        </div>
        <div class="col-md-4">
            <label for="list" class="req">Rcpt to liste</label>
            <input type="text" name="list" class="form-control" value="data.txt">
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
            <textarea class="form-control" name="headers" rows="3" style="resize: vertical;">
From: soufiane elh <soufiane@good.somsales.com>
Content-Type: text/plain;
            </textarea>
        </div>
    </div>

    <div class="row">
        <label for="message" class="col-sm-2 control-label">Message</label>
        <div class="col-sm-10">
            <textarea class="form-control" name="message" rows="3" placeholder="your msg here" style="resize: vertical;">
{{$var['creative']}}
            </textarea>
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
    <script type="text/javascript">
        $(function () {
            $('#select-vmta').selectize();

        });
    </script>
@endsection