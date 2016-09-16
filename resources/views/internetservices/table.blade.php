<table class="table table-responsive" id="internetservices-table">
    <thead>
        <th>Nombre</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($internetservices as $internetservice)
        <tr>
            <td>{!! $internetservice->nombre !!}</td>
            <td>{!! $internetservice->created_at !!}</td>
            <td>{!! $internetservice->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['admin.internetservices.destroy', $internetservice->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.internetservices.show', [$internetservice->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admin.internetservices.edit', [$internetservice->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
