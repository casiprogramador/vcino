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
				<strong>Ver comunicado</strong>
			</li>
		</ol>
	</div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">

			<div class="ibox float-e-margins">

				<div class="ibox-title">
					<h5 style="padding-top: 2px;">Ver comunicado</h5>
				</div>

				<div class="ibox-content">
					 <form action="#" class="form-horizontal">

					<div class="form-group{{ $errors->has('fecha') ? ' has-error' : '' }}" id="fecha">
						<label class="col-sm-2 control-label">Fecha</label>
						<div class="col-sm-3 input-group date" style="padding-left:15px;">
							<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							<input type="text" class="form-control input-sm date-picker" name="fecha" value="{{date('d/m/Y', strtotime($communication->fecha)) }}" readonly>
						</div>
						<div class="col-sm-8 col-md-offset-2">

						</div>
					</div>

					<div class="form-group{{ $errors->has('asunto') ? ' has-error' : '' }}">
						<label class="col-sm-2 control-label">Asunto</label>
						<div class="col-sm-8">
							<input type="text" name="asunto" class="form-control input-sm" value="{{$communication->asunto}}" readonly>

						</div>
					</div>

					<div class="form-group{{ $errors->has('cuerpo') ? ' has-error' : '' }}">
						<label class="col-sm-2 control-label">Cuerpo</label>
						<div class="col-sm-9">
							<?php echo $communication->cuerpo ?>
						</div>
					</div>

					<div class="hr-line-dashed"></div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Adjuntos</label>
						<div class="col-sm-8">
							<div class="row">
								@if(!empty($communication->adjuntos))
									@foreach (explode(",",$communication->adjuntos) as $adjunto)
									<?php 
										$filename = explode("-",$adjunto);
										$ext_array = explode(".",$adjunto);
										$ext = end($ext_array);
									?>
									<div class="col-sm-4">
										<div class="thumbnail">
											@if($ext == 'jpg' || $ext == 'png')
											<h3 class="text-center"><i class="fa fa-file-image-o fa-5x"></i></h3>
											@elseif($ext == 'pdf')
												<i class="fa fa fa-file-pdf-o fa-5x"></i>
											@elseif($ext == 'doc' || $ext == 'txt' || $ext == 'docx')
												<i class="fa fa-file-word-o fa-5x"></i>
											@elseif($ext == 'xls' || $ext == 'xlsx')
												<i class="fa fa-file-excel-o fa-5x"></i>
											@elseif($ext == 'rar' || $ext == 'zip')
												<i class="fa fa-file-archive-o fa-5x"></i>
											@else
												<i class="fa fa-file fa-5x"></i>
											@endif
											<div class="caption">
												<h4 class="text-center">{{$filename[3]}}</h4>
											</div>
										</div>
									</div>
									@endforeach
								@endif
							</div>
						</div>
					</div>
					<div class="hr-line-dashed"></div>
					<div class="form-group">
						<div class="col-sm-12">
							<a href="{{ route('communication.communication.index') }}" class="btn btn-success" type="submit">Atras</a>
						</div>
					</div>

					 </form>
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