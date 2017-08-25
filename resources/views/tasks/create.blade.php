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
                <strong>Nueva tarea</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
			@if (Session::has('message'))
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {!! session('message') !!}
                    </div>
                @endif
            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <h5 style="padding-top: 2px;">Nueva tarea</h5>
                </div>

                <div class="ibox-content">
                    {!! Form::open(array('route' => 'taskrequest.task.store', 'class' => 'form-horizontal', 'files' => true)) !!}
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tipo</label>
                        <div class="col-sm-5">
							{{ Form::select('tipo_tarea',
							array(
							'0' => 'Seleccione una opción',
							'mis_tareas' => 'Mis tareas',
							'solicitudes_recibidas' => 'Solicitudes recibidas',
							'reserva_instalaciones' => 'Reserva de instalaciones',
							'reclamos' => 'Reclamos',
							'sugerencias' => 'Sugerencias',
							'notificacion_mudanza' => 'Notificación de mudanza',
							'notificacion_trabajos' => 'Notificación de trabajos'
							),
							old('tipo_tarea'),
							['class' => 'form-control input-sm','id' => 'tipo-tarea']) }}
							@if ($errors->has('tipo_tarea'))
								<span class="help-block">
									<strong>{{ $errors->first('tipo_tarea') }}</strong>
								</span>
							@endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('fecha') ? ' has-error' : '' }}" id="fecha-tarea">
                        <label class="col-sm-2 control-label">Fecha</label>
                        <div class="col-sm-3">
                            <div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" class="form-control input-sm date-picker" name="fecha" value="{{ date('d/m/Y') }}">
								@if ($errors->has('fecha'))
								<span class="help-block">
									<strong>{{ $errors->first('fecha') }}</strong>
								</span>
							@endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('titulo_tarea') ? ' has-error' : '' }}" id="titulo-tarea">
						<label class="col-sm-2 control-label">Tarea</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control input-sm" name="titulo_tarea" value="{{old('titulo_tarea')}}">
							@if ($errors->has('titulo_tarea'))
								<span class="help-block">
									<strong>{{ $errors->first('titulo_tarea') }}</strong>
								</span>
							@endif
                        </div>
                    </div>

                    <div class="form-group" id="nota">
						<label class="col-sm-2 control-label">Nota</label>
                        <div class="col-sm-10">
                            <div class="no-padding">
                                <textarea id="summernote" name="nota"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="hr-line-dashed" id="nota-linea"></div>

                    <div class="form-group" id="prioridad">
                        <label class="col-sm-2 control-label">Prioridad</label>
                        <div class="col-sm-3">
							{{ Form::select('prioridad',
							array(
							'normal' => 'Normal',
							'alta' => 'Alta',
							),
							old('prioridad'),
							['class' => 'form-control input-sm']) }}
							@if ($errors->has('prioridad'))
								<span class="help-block">
										<strong>{{ $errors->first('prioridad') }}</strong>
									</span>
							@endif
                        </div>
                    </div>

                    <div class="form-group" id="frecuencia">
                        <label class="col-sm-2 control-label">Frecuencia</label>
                        <div class="col-sm-3">
							{{ Form::select('frecuencia',
							array(
							'unica' => 'Única vez',
							'semanal' => 'Semanal',
							'mensual' => 'Mensual',
							'trimestral' => 'Trimestral',
							'semestral' => 'Semestral',
							'anual' => 'Anual',
							),
							old('frecuencia'),
							['class' => 'form-control input-sm']) }}
							@if ($errors->has('frecuencia'))
								<span class="help-block">
										<strong>{{ $errors->first('frecuencia') }}</strong>
									</span>
							@endif
                        </div>
                    </div>

                    <div class="form-group" id="medio-solicitud">
                        <label class="col-sm-2 control-label">Medio solicitud</label>
                        <div class="col-sm-3">
							{{ Form::select('medio_solicitud',
							array(
							'personalmente' => 'Personalmente',
							'email' => 'E-mail',
							'telefono' => 'Teléfono',
							'aplicacion' => 'Aplicación móvil',
							'texting' => 'Texting',
							'otro' => 'Otro',
							),
							old('medio_solicitud'),
							['class' => 'form-control input-sm']) }}
							@if ($errors->has('medio_solicitud'))
								<span class="help-block">
									<strong>{{ $errors->first('medio_solicitud') }}</strong>
								</span>
							@endif
                        </div>
                    </div>

                    <div class="hr-line-dashed" id="medio-solicitud-linea"></div>

                    <div class="form-group{{ $errors->has('propiedad') ? ' has-error' : '' }}" id="propiedad">
                        <label class="col-sm-2 control-label">Propiedad</label>
                        <div class="col-sm-3">
                            {{ Form::select('propiedad',['0'=>'Seleccione una propiedad']+$properties, old('propiedad'), ['class' => 'form-control input-sm','id'=>'propiedades']) }}
							@if ($errors->has('propiedad'))
								<span class="help-block">
									<strong>{{ $errors->first('propiedad') }}</strong>
								</span>
							@endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('contacto') ? ' has-error' : '' }}" id="contacto">
                        <label class="col-sm-2 control-label">Contacto</label>
                        <div class="col-sm-3">
                            <select class="form-control input-sm" name="contacto" id="contactos">
								<option value="0">Seleccione un contacto</option>
							</select>
							@if ($errors->has('contacto'))
								<span class="help-block">
									<strong>{{ $errors->first('contacto') }}</strong>
								</span>
							@endif
                        </div>
                    </div>

                    <div class="hr-line-dashed" id="propiedad-linea"></div>

                    <div class="form-group{{ $errors->has('instalacion') ? ' has-error' : '' }}" id="instalacion">
                        <label class="col-sm-2 control-label">Instalación</label>
                        <div class="col-sm-5">
							 <select class="form-control input-sm" name="instalacion" id="instalaciones">
								<option horamin="00:00:00" horamax="00:00:00" costo="0" value="0">Seleccione una instalación</option>
								@foreach($installations as $instalacion )
								<option horamin="{{$instalacion->hora_dia_semana_hasta}}" horamax="{{$instalacion->hora_fin_de_semana_hasta}}" costo="{{$instalacion->costo}}" value="{{$instalacion->id}}">{{$instalacion->instalacion}}</option>
								@endforeach
							</select>
						   @if ($errors->has('instalacion'))
								<span class="help-block">
									<strong>{{ $errors->first('instalacion') }}</strong>
								</span>
							@endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('fecha_requerida') ? ' has-error' : '' }}" id="fecha-requerida">
                        <label class="col-sm-2 control-label">Fecha requerida</label>
                        <div class="col-sm-3">
                            <div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" class="form-control input-sm date-picker-2" name="fecha_requerida" value="{{ date('d/m/Y') }}">
							@if ($errors->has('fecha_requerida'))
								<span class="help-block">
									<strong>{{ $errors->first('fecha_requerida') }}</strong>
								</span>
							@endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('hora_inicio') ? ' has-error' : '' }}" id="hora-inicio">
                        <label class="col-sm-2 control-label">Hora desde</label>
                        <div class="col-sm-3">
                            <div class="input-group clockpicker" data-autoclose="true">
                                <input type="text" class="form-control time-picker" name="hora_inicio" value="00:00">

                                <span class="input-group-addon">
                                    <span class="fa fa-clock-o"></span>
                                </span>
								
								
                            </div>
							@if ($errors->has('hora_inicio'))
								<span class="help-block">
									<strong>{{ $errors->first('hora_inicio') }}</strong>
								</span>
								@endif
								<p class="help-block m-b-none" style="color: #a5a5a5">Hora minima permitida:<span id="hora-minima"></span> </p>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('hora_final') ? ' has-error' : '' }}" id="hora-final">
                        <label class="col-sm-2 control-label">Hora hasta</label>
                        <div class="col-sm-3">
                            <div class="input-group clockpicker" data-autoclose="true">
                                <input type="text" class="form-control time-picker" name="hora_final" value="00:00">

                                <span class="input-group-addon">
                                    <span class="fa fa-clock-o"></span>
                                </span>
								
                            </div>
							<p class="help-block m-b-none" style="color: #a5a5a5">Hora maxima permitida:<span id="hora-maxima"></span> </p>
								@if ($errors->has('hora_final'))
								<span class="help-block">
									<strong>{{ $errors->first('hora_final') }}</strong>
								</span>
								@endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('costo') ? ' has-error' : '' }}" id="costo">
						<label class="col-sm-2 control-label">Costo</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control input-sm" name="costo" id="costo-input">
                        </div>
						@if ($errors->has('costo'))
						<span class="help-block">
							<strong>{{ $errors->first('costo') }}</strong>
						</span>
						@endif
                    </div>

                    <div class="form-group" id="adjuntos">
                        <label class="col-sm-2 control-label">Adjuntos</label>
                        <div class="col-sm-8">

                            <div class="fileinput input-group fileinput-new" data-provides="fileinput">
                                <div class="form-control" data-trigger="fileinput">
                                    <i class="glyphicon glyphicon-file fileinput-exists"></i> 
                                    <span class="fileinput-filename"></span>
                                </div>
                                <span class="input-group-addon btn btn-default btn-file">
                                    <span class="fileinput-new">Seleccionar archivo...</span>
                                    <span class="fileinput-exists">Cambiar</span>
                                    <input type="hidden" value=""><input type="file" name="adjunto_1">
                                </span>
                                <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Eliminar</a>
                            </div>

                            <!--    Para el caso de mas de un attach        -->
                            <div class="fileinput input-group fileinput-new" data-provides="fileinput">
                                <div class="form-control" data-trigger="fileinput">
                                    <i class="glyphicon glyphicon-file fileinput-exists"></i> 
                                    <span class="fileinput-filename"></span>
                                </div>
                                <span class="input-group-addon btn btn-default btn-file">
                                    <span class="fileinput-new">Seleccionar archivo...</span>
                                    <span class="fileinput-exists">Cambiar</span>
                                    <input type="hidden" value=""><input type="file" name="adjunto_2">
                                </span>
                                <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Eliminar</a>
                            </div>
                            <!--    Para el caso de mas de un attach        -->
                            <div class="fileinput input-group fileinput-new" data-provides="fileinput">
                                <div class="form-control" data-trigger="fileinput">
                                    <i class="glyphicon glyphicon-file fileinput-exists"></i> 
                                    <span class="fileinput-filename"></span>
                                </div>
                                <span class="input-group-addon btn btn-default btn-file">
                                    <span class="fileinput-new">Seleccionar archivo...</span>
                                    <span class="fileinput-exists">Cambiar</span>
                                    <input type="hidden" value=""><input type="file" name="adjunto_3">
                                </span>
                                <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Eliminar</a>
                            </div>

                        </div>
                    </div>

                    <input type=hidden name="tarea_estado" value="pendiente">

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-success" type="submit" style="margin-right: 10px;">Crear tarea</button>
                            <a href="{{ route('taskrequest.task.index') }}" class="btn btn-white">Cancelar</a>
                        </div>
                    </div>
                    {!! Form::close() !!}
                
            </div>
        </div>
    </div>
</div>

@endsection

@section('style')
<link rel="stylesheet" href="{{ URL::asset('css/summernote.css') }}" />
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('javascript')
<!--Lenguaje datepicker español-->
<script type="text/javascript" src="{{ URL::asset('js/moment.es.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/summernote.min.js') }}"></script>

<script>
	$(document).ready(function(){
		
		tipo_tarea = $('#tipo-tarea option:selected').val();
		console.log(tipo_tarea);
		
		if(tipo_tarea == "mis_tareas"){
			$('#fecha-tarea').show("slow");
			$('#titulo-tarea').show("slow");
            $('#nota').show("slow");
			$('#nota-linea').show("slow");
			$('#prioridad').show("slow");
			$('#frecuencia').show("slow");
            $('#medio-solicitud').hide();
			$('#medio-solicitud-linea').hide();
            $('#propiedad').hide();
			$('#propiedad-linea').hide();
			$('#contacto').hide();
			$('#instalacion').hide();
			$('#fecha-requerida').hide();
			$('#hora-inicio').hide();
			$('#hora-final').hide();
			$('#costo').hide();
			$('#adjuntos').show("slow");

		}else if(tipo_tarea == "solicitudes_recibidas"){
			$('#fecha-tarea').show("slow");
			$('#titulo-tarea').show("slow");
            $('#nota').show("slow");
			$('#nota-linea').show("slow");
			$('#prioridad').show("slow");
			$('#frecuencia').hide();
            $('#medio-solicitud').show("slow");
			$('#medio-solicitud-linea').show("slow");
            $('#propiedad').show("slow");
			$('#propiedad-linea').show("slow");
			$('#contacto').show("slow");
			$('#instalacion').hide();
			$('#fecha-requerida').hide();
			$('#hora-inicio').hide();
			$('#hora-final').hide();
			$('#costo').hide();
			$('#adjuntos').show("slow");

		}else if(tipo_tarea == "reserva_instalaciones"){
			$('#fecha-tarea').show("slow");
			$('#titulo-tarea').show("slow");
            $('#nota').show("slow");
			$('#nota-linea').show("slow");
			$('#prioridad').hide();
			$('#frecuencia').hide();
            $('#medio-solicitud').show("slow");
			$('#medio-solicitud-linea').show("slow");
            $('#propiedad').show("slow");
			$('#propiedad-linea').show("slow");
			$('#contacto').show("slow");
			$('#instalacion').show("slow");
			$('#fecha-requerida').show("slow");
			$('#hora-inicio').show("slow");
			$('#hora-final').show("slow");
			$('#costo').show("slow");
			$('#adjuntos').hide();

		}else if(tipo_tarea == "reclamos"){
			$('#fecha-tarea').show("slow");
			$('#titulo-tarea').show("slow");
            $('#nota').show("slow");
			$('#nota-linea').show("slow");
			$('#prioridad').show("slow");
			$('#frecuencia').hide();
            $('#medio-solicitud').show("slow");
			$('#medio-solicitud-linea').show("slow");
            $('#propiedad').show("slow");
			$('#propiedad-linea').show("slow");
			$('#contacto').show("slow");
			$('#instalacion').hide();
			$('#fecha-requerida').hide();
			$('#hora-inicio').hide();
			$('#hora-final').hide();
			$('#costo').hide();
			$('#adjuntos').show("slow");

		}else if(tipo_tarea == "sugerencias"){
			$('#fecha-tarea').show("slow");
			$('#titulo-tarea').show("slow");
            $('#nota').show("slow");
			$('#nota-linea').show("slow");
			$('#prioridad').hide();
			$('#frecuencia').hide();
            $('#medio-solicitud').show("slow");
			$('#medio-solicitud-linea').show("slow");
            $('#propiedad').show("slow");
			$('#propiedad-linea').show("slow");
			$('#contacto').show("slow");
			$('#instalacion').hide();
			$('#fecha-requerida').hide();
			$('#hora-inicio').hide();
			$('#hora-final').hide();
			$('#costo').hide();
			$('#adjuntos').show("slow");

		}else if(tipo_tarea == "notificacion_mudanza"){
			$('#fecha-tarea').show("slow");
			$('#titulo-tarea').show("slow");
            $('#nota').show("slow");
			$('#nota-linea').show("slow");
			$('#prioridad').hide();
			$('#frecuencia').hide();
            $('#medio-solicitud').show("slow");
			$('#medio-solicitud-linea').show("slow");
            $('#propiedad').show("slow");
			$('#propiedad-linea').show("slow");
			$('#contacto').show("slow");
			$('#instalacion').hide();
			$('#fecha-requerida').show("slow");
			$('#hora-inicio').hide();
			$('#hora-final').hide();
			$('#costo').hide();
			$('#adjuntos').hide();

		}else if(tipo_tarea == "notificacion_trabajos"){
			$('#fecha-tarea').show("slow");
			$('#titulo-tarea').show("slow");
            $('#nota').show("slow");
			$('#nota-linea').show("slow");
			$('#prioridad').hide();
			$('#frecuencia').hide();
            $('#medio-solicitud').show("slow");
			$('#medio-solicitud-linea').show("slow");
            $('#propiedad').show("slow");
			$('#propiedad-linea').show("slow");
			$('#contacto').show("slow");
			$('#instalacion').hide();
			$('#fecha-requerida').show("slow");
			$('#hora-inicio').hide();
			$('#hora-final').hide();
			$('#costo').hide();
			$('#adjuntos').show("slow");

		}else{
			$('#fecha-tarea').hide();
			$('#titulo-tarea').hide();
            $('#nota').hide();
			$('#nota-linea').hide();
			$('#prioridad').hide();
			$('#frecuencia').hide();
            $('#medio-solicitud').hide();
			$('#medio-solicitud-linea').hide();
            $('#propiedad').hide();
			$('#propiedad-linea').hide();
			$('#contacto').hide();
			$('#instalacion').hide();
			$('#fecha-requerida').hide();
			$('#hora-inicio').hide();
			$('#hora-final').hide();
			$('#costo').hide();
			$('#adjuntos').hide();
		}
	
		$('#tipo-tarea').change(function(){

			if($(this).val() == "mis_tareas"){
				$('#fecha-tarea').show("slow");
				$('#titulo-tarea').show("slow");
                $('#nota').show("slow");
				$('#nota-linea').show("slow");
				$('#prioridad').show("slow");
				$('#frecuencia').show("slow");
                $('#medio-solicitud').hide();
				$('#medio-solicitud-linea').hide();
                $('#propiedad').hide();
				$('#propiedad-linea').hide();
				$('#contacto').hide();
				$('#instalacion').hide();
				$('#fecha-requerida').hide();
				$('#hora-inicio').hide();
				$('#hora-final').hide();
				$('#costo').hide();
				$('#adjuntos').show("slow");

			}else if($(this).val() == "solicitudes_recibidas"){
				$('#fecha-tarea').show("slow");
				$('#titulo-tarea').show("slow");
                $('#nota').show("slow");
				$('#nota-linea').show("slow");
				$('#prioridad').show("slow");
				$('#frecuencia').hide();
                $('#medio-solicitud').show("slow");
				$('#medio-solicitud-linea').show("slow");
                $('#propiedad').show("slow");
				$('#propiedad-linea').show("slow");
				$('#contacto').show("slow");
				$('#instalacion').hide();
				$('#fecha-requerida').hide();
				$('#hora-inicio').hide();
				$('#hora-final').hide();
				$('#costo').hide();
				$('#adjuntos').show("slow");

			}else if($(this).val() == "reserva_instalaciones"){
				$('#fecha-tarea').show("slow");
				$('#titulo-tarea').show("slow");
                $('#nota').show("slow");
				$('#nota-linea').show("slow");
				$('#prioridad').hide();
				$('#frecuencia').hide();
                $('#medio-solicitud').show("slow");
				$('#medio-solicitud-linea').show("slow");
                $('#propiedad').show("slow");
				$('#propiedad-linea').show("slow");
				$('#contacto').show("slow");
				$('#instalacion').show("slow");
				$('#fecha-requerida').show("slow");
				$('#hora-inicio').show("slow");
				$('#hora-final').show("slow");
				$('#costo').show("slow");
				$('#adjuntos').hide();

			}else if($(this).val() == "reclamos"){
				$('#fecha-tarea').show("slow");
				$('#titulo-tarea').show("slow");
                $('#nota').show("slow");
				$('#nota-linea').show("slow");
				$('#prioridad').show("slow");
				$('#frecuencia').hide();
                $('#medio-solicitud').show("slow");
				$('#medio-solicitud-linea').show("slow");
                $('#propiedad').show("slow");
				$('#propiedad-linea').show("slow");
				$('#contacto').show("slow");
				$('#instalacion').hide();
				$('#fecha-requerida').hide();
				$('#hora-inicio').hide();
				$('#hora-final').hide();
				$('#costo').hide();
				$('#adjuntos').show("slow");

			}else if($(this).val() == "sugerencias"){
				$('#fecha-tarea').show("slow");
				$('#titulo-tarea').show("slow");
                $('#nota').show("slow");
				$('#nota-linea').show("slow");
				$('#prioridad').hide();
				$('#frecuencia').hide();
                $('#medio-solicitud').show("slow");
				$('#medio-solicitud-linea').show("slow");
                $('#propiedad').show("slow");
				$('#propiedad-linea').show("slow");
				$('#contacto').show("slow");
				$('#instalacion').hide();
				$('#fecha-requerida').hide();
				$('#hora-inicio').hide();
				$('#hora-final').hide();
				$('#costo').hide();
				$('#adjuntos').show("slow");

			}else if($(this).val() == "notificacion_mudanza"){
				$('#fecha-tarea').show("slow");
				$('#titulo-tarea').show("slow");
                $('#nota').show("slow");
				$('#nota-linea').show("slow");
				$('#prioridad').hide();
				$('#frecuencia').hide();
                $('#medio-solicitud').show("slow");
				$('#medio-solicitud-linea').show("slow");
                $('#propiedad').show("slow");
				$('#propiedad-linea').show("slow");
				$('#contacto').show("slow");
				$('#instalacion').hide();
				$('#fecha-requerida').show("slow");
				$('#hora-inicio').hide();
				$('#hora-final').hide();
				$('#costo').hide();
				$('#adjuntos').hide();

			}else if($(this).val() == "notificacion_trabajos"){
				$('#fecha-tarea').show("slow");
				$('#titulo-tarea').show("slow");
                $('#nota').show("slow");
				$('#nota-linea').show("slow");
				$('#prioridad').hide();
				$('#frecuencia').hide();
                $('#medio-solicitud').show("slow");
				$('#medio-solicitud-linea').show("slow");
                $('#propiedad').show("slow");
				$('#propiedad-linea').show("slow");
				$('#contacto').show("slow");
				$('#instalacion').hide();
				$('#fecha-requerida').show("slow");
				$('#hora-inicio').hide();
				$('#hora-final').hide();
				$('#costo').hide();
				$('#adjuntos').show("slow");

			}else{
				$('#fecha-tarea').hide();
				$('#titulo-tarea').hide();
                $('#nota').hide();
				$('#nota-linea').hide();
				$('#prioridad').hide();
				$('#frecuencia').hide();
                $('#medio-solicitud').hide();
				$('#medio-solicitud-linea').hide();
                $('#propiedad').hide();
				$('#propiedad-linea').hide();
				$('#contacto').hide();
				$('#instalacion').hide();
				$('#fecha-requerida').hide();
				$('#hora-inicio').hide();
				$('#hora-final').hide();
				$('#costo').hide();
				$('#adjuntos').hide();
			}

		});
		
		//ajax contactos por propiedad
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		
		$('#propiedades').change(function(){
		var propiedad_id = $(this).val();
		console.log(propiedad_id);
		$.post('/contact/'+propiedad_id+'/property', function(response){
			
				if(response.success)
				{
					var contactos = $('#contactos').empty();
					$('<option/>', {
							value:0,
							text:"Seleccione un contacto"
						}).appendTo(contactos);
					$.each(response.contacts, function(i, contact){
						$('<option/>', {
							value:i,
							text:contact
						}).appendTo(contactos);
					})
				}
			}, 'json');
		});

		$('.date-picker').datetimepicker({
			locale:'es',
			format: 'DD/MM/YYYY',
				widgetPositioning: {
				horizontal: 'left',
					vertical: 'bottom'
				}
		});
		
        $('.date-picker-2').datetimepicker({
            locale:'es',
            format: 'DD/MM/YYYY',
                widgetPositioning: {
                horizontal: 'left',
                    vertical: 'top'
                }
        });

		$('.time-picker').datetimepicker({
            format: 'HH:mm',
			widgetPositioning: {
			horizontal: 'left',
				vertical: 'top'
			}
        });
		$('#summernote').summernote({
			height: 250,
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
		
	});
	$('#instalaciones').change(function () {

		$('#costo-input').val($('#instalaciones option:selected').attr('costo'));
		var hora_min = $('#instalaciones option:selected').attr('horamin');
		var hora_max = $('#instalaciones option:selected').attr('horamax');
		//hora-minima
		$('#hora-minima').text(hora_min.substring(0,5));
		$('#hora-maxima').text(hora_max.substring(0,5));
	});
	</script>

@endsection