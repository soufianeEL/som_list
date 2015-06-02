<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">Info's Ip</h4>
        </div>
        <div class="modal-body">
            <h4>Domain : {{ $ip->domain }}</h4>
            <h4>ip :  {{ $ip->ip }}</h4>
            <h4>vmta :  {{ $ip->vmta }}</h4>
            <h4>active: {{ $ip->active }}</h4>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default btn" data-dismiss="modal">Close</button>
            <a class="btn btn-small btn-info" onclick="Modal($(this));" data-href="{{$server->id .'/ips/'.$ip->id.'/edit'}}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
        </div>
    </div>
</div>


