@extends('app')

@section('content')

    {{ currentAction() }}
    {{--<div class="row">--}}
        {{--<div class="col-lg-3 col-sm-6">--}}
            {{--<div class="info_box_var_1 box_bg_a">--}}
                {{--<div class="info_box_body">--}}
                    {{--<span class="info_box_icon icon_group"></span>--}}
                    {{--<span class="countUpMe" data-endval="1342">1 342</span>--}}
                {{--</div>--}}
                {{--<div class="info_box_footer">--}}
                    {{--New Users--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-lg-3 col-sm-6">--}}
            {{--<div class="info_box_var_1 box_bg_b">--}}
                {{--<div class="info_box_body">--}}
                    {{--<span class="info_box_icon icon_cart_alt"></span>--}}
                    {{--<span class="countUpMe" data-endval="57">57</span>%--}}
                {{--</div>--}}
                {{--<div class="info_box_footer">--}}
                    {{--Orders Completed--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-lg-3 col-sm-6">--}}
            {{--<div class="info_box_var_1 box_bg_c">--}}
                {{--<div class="info_box_body">--}}
                    {{--<span class="info_box_icon icon_wallet"></span>--}}
                    {{--$<span class="countUpMe" data-endval="13578">13 578</span>--}}
                {{--</div>--}}
                {{--<div class="info_box_footer">--}}
                    {{--Sale--}}
                    {{--<small>(last 24h)</small>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-lg-3 col-sm-6">--}}
            {{--<div class="info_box_var_1 box_bg_d">--}}
                {{--<div class="info_box_body">--}}
                    {{--<span class="info_box_icon icon_mail_alt"></span>--}}
                    {{--<span class="countUpMe" data-endval="531">531</span>--}}
                {{--</div>--}}
                {{--<div class="info_box_footer">--}}
                    {{--Sent Messages--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
@endsection
