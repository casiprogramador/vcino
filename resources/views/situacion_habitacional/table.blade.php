<table class="table table-responsive" id="situacionHabitacional-table">
    <thead>
        <th>Nombre</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($situacionHabitacional as $situacionHabitacional)
        <tr>
            <td>{!! $situacionHabitacional->nombre !!}</td>
            <td>{!! $situacionHabitacional->created_at !!}</td>
            <td>{!! $situacionHabitacional->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['admin.situacionHabitacional.destroy', $situacionHabitacional->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.situacionHabitacional.show', [$situacionHabitacional->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admin.situacionHabitacional.edit', [$situacionHabitacional->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
