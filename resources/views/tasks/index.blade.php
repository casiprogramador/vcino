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

            <div class="ibox">
                <div class="ibox-title">
                    <h5 style="padding-top: 7px;">Lista de tareas</h5>
                    <div class="ibox-tools" style="padding-bottom: 7px; padding-right: 5px;">
                        <div class="btn-group">
                            <a href="{{ route('taskrequest.task.create') }}" class="btn btn-sm btn-success" style="color: white; margin-right: 10px;">Nueva tarea</a>
                        </div>
                        <div class="btn-group">
                            <a href="" class="btn btn-sm btn-default" style="color: black; ">Seguimiento tareas</a>
                        </div>
                    </div>
                </div>
                <div class="ibox-content">

				<div class="row">
                    <div class="col-sm-4 m-b-xs">
                        <select class="input-sm form-control input-s-sm inline" name="Tipo">
                            <option value="todos">Tipo: Todas</option>
                            <option value="1">Mis tareas</option>
                            <option value="2">Notificación de mudanzas</option>
                            <option value="3">Notificación de trabajos o mejoras</option>
                            <option value="5">Reclamos</option>
                            <option value="6">Reservas de instalaciones</option>
                            <option value="7">Solicitudes recibidas</option>
                            <option value="8">Sugerencias</option>
                        </select>
                    </div>
                    <div class="col-sm-3 m-b-xs">
                        <select class="input-sm form-control input-s-sm inline" name="estado">
                            <option value="todos">Estado: Todas</option>
                            <option value="0">Pendientes</option>
                            <option value="1">En proceso</option>
                            <option value="2">Completadas</option>
                        </select>
                    </div>
                    <div class="col-sm-3 m-b-xs">
                        <select class="input-sm form-control input-s-sm inline" name="prioridad">
                            <option value="todos">Prioridad: Todas</option>
                            <option value="1">Alta</option>
                            <option value="0">Normal</option>
                        </select>
                    </div>
                    <div class="col-sm-2 m-b-xs text-right">
                        <button class="btn btn-white btn-sm" type="submit" style="width: 100%;">Buscar</button>
                    </div>
                </div>

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
                                <th style="vertical-align:bottom; width: 30px;"></th>
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
                                <td>
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
                                <td>{{ date_format(date_create($task->fecha),'d/m/Y') }}</td>
                                <td>{{$task->titulo_tarea}}</td>
								@if($task->tipo_tarea == 'mis_tareas')
									<td>MIS TAREAS</td>
									<td>Administración</td>
								@elseif($task->tipo_tarea =='solicitudes_recibidas')
									<td>SOLICITUDES RECIBIDAS</td>
									<td>{{$task->taskrequest->contact->nombre}} {{$task->taskrequest->contact->apellido}} {{$task->taskrequest->property->nro}}</td>
								@elseif($task->tipo_tarea =='reserva_instalaciones')
									<td>RESERVA DE INSTALACION</td>
									<td>{{$task->taskreservation->contact->nombre}} {{$task->taskreservation->contact->apellido}} {{$task->taskreservation->property->nro}}</td>
								@elseif($task->tipo_tarea =='reclamos')
									<td>RECLAMOS</td>
									<td>{{$task->taskrequest->contact->nombre}} {{$task->taskrequest->contact->apellido}} {{$task->taskrequest->property->nro}}</td>
								@elseif($task->tipo_tarea =='sugerencias')
									<td>SUGERENCIAS</td>
									<td>{{$task->taskrequest->contact->nombre}} {{$task->taskrequest->contact->apellido}} {{$task->taskrequest->property->nro}}</td>
								@elseif($task->tipo_tarea =='notificacion_mudanza')
									<td>NOTIFICACION DE MUDANZA</td>
									<td>{{$task->taskrequest->contact->nombre}} {{$task->taskrequest->contact->apellido}} {{$task->taskrequest->property->nro}}</td>
								@elseif($task->tipo_tarea =='notificacion_trabajos')
									<td>NOTIFICACION DE TRABAJO</td>
									<td>{{$task->taskrequest->contact->nombre}} {{$task->taskrequest->contact->apellido}} {{$task->taskrequest->property->nro}}</td>
								@endif
                                
                                <td style="vertical-align:middle; text-align:right;">
                                    <div class="btn-group" style="padding-right: 10px;">
                                        <a style="width: 50px; text-align: left;" href="" class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Seguimiento">
                                            <i class="fa fa-exchange"></i> (29)
                                        </a>
                                    </div>
                                    <div class="btn-group">
                                        <a href="" class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Ver tarea">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="" class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Copiar tarea...">
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