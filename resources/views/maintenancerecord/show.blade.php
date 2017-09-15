@extends('layouts.admin')

@section('admin-content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Plan de mantenimiento</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.home') }}">Inicio</a>
            </li>
            <li>
                Equipamiento
            </li>
            <li>
                <a href="#">Plan de mantenimiento</a>
            </li>
            <li class="active">
                <strong>Ver registro de mantenimiento</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <h5 style="padding-top: 2px;">Ver registro de mantenimiento</h5>
                </div>

                <div class="ibox-content">

					{!! Form::open(array('route' => array('equipment.maintenancerecord.update', $maintenancerecord->id),'method' => 'patch' ,'class' => 'form-horizontal')) !!}
					@if(isset($id_maintenanceplan))
					<input type="hidden" value="{{$id_maintenanceplan}}" name="id_maintenanceplan">
					@else
					<input type="hidden" value="0" name="id_maintenanceplan">
					@endif
                         <div class="form-group{{ $errors->has('fecha') ? ' has-error' : '' }}">
                            <label class="col-sm-3 control-label">Fecha de realización</label>
                            <div class="col-sm-3">
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" class="form-control input-sm date-picker" name="fecha" value="{{ date_format(date_create($maintenancerecord->fecha_realizacion),'d/m/Y') }}" disabled="disabled">

                                </div>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('equipo') ? ' has-error' : '' }}">
                            <label class="col-sm-3 control-label">Equipo</label>
                            <div class="col-sm-5">
                                {{ Form::select('equipo',['0' => 'Seleccione un equipo']+$equipmets,$maintenancerecord->equipment_id, ['class' => 'form-control input-sm','disabled'=>'disabled']) }}

                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('proveedor') ? ' has-error' : '' }}">
                            <label class="col-sm-3 control-label">Proveedor</label>
                            <div class="col-sm-5">
                                {{ Form::select('proveedor',['0' => 'Seleccione un proveedor']+$suppliers,$maintenancerecord->supplier_id, ['class' => 'form-control input-sm','disabled'=>'disabled']) }}

                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('costo') ? ' has-error' : '' }}">
                            <label class="col-sm-3 control-label">Costo</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control input-sm" name="costo" value="{{$maintenancerecord->costo}}" disabled="disabled">

                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Tipo</label>
                            <div class="col-sm-3">
								 {{ Form::select('tipo',
								array(
								'Preventivo' => 'Preventivo',
								'Correctivo' => 'Correctivo',
								'Emergencia' => 'Emergencia',
								),$maintenancerecord->tipo,
								['class' => 'form-control input-sm','disabled'=>'disabled']) }}
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group" id="nota">
							<label class="col-sm-3 control-label">Notas</label>
							<div class="col-sm-8">
								<div class="no-padding">
									<?php echo $maintenancerecord->notas ?>
								</div>
							</div>
						</div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Adjuntos</label>
                            <div class="col-sm-8">

								
						@if(!empty($maintenancerecord->adjunto_1))
							<?php
							$filename = explode("-name-", $maintenancerecord->adjunto_1);
							$ext_array = explode(".", $maintenancerecord->adjunto_1);
							$ext = end($ext_array);
							?>
							<div class="col-sm-4">
								<div class="thumbnail">
									@if($ext == 'jpg' || $ext == 'png')
									<a href="{{ URL::asset($maintenancerecord->adjunto_1)}}" target="_blank">
										<img src="{{ URL::asset($maintenancerecord->adjunto_1)}}" width="300">
										<div class="caption">
										<h4 class="text-center">{{$filename[1]}}</h4>
										</div>
									</a>
									@elseif($ext == 'pdf')
									<a href="{{ URL::asset($maintenancerecord->adjunto_1)}}" target="_blank">
										<h4 class="text-center"><i class="fa fa fa-file-pdf-o fa-5x"></i></h4>
										<div class="caption">
										<h4 class="text-center">{{$filename[1]}}</h4>
										</div>
									</a>
									
									@elseif($ext == 'doc' || $ext == 'txt' || $ext == 'docx')
									<a href="{{ URL::asset($maintenancerecord->adjunto_1)}}" target="_blank">
										<h4 class="text-center"><i class="fa fa-file-word-o fa-5x"></i></h4>
										<div class="caption">
										<h4 class="text-center">{{$filename[1]}}</h4>
										</div>
									</a>
									
									@elseif($ext == 'xls' || $ext == 'xlsx')
									<a href="{{ URL::asset($maintenancerecord->adjunto_1)}}" target="_blank">
										<h4 class="text-center"><i class="fa fa-file-excel-o fa-5x"></i></h4>
										<div class="caption">
										<h4 class="text-center">{{$filename[1]}}</h4>
										</div>
									</a>
									
									@elseif($ext == 'rar' || $ext == 'zip')
									<a href="{{ URL::asset($maintenancerecord->adjunto_1)}}" target="_blank">
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
							@endif

                            @if(!empty($maintenancerecord->adjunto_2))
							<?php
							$filename = explode("-name-", $maintenancerecord->adjunto_2);
							$ext_array = explode(".", $maintenancerecord->adjunto_2);
							$ext = end($ext_array);
							?>
							<div class="col-sm-4">
								<div class="thumbnail">
									@if($ext == 'jpg' || $ext == 'png')
									<a href="{{ URL::asset($maintenancerecord->adjunto_2)}}" target="_blank">
										<img src="{{ URL::asset($maintenancerecord->adjunto_2)}}" width="300">
										<div class="caption">
										<h4 class="text-center">{{$filename[1]}}</h4>
										</div>
									</a>
									@elseif($ext == 'pdf')
									<a href="{{ URL::asset($maintenancerecord->adjunto_2)}}" target="_blank">
										<h4 class="text-center"><i class="fa fa fa-file-pdf-o fa-5x"></i></h4>
										<div class="caption">
										<h4 class="text-center">{{$filename[1]}}</h4>
										</div>
									</a>
									
									@elseif($ext == 'doc' || $ext == 'txt' || $ext == 'docx')
									<a href="{{ URL::asset($maintenancerecord->adjunto_2)}}" target="_blank">
										<h4 class="text-center"><i class="fa fa-file-word-o fa-5x"></i></h4>
										<div class="caption">
										<h4 class="text-center">{{$filename[1]}}</h4>
										</div>
									</a>
									
									@elseif($ext == 'xls' || $ext == 'xlsx')
									<a href="{{ URL::asset($maintenancerecord->adjunto_2)}}" target="_blank">
										<h4 class="text-center"><i class="fa fa-file-excel-o fa-5x"></i></h4>
										<div class="caption">
										<h4 class="text-center">{{$filename[1]}}</h4>
										</div>
									</a>
									
									@elseif($ext == 'rar' || $ext == 'zip')
									<a href="{{ URL::asset($maintenancerecord->adjunto_2)}}" target="_blank">
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
							@endif

                            @if(!empty($maintenancerecord->adjunto_3))
							<?php
							$filename = explode("-name-", $maintenancerecord->adjunto_3);
							$ext_array = explode(".", $maintenancerecord->adjunto_3);
							$ext = end($ext_array);
							?>
							<div class="col-sm-4">
								<div class="thumbnail">
									@if($ext == 'jpg' || $ext == 'png')
									<a href="{{ URL::asset($maintenancerecord->adjunto_3)}}" target="_blank">
										<img src="{{ URL::asset($maintenancerecord->adjunto_3)}}" width="300">
										<div class="caption">
										<h4 class="text-center">{{$filename[1]}}</h4>
										</div>
									</a>
									@elseif($ext == 'pdf')
									<a href="{{ URL::asset($maintenancerecord->adjunto_3)}}" target="_blank">
										<h4 class="text-center"><i class="fa fa fa-file-pdf-o fa-5x"></i></h4>
										<div class="caption">
										<h4 class="text-center">{{$filename[1]}}</h4>
										</div>
									</a>
									
									@elseif($ext == 'doc' || $ext == 'txt' || $ext == 'docx')
									<a href="{{ URL::asset($maintenancerecord->adjunto_3)}}" target="_blank">
										<h4 class="text-center"><i class="fa fa-file-word-o fa-5x"></i></h4>
										<div class="caption">
										<h4 class="text-center">{{$filename[1]}}</h4>
										</div>
									</a>
									
									@elseif($ext == 'xls' || $ext == 'xlsx')
									<a href="{{ URL::asset($maintenancerecord->adjunto_3)}}" target="_blank">
										<h4 class="text-center"><i class="fa fa-file-excel-o fa-5x"></i></h4>
										<div class="caption">
										<h4 class="text-center">{{$filename[1]}}</h4>
										</div>
									</a>
									
									@elseif($ext == 'rar' || $ext == 'zip')
									<a href="{{ URL::asset($maintenancerecord->adjunto_3)}}" target="_blank">
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
							@endif

                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        
                        <div class="form-group">
                            <div class="col-sm-12">
                                <a href="{{ route('equipment.maintenancerecord.index')}}" class="btn btn-white">Cancelar</a>
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
<!--Lenguaje datepicker español-->
<script type="text/javascript" src="{{ URL::asset('js/moment.es.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/summernote.min.js') }}"></script>

<script>
	$(document).ready(function(){
		$('.date-picker').datetimepicker({
			locale:'es',
			format: 'DD/MM/YYYY',
				widgetPositioning: {
				horizontal: 'left',
					vertical: 'bottom'
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
	$('#adjunto-1').on('clear.bs.fileinput', function(event) {
		$('#adjunto-ori-1').val('');
	});
	$('#adjunto-2').on('clear.bs.fileinput', function(event) {
		$('#adjunto-ori-2').val('');
	});
	$('#adjunto-3').on('clear.bs.fileinput', function(event) {
		$('#adjunto-ori-3').val('');
	});


	</script>

@endsection

