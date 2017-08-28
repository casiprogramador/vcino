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
            <li>
                <a href="{{ route('taskrequest.task.index') }}">Tareas</a>
            </li>
            <li class="active">
                <strong>Lista de seguimiento a tareas</strong>
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
                    <h5 style="padding-top: 2px;">Lista de seguimiento a tareas</h5>
                </div>
                <div class="ibox-content">

                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th style="vertical-align:bottom">Fecha Seg.</th>
                                <th style="vertical-align:bottom">Tarea</th>
                                <th style="vertical-align:bottom">Tipo</th>
                                <th style="vertical-align:bottom">Creado por</th>
                                <th style="vertical-align:bottom" width="150"></th>
                            </tr>
                        </thead>
                        <tbody>
							@foreach ($tasktrackings as $tasktracking)
                            <tr>
                                <td data-order="{{ $tasktracking->created_at }}">{{ date_format(date_create($tasktracking->fecha),'d/m/Y') }}</td>
                                <td>{{$tasktracking->task->titulo_tarea}} ({{date_format(date_create($tasktracking->task->fecha),'d/m/Y')}})</td>
                                <td>
								@if($tasktracking->task->tipo_tarea == 'mis_tareas')
									Mis tareas

								@elseif($tasktracking->task->tipo_tarea =='solicitudes_recibidas')
									Solicitudes recibidas

								@elseif($tasktracking->task->tipo_tarea =='reserva_instalaciones')
									Reserva de instalación

								@elseif($tasktracking->task->tipo_tarea =='reclamos')
									Reclamo

								@elseif($tasktracking->task->tipo_tarea =='sugerencias')
									Sugerencia

								@elseif($tasktracking->task->tipo_tarea =='notificacion_mudanza')
									Notificación de mudanza

								@elseif($tasktracking->task->tipo_tarea =='notificacion_trabajos')
									Notificación de trabajo
								@endif
								</td>
                                <td>
								@if($tasktracking->task->tipo_tarea == 'mis_tareas')
									Administración
								@elseif($tasktracking->task->tipo_tarea =='solicitudes_recibidas')
									{{$tasktracking->task->taskrequest->property->nro}} - {{$tasktracking->task->taskrequest->contact->nombre}} {{$tasktracking->task->taskrequest->contact->apellido}}
								@elseif($tasktracking->task->tipo_tarea =='reserva_instalaciones')

									{{$tasktracking->task->taskreservation->property->nro}} - {{$tasktracking->task->taskreservation->contact->nombre}} {{$tasktracking->task->taskreservation->contact->apellido}} 
								@elseif($tasktracking->task->tipo_tarea =='reclamos')
						
									{{$tasktracking->task->taskrequest->property->nro}} - {{$tasktracking->task->taskrequest->contact->nombre}} {{$tasktracking->task->taskrequest->contact->apellido}} 
								@elseif($tasktracking->task->tipo_tarea =='sugerencias')
									
									{{$tasktracking->task->taskrequest->property->nro}} - {{$tasktracking->task->taskrequest->contact->nombre}} {{$tasktracking->task->taskrequest->contact->apellido}} 
								@elseif($tasktracking->task->tipo_tarea =='notificacion_mudanza')
								
									{{$tasktracking->task->taskrequest->property->nro}} - {{$tasktracking->task->taskrequest->contact->nombre}} {{$tasktracking->task->taskrequest->contact->apellido}} 
								@elseif($tasktracking->task->tipo_tarea =='notificacion_trabajos')
					
									{{$tasktracking->task->taskrequest->property->nro}} - {{$tasktracking->task->taskrequest->contact->nombre}} {{$tasktracking->task->taskrequest->contact->apellido}} 
								@endif
								</td>
                                <td style="vertical-align:middle; text-align:right;">
                                    <div class="btn-group">
                                        <a href="{{ route('taskrequest.tasktracking.create', Crypt::encrypt($tasktracking->task->id)) }}" class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Ver seguimiento tarea">
                                            <i class="fa fa-eye"></i>
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
                "order": [[ 0, "desc" ]],
                "pageLength": 100,
                "lengthMenu": [ [25, 50, 100, -1], [25, 50, 100, "Todos"] ],
                "bLengthChange" : false,
                "info":     false,
                "columnDefs": [ { "orderable": false, "targets": 4 } ]
            });
        } );
    </script>
@endsection

