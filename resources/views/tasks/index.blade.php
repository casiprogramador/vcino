@extends('layouts.admin')

@section('admin-content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Tareas</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.home') }}">Inicio</a>
            </li>
            <li>
                Tareas & Solicitudes
            </li>
            <li class="active">
                <strong>Tareas</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
			@if (Session::has('message'))
				<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					{!! session('message') !!}
				</div>
			@endif
            <div class="ibox">
                <div class="ibox-title">
                    <h5 style="padding-top: 7px;">Lista de tareas</h5>
                    <div class="ibox-tools" style="padding-bottom: 7px; padding-right: 5px;">
                        <div class="btn-group">
                            <a href="{{ route('taskrequest.task.create') }}" class="btn btn-sm btn-success" style="color: white; margin-right: 10px;">Nueva tarea</a>
                        </div>
                        <div class="btn-group">
                            <a href="{{ route('taskrequest.tasktracking.index') }}" class="btn btn-sm btn-default" style="color: black; ">Seguimiento tareas</a>
                        </div>
                    </div>
                </div>
                <div class="ibox-content">
				{!! Form::open(array('route' => 'taskrequest.task.search', 'class' => 'form-horizontal')) !!}
				<div class="row">
                    <div class="col-sm-4 m-b-xs">
						{{ Form::select('tipo_tarea',
							array(
							'todos' => 'Tipo: Todas',
							'mis_tareas' => 'Mis tareas',
							'solicitudes_recibidas' => 'Solicitudes recibidas',
							'reserva_instalaciones' => 'Reserva de instalaciones',
							'reclamos' => 'Reclamos',
							'sugerencias' => 'Sugerencias',
							'notificacion_mudanza' => 'Notificacion de mudanza',
							'notificacion_trabajos' => 'Notificacion de trabajos'
							),
							old('tipo_tarea'),
							['class' => 'input-sm form-control input-s-sm inline','id' => 'tipo-tarea']) }}
                    </div>
                    <div class="col-sm-3 m-b-xs">
                        <select class="input-sm form-control input-s-sm inline" name="estado">
                            <option value="todos">Estado: Todas</option>
                            <option value="pendiente">Pendientes</option>
                            <option value="en proceso">En proceso</option>
                            <option value="completada">Completadas</option>
                        </select>
                    </div>
                    <div class="col-sm-3 m-b-xs">
                        <select class="input-sm form-control input-s-sm inline" name="prioridad">
                            <option value="todos">Prioridad: Todas</option>
                            <option value="alta">Alta</option>
                            <option value="normal">Normal</option>
                        </select>
                    </div>
                    <div class="col-sm-2 m-b-xs text-right">
                        <button class="btn btn-white btn-sm" type="submit" style="width: 100%;">Buscar</button>
                    </div>
                </div>
				{!! Form::close() !!}
                <div class="row">
                    <div class="col-sm-12 m-b-xs">
                        <hr>
                    </div>
                </div>

                <!--        Lista todas las tereas EN PROCESO y PENDIENTES              -->
                <!--        El orden de la mas nueva a la más antigua                   -->

                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th style="vertical-align:bottom; width: 20px;"></th>
                                <th style="vertical-align:bottom">Estado</th>
                                <th style="vertical-align:bottom">Fecha Sol.</th>
                                <th style="vertical-align:bottom">Tarea</th>
                                <th style="vertical-align:bottom">Tipo</th>
                                <th style="vertical-align:bottom">Solicitada por</th>
                                <th style="vertical-align:bottom" width="150"></th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
								@foreach ($tasks as $task)
                                <td data-order="{{ $task->prioridad }}">
									@if($task->prioridad == 'alta')
									<i class="fa fa-exclamation-circle fa-lg text-danger" aria-hidden="true"></i>
									@endif
								</td>
                                <td>
									@if($task->estado_solicitud == 'pendiente')
                                    <span class="label label-warning" style="font-size: 10px; background-color: #F7B77B;">&nbsp;{{strtoupper($task->estado_solicitud)}}&nbsp;</span>
									@elseif($task->estado_solicitud == 'en proceso')
									<span class="label label-success" style="font-size: 9px; background-color: #5D96CC">&nbsp;EN PROCESO&nbsp;</span>
									@else
									<span class="label label-primary" style="font-size: 9px; background-color: #5CBD7E">COMPLETADA</span>
									@endif
                                </td>
                                <td data-order="{{ $task->fecha }}">{{ date_format(date_create($task->fecha),'d/m/Y') }}</td>
                                <td>{{$task->titulo_tarea}}</td>
								@if($task->tipo_tarea == 'mis_tareas')
									<td>Mis tareas</td>
									<td>Administración</td>
								@elseif($task->tipo_tarea =='solicitudes_recibidas')
									<td>Solicitud recibida</td>
									<td>{{$task->taskrequest->property->nro}} - {{$task->taskrequest->contact->nombre}} {{$task->taskrequest->contact->apellido}}</td>
								@elseif($task->tipo_tarea =='reserva_instalaciones')
									<td>Reserva de instalación</td>
									<td>{{$task->taskreservation->property->nro}} - {{$task->taskreservation->contact->nombre}} {{$task->taskreservation->contact->apellido}}</td>
								@elseif($task->tipo_tarea =='reclamos')
									<td>Reclamo</td>
									<td>{{$task->taskrequest->property->nro}} - {{$task->taskrequest->contact->nombre}} {{$task->taskrequest->contact->apellido}}</td>
								@elseif($task->tipo_tarea =='sugerencias')
									<td>Sugerencia</td>
									<td>{{$task->taskrequest->property->nro}} - {{$task->taskrequest->contact->nombre}} {{$task->taskrequest->contact->apellido}}</td>
								@elseif($task->tipo_tarea =='notificacion_mudanza')
									<td>Notificación de mudanza</td>
									<td>{{$task->taskrequest->property->nro}} - {{$task->taskrequest->contact->nombre}} {{$task->taskrequest->contact->apellido}}</td>
								@elseif($task->tipo_tarea =='notificacion_trabajos')
									<td>Notificación de trabajo</td>
									<td>{{$task->taskrequest->property->nro}} - {{$task->taskrequest->contact->nombre}} {{$task->taskrequest->contact->apellido}}</td>
								@endif
                                
                                <td style="vertical-align:middle; text-align:right;">
									@if($task->tipo_tarea == 'mis_tareas' || $task->tipo_tarea =='solicitudes_recibidas' || $task->tipo_tarea =='reserva_instalaciones' || $task->tipo_tarea =='reclamos')	
                                    <div class="btn-group" style="padding-right: 10px;">
                                        <a style="width: 50px; text-align: left;" href="{{ route('taskrequest.tasktracking.create', Crypt::encrypt($task->id)) }}" class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Seguimiento">
                                            <i class="fa fa-exchange"></i> ({{$task->tasktrackings->count()}})
                                        </a>
										
                                    </div>
									@endif
                                    <div class="btn-group">
                                        <a href="{{ route('taskrequest.task.show', Crypt::encrypt($task->id)) }}" class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Ver tarea">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('taskrequest.task.copy', Crypt::encrypt($task->id)) }}" class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Copiar tarea...">
											<i class="fa fa-files-o"></i>
										</a>                                        
                                        <a href="{{ route('taskrequest.task.edit', Crypt::encrypt($task->id)) }}" class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Editar tarea">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                    </div>
                               </td>
                            </tr>
							@endforeach

                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection

@section('style')
    <link rel="stylesheet" href="{{ URL::asset('css/datatables.min.css') }}" />
@endsection

@section('javascript')
    <script type="text/javascript" src="{{ URL::asset('js/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.table').DataTable({
                "language": {
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados.",
                    "sEmptyTable":     "No se encontraron tareas.",
                    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                },
                "order": [[ 0, "asc" ], [ 2, "desc" ]],
                "pageLength": 100,
                "lengthMenu": [ [25, 50, 100, -1], [25, 50, 100, "Todos"] ],
                "bLengthChange" : false,
                "info":     false,
                "columnDefs": [ { "orderable": false, "targets": 1 }, { "orderable": false, "targets": 6 } ]
            });
        } );
    </script>
@endsection


