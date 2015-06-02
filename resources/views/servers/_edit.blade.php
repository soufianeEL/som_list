<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">Edit Server</h4>
        </div>
        {!! Form::model($server, ['method' => 'PATCH', 'route' => ['servers.update', $server->id], 'class' => 'form-horizontal']) !!}
        <div class="modal-body">
            @include('servers/_form_modal')
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default btn" data-dismiss="modal">Close</button>
            {!! Form::submit('Edit', array('class' => 'btn btn-primary btn')) !!}
        </div>
        {!! Form::close() !!}
    </div>
</div>
