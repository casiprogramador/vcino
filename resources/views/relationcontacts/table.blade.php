<table class="table table-responsive" id="relationcontacts-table">
    <thead>
        <th>Nombre</th>
        <th>Activa</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($relationcontacts as $relationcontact)
        <tr>
            <td>{!! $relationcontact->nombre !!}</td>
            <td>{!! $relationcontact->activa !!}</td>
            <td>{!! $relationcontact->created_at !!}</td>
            <td>{!! $relationcontact->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['admin.relationcontacts.destroy', $relationcontact->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.relationcontacts.show', [$relationcontact->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admin.relationcontacts.edit', [$relationcontact->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
