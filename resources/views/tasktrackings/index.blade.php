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
                <strong>Lista de seguimiento a tareas</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">

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
                                <td>{{ date_format(date_create($tasktracking->fecha),'d/m/Y') }}</td>
                                <td>{{$tasktracking->task->titulo_tarea}} ({{date_format(date_create($tasktracking->task->fecha),'d/m/Y')}})</td>
                                <td>
								@if($tasktracking->task->tipo_tarea == 'mis_tareas')
									MIS TAREAS

								@elseif($tasktracking->task->tipo_tarea =='solicitudes_recibidas')
									SOLICITUDES RECIBIDAS

								@elseif($tasktracking->task->tipo_tarea =='reserva_instalaciones')
									RESERVA DE INSTALACION

								@elseif($tasktracking->task->tipo_tarea =='reclamos')
									RECLAMOS

								@elseif($tasktracking->task->tipo_tarea =='sugerencias')
									SUGERENCIAS

								@elseif($tasktracking->task->tipo_tarea =='notificacion_mudanza')
									NOTIFICACION DE MUDANZA

								@elseif($tasktracking->task->tipo_tarea =='notificacion_trabajos')
									NOTIFICACION DE TRABAJO

								@endif
								</td>
                                <td>
								@if($tasktracking->task->tipo_tarea == 'mis_tareas')

									Administración
								@elseif($tasktracking->task->tipo_tarea =='solicitudes_recibidas')

									{{$tasktracking->task->taskrequest->contact->nombre}} {{$tasktracking->task->taskrequest->contact->apellido}} {{$tasktracking->task->taskrequest->property->nro}}
								@elseif($tasktracking->task->tipo_tarea =='reserva_instalaciones')

									{{$tasktracking->task->taskreservation->contact->nombre}} {{$tasktracking->task->taskreservation->contact->apellido}} {{$tasktracking->task->taskreservation->property->nro}}
								@elseif($tasktracking->task->tipo_tarea =='reclamos')
						
									{{$tasktracking->task->taskrequest->contact->nombre}} {{$tasktracking->task->taskrequest->contact->apellido}} {{$tasktracking->task->taskrequest->property->nro}}
								@elseif($tasktracking->task->tipo_tarea =='sugerencias')
									
									{{$tasktracking->task->taskrequest->contact->nombre}} {{$tasktracking->task->taskrequest->contact->apellido}} {{$tasktracking->task->taskrequest->property->nro}}
								@elseif($tasktracking->task->tipo_tarea =='notificacion_mudanza')
								
									{{$tasktracking->task->taskrequest->contact->nombre}} {{$tasktracking->task->taskrequest->contact->apellido}} {{$tasktracking->task->taskrequest->property->nro}}
								@elseif($tasktracking->task->tipo_tarea =='notificacion_trabajos')
					
									{{$tasktracking->task->taskrequest->contact->nombre}} {{$tasktracking->task->taskrequest->contact->apellido}} {{$tasktracking->task->taskrequest->property->nro}}
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