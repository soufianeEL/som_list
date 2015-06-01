<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">Edit Affiliate</h4>
        </div>
        {!! Form::model($affiliate, ['method' => 'PATCH', 'route' => ['affiliates.update', $affiliate->id], 'class' => 'form-horizontal']) !!}
        <div class="modal-body">
            @include('affiliates/_form_modal', ['submit_text' => 'Create Affiliate'])
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default btn" data-dismiss="modal">Close</button>
            {!! Form::submit('Edit', array('class' => 'btn btn-primary btn')) !!}
        </div>
        {!! Form::close() !!}
    </div>
</div>