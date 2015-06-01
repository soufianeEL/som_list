<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">Edit Subject for offer "{{ $offer->name }}"</h4>
        </div>
        {!! Form::model($subject, ['method' => 'PATCH', 'route' => ['offers.subjects.update', $offer->id, $subject->id],'class' => 'form-horizontal']) !!}
        {{--{!! Form::model(new App\Models\Subject, ['route' => ['offers.subjects.store', $offer], 'class' => 'form-horizontal']) !!}--}}
        <div class="modal-body">
            @include('subjects/_form_modal')
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default btn" data-dismiss="modal">Close</button>
            {!! Form::submit('Edit', array('class' => 'btn btn-primary btn')) !!}
        </div>
        {!! Form::close() !!}
    </div>
</div>


