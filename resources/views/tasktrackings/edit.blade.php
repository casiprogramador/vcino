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
                <a href="#">Tareas</a>
            </li>
            <li class="active">
                <strong>Seguimiento</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content" style="background-color: #f9f9f9;">                
                    <form method="get" class="form-horizontal">
                        <div class="form-group" style="margin-bottom: 0px;">
                            <label class="col-sm-2 control-label">Fecha:</label>
                            <div class="col-sm-4">
                                <p class="form-control-static">{{ date_format(date_create($task->fecha),'d/m/Y') }}</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="form-control-static pull-right">
									@if($task->estado_solicitud == 'pendiente')
                                    <span class="label label-warning" style="font-size: 10px; background-color: #F7B77B;">&nbsp;{{strtoupper($task->estado_solicitud)}}&nbsp;</span>
									@elseif($task->estado_solicitud == 'en proceso')
									<span class="label label-success" style="font-size: 9px; background-color: #5D96CC">&nbsp;EN PROCESO&nbsp;</span>
									@else
									<span class="label label-primary" style="font-size: 9px; background-color: #5CBD7E">COMPLETADA</span>
									@endif
                                </p>
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom: 0px;">
                            <label class="col-sm-2 control-label">Tipo:</label>
                            <div class="col-sm-4">
                                <p class="form-control-static">
								
								@if($task->tipo_tarea == 'mis_tareas')
									MIS TAREAS

								@elseif($task->tipo_tarea =='solicitudes_recibidas')
									SOLICITUDES RECIBIDAS

								@elseif($task->tipo_tarea =='reserva_instalaciones')
									RESERVA DE INSTALACION

								@elseif($task->tipo_tarea =='reclamos')
									RECLAMOS

								@elseif($task->tipo_tarea =='sugerencias')
									SUGERENCIAS

								@elseif($task->tipo_tarea =='notificacion_mudanza')
									NOTIFICACION DE MUDANZA

								@elseif($task->tipo_tarea =='notificacion_trabajos')
									NOTIFICACION DE TRABAJO

								@endif
								</p>
                            </div>
                            <label class="col-sm-2 control-label">Solicitada por:</label>
                            <div class="col-sm-4">
                                <p class="form-control-static">
								@if($task->tipo_tarea == 'mis_tareas')

									Administración
								@elseif($task->tipo_tarea =='solicitudes_recibidas')

									{{$task->taskrequest->contact->nombre}} {{$task->taskrequest->contact->apellido}} {{$task->taskrequest->property->nro}}
								@elseif($task->tipo_tarea =='reserva_instalaciones')

									{{$task->taskreservation->contact->nombre}} {{$task->taskreservation->contact->apellido}} {{$task->taskreservation->property->nro}}
								@elseif($task->tipo_tarea =='reclamos')
						
									{{$task->taskrequest->contact->nombre}} {{$task->taskrequest->contact->apellido}} {{$task->taskrequest->property->nro}}
								@elseif($task->tipo_tarea =='sugerencias')
									
									{{$task->taskrequest->contact->nombre}} {{$task->taskrequest->contact->apellido}} {{$task->taskrequest->property->nro}}
								@elseif($task->tipo_tarea =='notificacion_mudanza')
								
									{{$task->taskrequest->contact->nombre}} {{$task->taskrequest->contact->apellido}} {{$task->taskrequest->property->nro}}
								@elseif($task->tipo_tarea =='notificacion_trabajos')
					
									{{$task->taskrequest->contact->nombre}} {{$task->taskrequest->contact->apellido}} {{$task->taskrequest->property->nro}}
								@endif
								</p>
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom: 0px;">
                            <label class="col-sm-2 control-label">Tarea:</label>
                            <div class="col-sm-10">
                                <p class="form-control-static"><strong>{{$task->titulo_tarea}}</strong></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5 style="padding-top: 2px;">Editar seguimiento</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">    
                    <div class="col-sm-12">

						{!! Form::open(array('route' => array('taskrequest.tasktracking.update', Crypt::encrypt($tasktracking->id)),'method' => 'post' ,'class' => 'form-horizontal', 'files' => true)) !!}
						<input type="hidden" name="task_id" value="{{$task->id}}">
                            <div class="form-group{{ $errors->has('fecha') ? ' has-error' : '' }}">
                                <label class="font-normal">Fecha</label>
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									<input type="text" class="form-control date-picker" name="fecha" value="{{ date_format(date_create($tasktracking->fecha),'d/m/Y') }}">
                                </div>
								@if ($errors->has('fecha'))
								<span class="help-block">
										<strong>{{ $errors->first('fecha') }}</strong>
									</span>
								@endif
                            </div>

                            <div class="form-group">
                                <label class="font-normal">Descripción</label>
                                <div class="ibox-content no-padding">
									<textarea id="summernote" name="descripcion">{{$tasktracking->descripcion}}</textarea>
								</div>
                            </div>

                            <div class="form-group">
                                <label class="font-normal">Adjunto</label>
                                <div id="adjunto-1" class="fileinput input-group {{!empty($tasktracking->adjunto) ? 'fileinput-exists'  : 'fileinput-new'}}" data-provides="fileinput">
                                <div class="form-control" data-trigger="fileinput">
                                    <i class="glyphicon glyphicon-file fileinput-exists"></i> 
                                    <span class="fileinput-filename">{{ (!empty($tasktracking->adjunto) ) ? MenuRoute::filename($tasktracking->adjunto) : "" }}</span>
                                </div>
                                <span class="input-group-addon btn btn-default btn-file">
                                    <span class="fileinput-new">Seleccionar archivo...</span>
                                    <span class="fileinput-exists">Cambiar</span>
                                    <input type="hidden" id="adjunto-ori" name="adjunto_ori" value="{{ (isset($tasktracking->adjunto) ) ? $tasktracking->adjunto : '' }}">
									<input type="file" name="adjunto">
                                </span>
                                <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Eliminar</a>
                            </div>
                            </div>

                            <div class="form-group" style="margin-top: 20px;">
                                <label class="font-normal">Creado por:&nbsp;&nbsp;</label>
                                    <span style="font-weight: normal;">{{ Auth::user()->nombre }}</span>
                                </label>
                            </div>

                            <div class="form-group">
                                <label class="font-normal">
                                <div class="icheckbox_square-green" style="position: relative;">
                                    <input type="checkbox" class="i-checks" name="notificar" value="1" {{ $tasktracking->notificar == '1' ? 'checked' : '' }}>
                                </div>&nbsp;&nbsp;&nbsp;Notificar respuesta</label>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <button class="btn btn-success" type="submit" style="margin-right: 10px;">Editar seguimiento</button>
                            </div>
                        {!! Form::close() !!}
                    </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="row">
				
				@foreach($tasktrackings as $tasktracking)

                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5 style="padding-top: 2px;">
                            <span style="font-weight: normal">Creado por:</span> 
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
                            </h5>
                            <h5 class="pull-right" style="margin-right: 10px;">{{date_format(date_create($tasktracking->fecha),'d/m/Y')}}</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="row">    
                            <div class="col-sm-12">
                                <form role="form">
                                    <div class="form-group">
                                        <label class="font-normal">Descripción</label>
                                        <?php echo $tasktracking->descripcion ?>
                                    </div>

                                    <div class="hr-line-dashed"></div>
									@if(!empty($tasktracking->adjunto))
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="file-box">
                                                <div class="file">
                                                    <a href="#">
                                                        <div class="image">
                                                            <img alt="image" class="img-responsive" src="{{ $tasktracking->adjunto }}">
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
									@endif
                                    <div class="hr-line-dashed"></div>

                                    <div class="form-group" style="margin-top: 20px;">
                                        <label class="font-normal">
                                        <div class="icheckbox_square-green" style="position: relative;">
                                            <input type="checkbox" class="i-checks" name="activa" value="1" style="position: absolute; opacity: 0;" {{ ($tasktracking->notificar == 1) ? 'checked' : '' }} disabled="disabled">
                                        </div>&nbsp;&nbsp;&nbsp;Notificar respuesta</label>
                                    </div>
                                    
                                    <div class="hr-line-dashed"></div>

                                    <div class="form-group">
                                       <a href="{{ route('taskrequest.tasktracking.edit', array(Crypt::encrypt($task->id),Crypt::encrypt($tasktracking->id))) }}" class="btn btn-default" type="submit" style="margin-right: 10px;">Editar</a>
                                    </div>
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
				@endforeach
            </div>
        </div>

    </div>
</div>

@endsection

@section('style')
<link rel="stylesheet" href="{{ URL::asset('css/summernote.css') }}" />
@endsection
@section('javascript')
<!--Lenguaje datepicker español-->
<script type="text/javascript" src="{{ URL::asset('js/moment.es.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/summernote.min.js') }}"></script>

<script>
	$(document).ready(function(){
		$('#summernote').summernote({
			height: 300,
			toolbar: [
			    ['style', ['style']],
			    ['font', ['bold', 'italic', 'underline']],
			    ['color', ['color']],
			    ['para', ['ul', 'ol', 'paragraph']],
			    ['insert', ['hr']],
			    ['view', ['codeview']],
			    ['help', ['help']]
			],
		});
		$('.date-picker').datetimepicker({
			locale:'es',
			format: 'DD/MM/YYYY',
				widgetPositioning: {
				horizontal: 'left',
						vertical: 'bottom'
				}
			});
		
		$('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
		$('#adjunto').on('clear.bs.fileinput', function(event) {
			$('#adjunto-ori').val('');
		});
	});
	</script>
@endsection
