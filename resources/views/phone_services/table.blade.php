<table class="table table-responsive" id="phoneServices-table">
    <thead>
        <th>Nombre</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($phoneServices as $phoneService)
        <tr>
            <td>{!! $phoneService->nombre !!}</td>
            <td>{!! $phoneService->created_at !!}</td>
            <td>{!! $phoneService->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['admin.phoneservices.destroy', $phoneService->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.phoneservices.show', [$phoneService->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admin.phoneservices.edit', [$phoneService->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
