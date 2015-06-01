<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">Create Creative for offer "{{ $offer->name }}"</h4>
        </div>
        {!! Form::model($creative, ['method' => 'PATCH', 'enctype' => "multipart/form-data", 'class' => 'form-horizontal', 'route' => ['offers.creatives.update',$offer ,$creative]]) !!}
        <div class="modal-body">
            @include('creatives/_form_modal',['files' => true])
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default btn" data-dismiss="modal">Close</button>
            {!! Form::submit('Edit', array('class' => 'btn btn-primary btn')) !!}
        </div>
        {!! Form::close() !!}
    </div>
</div>

