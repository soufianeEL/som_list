@extends('app')

@section('content')

   @include('campaigns.table')

@endsection

@section('js')
    <script type="text/javascript" >
        var nbr_interval = 0;
        $(document).ready(function() {
            all_status();
            $(document).on('click', '.pagination a', function (e) {
                getNext($(this).attr('href').split('page=')[1]);
                e.preventDefault();
            });
        });

        function all_status(){
            if(nbr_interval==0){
                var id = setInterval(function(){ status(id) ;},3000);
                nbr_interval++;
            }
        }

        function getNext(page){
            $.ajax({
                url : '?page=' + page
            }).done(function (data) {
                $('#main_wrapper').html(data);
                location.hash = page;
            }).fail(function () {
                alert('next page could not be loaded.');
            });
        }

        function resume(a){
            $.ajax({
                type: 'post',
                url:  "campaigns/"+ a.data('id')+"/resume",
                data: {_token: '{{csrf_token()}}' },
                success: function (data) {
                    alert('in progress');
                    a.parent().html("in progress : " +
                    "<span class='el-icon-pause bs_ttip' title='click to pause' onclick='pause($(this));' data-id='"+a.data('id')+"'></span>");
                    all_status();
                }
            });


        }

        function pause(a){
            $.ajax({
                type: 'post',
                url: "campaigns/"+ a.data('id')+"/pause",
                data: {_token: '{{csrf_token()}}' },
                success: function (data) {
                    alert('paused');
                    a.parent().html("paused : " +
                    "<span class='el-icon-play bs_ttip' title='click to resume' onclick='resume($(this));' data-href='"+a.data('id')+"'></span>");
                }
            });

        }

        function status(id){
            console.log('id :' + id);
            var arr = $("table td:nth-child(3) span.el-icon-pause");
            if(arr.length == 0){
                clearInterval(id);
                nbr_interval =0;
                }
            else{
                var ids = $.map(arr,function(n){return $(n).data('id');});
                $.ajax({
                    type: 'post',
                    url: "{{ URL::to('campaigns/status') }}",
                    data: {ids: ids,_token: '{{csrf_token()}}' },
                    success: function (data) {
                        var new_arr = diffArrays(ids,data);
                        if(new_arr.length != 0){
                            $(new_arr).each(function(i,n){
                                //console.log(n); //alert this campaign was sent
                                $("span[data-id='"+n+"']").parent().text('sent');
                            });
                        }
                    }
                });
            }
        }

        function compareArrays(arr1, arr2) {
            return $(arr1).not(arr2).length == 0 && $(arr2).not(arr1).length == 0
        };

        function diffArrays(old_array, new_array) {
            return $(old_array).not(new_array).get();
        };


    </script>
@endsection