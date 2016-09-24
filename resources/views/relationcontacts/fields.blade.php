<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
</div>

<!-- Activa Field -->
<div class="form-group col-sm-6">
    {!! Form::label('activa', 'Activa:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('activa', false) !!}
        {!! Form::checkbox('activa', '1', null) !!} 1
    </label>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.relationcontacts.index') !!}" class="btn btn-default">Cancel</a>
</div>
