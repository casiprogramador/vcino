@extends('layouts.admin')

@section('admin-content')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>Comunicados</h2>
		<ol class="breadcrumb">
			<li>
				<a href="{{ route('admin.home') }}">Inicio</a>
			</li>
			<li>
				Comunicación & Información
			</li>
			<li>
				<a href="{{ route('communication.communication.index') }}">Comunicados</a>
			</li>
			<li class="active">
				<strong>Copiar comunicado</strong>
			</li>
		</ol>
	</div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">

			<div class="ibox float-e-margins">

				<div class="ibox-title">
					<h5 style="padding-top: 2px;">Copiar comunicado</h5>
				</div>

				<div class="ibox-content">
					{!! Form::open(array('route' => 'communication.communication.savecopy', 'class' => 'form-horizontal', 'files' => true)) !!}
					<div class="form-group{{ $errors->has('fecha') ? ' has-error' : '' }}" id="fecha">
						<label class="col-sm-2 control-label">Fecha</label>
						<div class="col-sm-3 input-group date" style="padding-left:15px;">
							<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							<input type="text" class="form-control input-sm date-picker" name="fecha" value="{{date('d/m/Y', strtotime($communication->fecha)) }}">
							
						</div>
						<div class="col-sm-8 col-md-offset-2">
							@if ($errors->has('fecha'))
							<span class="help-block">
								<strong>{{ $errors->first('fecha') }}</strong>
							</span>
							@endif
						</div>
					</div>

					<div class="form-group{{ $errors->has('asunto') ? ' has-error' : '' }}">
						<label class="col-sm-2 control-label">Asunto</label>
						<div class="col-sm-8">
							<input type="text" name="asunto" class="form-control input-sm" value="{{$communication->asunto}}">
							@if ($errors->has('asunto'))
							<span class="help-block">
								<strong>{{ $errors->first('asunto') }}</strong>
							</span>
							@endif
						</div>
					</div>

					<div class="form-group{{ $errors->has('cuerpo') ? ' has-error' : '' }}">
						<label class="col-sm-2 control-label">Cuerpo</label>
						<div class="col-sm-9">
							<div class="no-padding">
								<textarea id="summernote" name="cuerpo">{{ $communication->cuerpo }}</textarea>
							</div>
							@if ($errors->has('cuerpo'))
							<span class="help-block">
								<strong>{{ $errors->first('cuerpo') }}</strong>
							</span>
							@endif
						</div>
					</div>

					<div class="hr-line-dashed"></div>

										<div class="form-group">
						<label class="col-sm-2 control-label">Adjuntos</label>
						<div class="col-sm-8">
							<?php
								$adjuntos_array = array_filter(explode(",",$communication->adjuntos));
							?>

							<div  id="adjunto1" class="fileinput input-group {{isset($adjuntos_array[0]) ? 'fileinput-exists'  : 'fileinput-new'}}" data-provides="fileinput">
								<div class="form-control" data-trigger="fileinput">
									<i class="glyphicon glyphicon-file fileinput-exists"></i> 
									<span class="fileinput-filename">{{ (isset($adjuntos_array[0]) ) ? MenuRoute::filename($adjuntos_array[0]) : "" }}</span>
								</div>
								<span class="input-group-addon btn btn-default btn-file">
									<span class="fileinput-new">Seleccionar archivo...</span>
									<span class="fileinput-exists">Cambiar</span>
									<input type="hidden" value=""><input type="file" name="adjunto[]">
									<input id="adjunto-ori1" type="hidden" name="adjunto_ori[]" value="{{ (isset($adjuntos_array[0]) ) ? $adjuntos_array[0] : '' }}">
								</span>
								<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Eliminar</a>
							</div>


							<!--    Para el caso de mas de un attach        -->
							<div id="adjunto2" class="fileinput input-group {{isset($adjuntos_array[1]) ? 'fileinput-exists'  : 'fileinput-new'}}" data-provides="fileinput">
								<div class="form-control" data-trigger="fileinput">
									<i class="glyphicon glyphicon-file fileinput-exists"></i> 
									<span class="fileinput-filename">{{ (isset($adjuntos_array[1]) ) ? MenuRoute::filename($adjuntos_array[1]) : "" }}</span>
								</div>
								<span class="input-group-addon btn btn-default btn-file">
									<span class="fileinput-new">Seleccionar archivo...</span>
									<span class="fileinput-exists">Cambiar</span>
									<input type="hidden" value=""><input type="file" name="adjunto[]">
									<input id="adjunto-ori2" type="hidden" name="adjunto_ori[]" value="{{ (isset($adjuntos_array[1]) ) ? $adjuntos_array[1] : '' }}">
								</span>
								<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Eliminar</a>
							</div>
							<!--    Para el caso de mas de un attach        -->
							<div id="adjunto3" class="fileinput input-group {{isset($adjuntos_array[2]) ? 'fileinput-exists'  : 'fileinput-new'}}" data-provides="fileinput">
								<div class="form-control" data-trigger="fileinput">
									<i class="glyphicon glyphicon-file fileinput-exists"></i> 
									<span class="fileinput-filename">{{ (isset($adjuntos_array[2]) ) ? MenuRoute::filename($adjuntos_array[2]) : "" }}</span>
								</div>
								<span class="input-group-addon btn btn-default btn-file">
									<span class="fileinput-new">Seleccionar archivo...</span>
									<span class="fileinput-exists">Cambiar</span>
									<input type="hidden" value=""><input type="file" name="adjunto[]">
									<input id="adjunto-ori3" type="hidden" name="adjunto_ori[]" value="{{ (isset($adjuntos_array[2]) ) ? $adjuntos_array[2] : '' }}">
								</span>
								<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Eliminar</a>
							</div>

						</div>
					</div>

					<div class="hr-line-dashed"></div>
					<div class="form-group">
						<div class="col-sm-12">
							<button class="btn btn-success" type="submit" style="margin-right: 10px;">Guardar</button>
							<a href="{{ route('communication.communication.index') }}" class="btn btn-white" type="submit">Cancelar</a>
						</div>
					</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('style')
<link rel="stylesheet" href="{{ URL::asset('css/summernote.css') }}" />
@endsection

@section('javascript')
<script type="text/javascript" src="{{ URL::asset('js/summernote.min.js') }}"></script>
<script>
	$(document).ready(function () {
		$('#summernote').summernote({
			height: 300,
			toolbar: [
			    ['style', ['style']],
			    ['font', ['bold', 'italic', 'underline']],
			    ['color', ['color']],
			    ['para', ['ul', 'ol', 'paragraph']],
			    ['insert', ['link', 'hr']],
			    ['view', ['codeview']],
			    ['help', ['help']]
			],
		});
		$('#adjunto1').on('clear.bs.fileinput', function(event) {
			$('#adjunto-ori1').val('');
		});
		$('#adjunto2').on('clear.bs.fileinput', function(event) {
			$('#adjunto-ori2').val('');
		});
		$('#adjunto3').on('clear.bs.fileinput', function(event) {
			$('#adjunto-ori3').val('');
		});
	});

	$('.date-picker').datetimepicker({
		format: 'DD/MM/YYYY'
	});
</script>
@endsection