<table class="table table-responsive" id="tvservices-table">
    <thead>
        <th>Nombre</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($tvservices as $tvservice)
        <tr>
            <td>{!! $tvservice->nombre !!}</td>
            <td>{!! $tvservice->created_at !!}</td>
            <td>{!! $tvservice->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['admin.tvservices.destroy', $tvservice->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.tvservices.show', [$tvservice->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admin.tvservices.edit', [$tvservice->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
