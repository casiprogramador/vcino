@extends('layouts.admin')

@section('admin-content')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>Comunicados</h2>
		<ol class="breadcrumb">
			<li>
				<a href="#/">Inicio</a>
			</li>
			<li>
				Comunicación & Información
			</li>
			<li>
				<a href="{{ route('communication.communication.index') }}">Lista de comunicados</a>
			</li>
			<li class="active">
				<strong>Nuevo comunicado</strong>
			</li>
		</ol>
	</div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">

			<div class="ibox float-e-margins">

				<div class="ibox-title">
					<h5 style="padding-top: 2px;">Nuevo comunicado</h5>
				</div>

				<div class="ibox-content">
					{!! Form::open(array('route' => 'communication.communication.store', 'class' => 'form-horizontal', 'files' => true)) !!}

					<div class="form-group{{ $errors->has('fecha') ? ' has-error' : '' }}" id="fecha">
						<label class="col-sm-2 control-label">Fecha</label>
						<div class="col-sm-3 input-group date" style="padding-left:15px;">
							<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							<input type="text" class="form-control input-sm date-picker" name="fecha" value="{{ date('d/m/Y') }}">
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
							<input type="text" name="asunto" class="form-control input-sm" value="{{old('asunto')}}">
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
								<textarea id="summernote" name="cuerpo">Escribir cuerpo...</textarea>
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

							<div class="fileinput input-group fileinput-new" data-provides="fileinput">
								<div class="form-control" data-trigger="fileinput">
									<i class="glyphicon glyphicon-file fileinput-exists"></i> 
									<span class="fileinput-filename"></span>
								</div>
								<span class="input-group-addon btn btn-default btn-file">
									<span class="fileinput-new">Seleccionar archivo...</span>
									<span class="fileinput-exists">Cambiar</span>
									<input type="hidden" value=""><input type="file" name="adjunto[]">
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
									<input type="hidden" value=""><input type="file" name="adjunto[]">
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
									<input type="hidden" value=""><input type="file" name="adjunto[]">
								</span>
								<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Eliminar</a>
							</div>

						</div>
					</div>

					<div class="hr-line-dashed"></div>
					<div class="form-group">
						<div class="col-sm-12">
							<button class="btn btn-success" type="submit">Guardar</button>
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
			height: 300
		});
	});

	$('.date-picker').datetimepicker({
		format: 'DD/MM/YYYY'
	});
</script>
@endsection