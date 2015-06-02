<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">Create Ip</h4>
        </div>
        {!! Form::model($ip = new App\Models\Server, ['route' => ['servers.ips.store', $server], 'class' => 'form-horizontal']) !!}
        <div class="modal-body">
            @include('ips/_form_modal')
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default btn" data-dismiss="modal">Close</button>
            {!! Form::submit('Create', array('class' => 'btn btn-primary btn')) !!}
        </div>
        {!! Form::close() !!}
    </div>
</div>
