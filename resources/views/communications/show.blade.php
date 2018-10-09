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

					<div class="form-horizontal">

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
							<div class="col-sm-9" style="background-color: #EBEBEB; margin-left: 15px;">
								<br>
								<?php echo $communication->cuerpo ?>
							</div>
						</div>

						@if(!empty($communication->adjuntos))
						<div class="hr-line-dashed"></div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Adjuntos</label>
							<div class="col-sm-10">
								<div class="row">
									@if(!empty($communication->adjuntos))
									@foreach (explode(",",$communication->adjuntos) as $adjunto)
									<?php
									$filename = explode("-name-", $adjunto);
									$ext_array = explode(".", $adjunto);
									$ext = end($ext_array);
									?>
									<div class="col-sm-4">
										<div class="thumbnail">
											@if($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg')
											<a href="{{ URL::asset($adjunto)}}" target="_blank">
												<img src="{{ URL::asset($adjunto)}}">
												<div class="caption">
												<h4 class="text-center">{{$filename[1]}}</h4>
												</div>
											</a>
											@elseif($ext == 'pdf')
											<a href="{{ URL::asset($adjunto)}}" target="_blank">
												<h4 class="text-center"><i class="fa fa fa-file-pdf-o fa-5x"></i></h4>
												<div class="caption">
												<h4 class="text-center">{{$filename[1]}}</h4>
												</div>
											</a>
											
											@elseif($ext == 'doc' || $ext == 'txt' || $ext == 'docx')
											<a href="{{ URL::asset($adjunto)}}" target="_blank">
												<h4 class="text-center"><i class="fa fa-file-word-o fa-5x"></i></h4>
												<div class="caption">
												<h4 class="text-center">{{$filename[1]}}</h4>
												</div>
											</a>
											
											@elseif($ext == 'xls' || $ext == 'xlsx')
											<a href="{{ URL::asset($adjunto)}}" target="_blank">
												<h4 class="text-center"><i class="fa fa-file-excel-o fa-5x"></i></h4>
												<div class="caption">
												<h4 class="text-center">{{$filename[1]}}</h4>
												</div>
											</a>
											
											@elseif($ext == 'rar' || $ext == 'zip')
											<a href="{{ URL::asset($adjunto)}}" target="_blank">
												<h4 class="text-center"><i class="fa fa-file-archive-o fa-5x"></i></h4>
												<div class="caption">
												<h4 class="text-center">{{$filename[1]}}</h4>
												</div>
											</a>
											
											@else
											<h3 class="text-center"><i class="fa fa-file fa-5x"></i></h3>
											@endif

										</div>
									</div>
									@endforeach
									@endif
								</div>
							</div>
						</div>
						@endif
						<div class="hr-line-dashed"></div>
						<div class="form-group">
							<div class="col-sm-12">
								<a href="{{ route('communication.communication.index') }}" class="btn btn-success" type="submit">Volver</a>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
		@if( count($communication->sendcommunication) )
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Registro de envíos</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                	<div class="row">
                        <!--    PANEL REGISTRO DE ENVIO DE COMUNICADOS              -->
						@foreach($sendcommunications as $sendcommunication)
                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Registro de envío
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Fecha envío</label>
                                            <div class="col-sm-2">
                                                <p>{{ date_format(date_create( $sendcommunication->created_at ),"d/m/Y") }}</p>
                                            </div>
                                            <label class="col-sm-2 control-label">Hora envío</label>
                                            <div class="col-sm-2">
                                                <p>{{ date_format(date_create( $sendcommunication->created_at ),"H:i") }}</p>
                                            </div>
											<label class="col-sm-2 control-label">Destinatarios</label>
                                            <div class="col-sm-2">
                                                @if($sendcommunication->dirigido == 'correo')	
													@foreach( ( explode(",",$sendcommunication->correos) ) as $correo)
														<span class="badge">{{$correo}}</span>
													@endforeach
												@else
													<span class="badge">{{ ucwords($sendcommunication->dirigido) }}</span>
												@endif		
                                            </div>
                                        </div>
										<br>
										<div class="form-group">
											<label class="col-sm-2 control-label">E-mail(s)</label>
											<div class="col-sm-8">
												@foreach( ( explode(",",$sendcommunication->correos) ) as $correo)
													<p>{{$correo}}</p>
												@endforeach
												<!--
												@foreach ($communication->sendcommunication as $sendcommunication)
													<p>{{$sendcommunication->correos}}</p>
												@endforeach
												-->
											</div>
										</div>

                                    </div>
                                </div>
                            </div>
                        </div>
						@endforeach
                        <!--    FIN - PANEL REGISTRO DE ENVIO DE COMUNICADOS            -->
					</div>
					<div class="hr-line-dashed"></div>
					<div class="form-group">
						<a href="{{ route('communication.communication.index') }}" class="btn btn-success" type="submit">Volver</a>
					</div>
                </div>
            </div>
        </div>
        @endif

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
