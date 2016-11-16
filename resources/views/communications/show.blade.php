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
										$filename = explode("-name-",$adjunto);
										$ext_array = explode(".",$adjunto);
										$ext = end($ext_array);
									?>
									<div class="col-sm-4">
										<div class="thumbnail">
											@if($ext == 'jpg' || $ext == 'png')
											<h3 class="text-center"><i class="fa fa-file-image-o fa-5x"></i></h3>
											@elseif($ext == 'pdf')
												<h3 class="text-center"><i class="fa fa fa-file-pdf-o fa-5x"></i></h3>
											@elseif($ext == 'doc' || $ext == 'txt' || $ext == 'docx')
												<h3 class="text-center"><i class="fa fa-file-word-o fa-5x"></i></h3>
											@elseif($ext == 'xls' || $ext == 'xlsx')
												<h3 class="text-center"><i class="fa fa-file-excel-o fa-5x"></i></h3>
											@elseif($ext == 'rar' || $ext == 'zip')
												<h3 class="text-center"><i class="fa fa-file-archive-o fa-5x"></i></h3>
											@else
												<h3 class="text-center"><i class="fa fa-file fa-5x"></i></h3>
											@endif
											<div class="caption">
												<h4 class="text-center">{{$filename[1]}}</h4>
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
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Teléfonos y sitios</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('admin.home') }}">Inicio</a>
                </li>
                <li>
                    Comunicación & Información
                </li>
                <li class="active">
                    <strong>Ver</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">

                <div class="ibox float-e-margins">
                    <div class="ibox-content">

                        <form action="#" class="form-horizontal">

                        <div class="tabs-container">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#tab-1">Ver: {{$phonesite->razon_social}}</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="tab-1" class="tab-pane active">
                                    <div class="panel-body">

                                        <div class="form-group{{ $errors->has('razon_social') ? ' has-error' : '' }}">
                                            <label class="col-sm-3 control-label">Razón social/ Nombre</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control input-sm" name="razon_social" value="{{$phonesite->razon_social}}" readonly>
                                                @if ($errors->has('razon_social'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('razon_social') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('categoria') ? ' has-error' : '' }}">
                                            <label class="col-sm-3 control-label">Categoría</label>
                                            <div class="col-sm-3">
                                                {{ Form::select('categoria',array('0' => 'Seleccione','Servicios basicos' => 'Servicios basicos', 'Taxis' => 'Taxis', 'Fontaneros' => 'Fontaneros', 'Electricistas' => 'Electricistas', 'Policia y Transito' => 'Policia y Transito', 'Salud' => 'Salud'),$phonesite->categoria,['class' => 'form-control input-sm','disabled'=>'disabled']) }}
                                                @if ($errors->has('categoria'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('categoria') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('telefono') ? ' has-error' : '' }}">
                                            <label class="col-sm-3 control-label">Teléfonos</label>
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <input type="text" placeholder="Fijo/ Móvil" class="form-control" name="telefono" value="{{$phonesite->telefono}}" readonly>
                                                        @if ($errors->has('telefono'))
                                                            <span class="help-block">
                                                            <strong>{{ $errors->first('telefono') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" placeholder="Tel. Emergencias" class="form-control" name="telefono_emergencia" value="{{$phonesite->telefono_emergencia}}" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label class="col-sm-3 control-label">E-mail</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control input-sm" name="email" value="{{$phonesite->email}}" readonly>
                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('sitio_web') ? ' has-error' : '' }}">
                                            <label class="col-sm-3 control-label">Sitio web</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control input-sm" placeholder="http://www.empresa.com" name="sitio_web" value="{{$phonesite->sitio_web}}" readonly>
                                                @if ($errors->has('sitio_web'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('sitio_web') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Dirección</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control input-sm" name="direccion" value="{{$phonesite->direccion}}" readonly>
                                            </div>
                                        </div>

                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Notas</label>
                                            <div class="col-sm-9">
                                                <textarea rows="3" class="form-control input-sm" name="notas" readonly>{{$phonesite->notas}}</textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <a href="{{ route('communications.phonesites') }}" class="btn btn-success" >Volver</a>
                                </div>
                            </div>

                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('javascript')
    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });

        });
    </script>
@endsection
