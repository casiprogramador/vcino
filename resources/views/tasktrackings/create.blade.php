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
									Mis tareas

								@elseif($task->tipo_tarea =='solicitudes_recibidas')
									Solicitud recibida

								@elseif($task->tipo_tarea =='reserva_instalaciones')
									Reserva de instalación

								@elseif($task->tipo_tarea =='reclamos')
									Reclamo

								@elseif($task->tipo_tarea =='sugerencias')
									Sugerencia

								@elseif($task->tipo_tarea =='notificacion_mudanza')
									Notificación de mudanza

								@elseif($task->tipo_tarea =='notificacion_trabajos')
									Notificación de trabajo

								@endif
								</p>
                            </div>
                            <label class="col-sm-2 control-label">Solicitada por:</label>
                            <div class="col-sm-4">
                                <p class="form-control-static">
								@if($task->tipo_tarea == 'mis_tareas')

									Administración
								@elseif($task->tipo_tarea =='solicitudes_recibidas')

									{{$task->taskrequest->property->nro}} - {{$task->taskrequest->contact->nombre}} {{$task->taskrequest->contact->apellido}} 
								@elseif($task->tipo_tarea =='reserva_instalaciones')

									{{$task->taskreservation->property->nro}} - {{$task->taskreservation->contact->nombre}} {{$task->taskreservation->contact->apellido}} 
								@elseif($task->tipo_tarea =='reclamos')
						
									{{$task->taskrequest->property->nro}} - {{$task->taskrequest->contact->nombre}} {{$task->taskrequest->contact->apellido}} 
								@elseif($task->tipo_tarea =='sugerencias')
									
									{{$task->taskrequest->property->nro}} - {{$task->taskrequest->contact->nombre}} {{$task->taskrequest->contact->apellido}} 
								@elseif($task->tipo_tarea =='notificacion_mudanza')
								
									{{$task->taskrequest->property->nro}} - {{$task->taskrequest->contact->nombre}} {{$task->taskrequest->contact->apellido}} 
								@elseif($task->tipo_tarea =='notificacion_trabajos')
					
									{{$task->taskrequest->property->nro}} - {{$task->taskrequest->contact->nombre}} {{$task->taskrequest->contact->apellido}} 
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
                    <h5 style="padding-top: 2px;">Nuevo seguimiento</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-12">
                            {!! Form::open(array('route' => 'taskrequest.tasktracking.store', 'class' => 'form', 'files' => true)) !!}

                            <input type="hidden" name="task_id" value="{{$task->id}}">

                            <div class="form-group {{ $errors->has('fecha') ? ' has-error' : '' }}">
                                <label class="font-normal">Fecha</label>
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
    								<input type="text" class="form-control date-picker" name="fecha" value="{{ date('d/m/Y') }}">
                                </div>
    							@if ($errors->has('fecha'))
    							<span class="help-block">
    									<strong>{{ $errors->first('fecha') }}</strong>
    								</span>
    							@endif
                            </div>

                            <div class="form-group">
                                <label class="font-normal">Descripción</label>
                                <div class="no-padding">
    								<textarea id="summernote" name="descripcion">{{old('descripcion')}}</textarea>
    							</div>
                            </div>

                            <div class="form-group">
                                <label class="font-normal">Adjunto <span style="font-weight: normal;">(Sólo imágenes)</span></label>
                                <div class="fileinput input-group fileinput-new" data-provides="fileinput">
                                    <div class="form-control" data-trigger="fileinput">
                                        <i class="glyphicon glyphicon-file fileinput-exists"></i> 
                                        <span class="fileinput-filename"></span>
                                    </div>
                                    <span class="input-group-addon btn btn-default btn-file">
                                        <span class="fileinput-new">Seleccionar archivo...</span>
                                        <span class="fileinput-exists">Cambiar</span>
                                        <input type="file" name="adjunto">
                                    </span>
                                    <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Eliminar</a>
                                </div>
                                <span class="help-block m-b-none"></span>
								@if ($errors->has('adjunto'))
								<div class="has-error">
    							<span class="help-block">
    									<strong>{{ $errors->first('adjunto') }}</strong>
    								</span>
									</div>
    							@endif
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="checkbox checkbox-primary" style="display:none">
                                <input id="checkbox2" type="checkbox" name="notificar" value="1" checked>
                                <label for="checkbox2">
                                    Notificar respuesta
                                </label>
                            </div>

                            <div class="form-group" style="margin-top: 20px; display: none;">
                                <label class="font-normal">Creado por:&nbsp;&nbsp;</label>
                                    <span style="font-weight: normal;">{{ Auth::user()->nombre }}</span>
                                </label>
                            </div>

                            <div class="hr-line-dashed" style="display: none;"></div>

                            <div class="form-group">
                                <button class="btn btn-success" type="submit" style="margin-right: 10px;">Crear seguimiento</button>
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
                            <h5 style="padding-top: 2px;">{{date_format(date_create($tasktracking->fecha),'d/m/Y')}}</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="row">    
                            <div class="col-sm-12">
                                <div role="form">
                                    <div class="form-group">
                                        <?php echo $tasktracking->descripcion ?>
                                    </div>

                                    <div class="hr-line-dashed"></div>
									@if(!empty($tasktracking->adjunto))
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="file-box">
                                                
                                                <?php
                                                $filename = explode("-name-", $tasktracking->adjunto);
                                                $ext_array = explode(".", $tasktracking->adjunto);
                                                $ext = end($ext_array);
                                                ?>

                                                @if($ext == 'jpg' || $ext == 'png')
                                                <div class="file">
                                                    <div class="image">
                                                        <a href="{{ URL::asset($tasktracking->adjunto)}}" target="_blank">
                                                        <img alt="image" class="img-responsive" src="{{ $tasktracking->adjunto }}">
                                                        </a>
                                                    </div>
                                                </div>
                                                @else
                                                <div class="file">
                                                    <a href="{{ URL::asset($tasktracking->adjunto)}}" target="_blank">
                                                        <h5 class="text-center"><i class="fa fa-file fa-2x"></i></h5>
                                                        <div class="caption">
                                                        <h5 class="text-center">{{$filename[1]}}</h5>
                                                        </div>
                                                    </a>
                                                </div>
                                                @endif
                                                        
                                            </div>
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
									@endif

                                    <div class="checkbox checkbox-primary" style="display: none;">
                                        <input id="checkbox2" type="checkbox" name="activa" value="1" {{ ($tasktracking->notificar == 1) ? 'checked' : '' }} disabled="disabled">
                                        <label for="checkbox2">
                                            Notificar respuesta
                                        </label>
                                    </div>


                                    <div class="form-group">
                                        <a href="{{ route('taskrequest.tasktracking.edit', array(Crypt::encrypt($task->id),Crypt::encrypt($tasktracking->id))) }}" class="btn btn-default" type="submit" style="margin-right: 10px;">Editar</a>
                                    </div>
									{!! Form::open(['route' => ['taskrequest.tasktracking.destroy', $tasktracking->id], 'method' => 'post']) !!}
					{!! Form::button('<i class="fa fa-trash"></i>&nbsp;&nbsp;Eliminar...', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('¿Está usted seguro de eliminar el registro?')"]) !!}
					{!! Form::close() !!}
                                </div>
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
    			height: 250,
    			toolbar: [
    			    ['style', ['style']],
    			    ['font', ['bold', 'italic', 'underline']],
    			    ['color', ['color']],
    			    ['para', ['ul', 'ol', 'paragraph']],
    			    ['insert', ['hr']]
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
    		    		
    	});
	</script>
@endsection
