<table class="table table-responsive" id="typecontacts-table">
    <thead>
        <th>Nombre</th>
        <th>Activa</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($typecontacts as $typecontact)
        <tr>
            <td>{!! $typecontact->nombre !!}</td>
            <td>{!! $typecontact->activa !!}</td>
            <td>{!! $typecontact->created_at !!}</td>
            <td>{!! $typecontact->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['admin.typecontacts.destroy', $typecontact->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.typecontacts.show', [$typecontact->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admin.typecontacts.edit', [$typecontact->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
