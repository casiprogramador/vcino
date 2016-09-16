<table class="table table-responsive" id="electricservices-table">
    <thead>
        <th>Nombre</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($electricservices as $electricservice)
        <tr>
            <td>{!! $electricservice->nombre !!}</td>
            <td>{!! $electricservice->created_at !!}</td>
            <td>{!! $electricservice->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['admin.electricservices.destroy', $electricservice->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.electricservices.show', [$electricservice->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admin.electricservices.edit', [$electricservice->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
