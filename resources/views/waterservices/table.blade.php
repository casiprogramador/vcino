<table class="table table-responsive" id="waterservices-table">
    <thead>
        <th>Nombre</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($waterservices as $waterservice)
        <tr>
            <td>{!! $waterservice->nombre !!}</td>
            <td>{!! $waterservice->created_at !!}</td>
            <td>{!! $waterservice->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['admin.waterservices.destroy', $waterservice->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.waterservices.show', [$waterservice->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admin.waterservices.edit', [$waterservice->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
