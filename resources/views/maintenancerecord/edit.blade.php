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
                <strong>Editar registro de mantenimiento</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <h5 style="padding-top: 2px;">Editar registro de mantenimiento</h5>
                </div>

                <div class="ibox-content">

					{!! Form::open(array('route' => array('equipment.maintenancerecord.update', $maintenancerecord->id),'method' => 'patch' ,'class' => 'form-horizontal', 'files' => true)) !!}
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
                                    <input type="text" class="form-control input-sm date-picker" name="fecha" value="{{ date_format(date_create($maintenancerecord->fecha_realizacion),'d/m/Y') }}">
									@if ($errors->has('fecha'))
										<span class="help-block">
											<strong>{{ $errors->first('fecha') }}</strong>
										</span>
									@endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('equipo') ? ' has-error' : '' }}">
                            <label class="col-sm-3 control-label">Equipo</label>
                            <div class="col-sm-5">
                                {{ Form::select('equipo',['0' => 'Seleccione un equipo']+$equipmets,$maintenancerecord->equipment_id, ['class' => 'form-control input-sm']) }}
								@if ($errors->has('equipo'))
										<span class="help-block">
											<strong>{{ $errors->first('equipo') }}</strong>
										</span>
								@endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('proveedor') ? ' has-error' : '' }}">
                            <label class="col-sm-3 control-label">Proveedor</label>
                            <div class="col-sm-5">
                                {{ Form::select('proveedor',['0' => 'Seleccione un proveedor']+$suppliers,$maintenancerecord->supplier_id, ['class' => 'form-control input-sm']) }}
								@if ($errors->has('proveedor'))
										<span class="help-block">
											<strong>{{ $errors->first('proveedor') }}</strong>
										</span>
								@endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('costo') ? ' has-error' : '' }}">
                            <label class="col-sm-3 control-label">Costo</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control input-sm" name="costo" value="{{$maintenancerecord->costo}}">
								@if ($errors->has('costo'))
										<span class="help-block">
											<strong>{{ $errors->first('costo') }}</strong>
										</span>
								@endif
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
								['class' => 'form-control input-sm']) }}
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group" id="nota">
							<label class="col-sm-3 control-label">Notas</label>
							<div class="col-sm-8">
								<div class="no-padding">
									<textarea id="summernote" name="notas">{{$maintenancerecord->notas}}</textarea>
								</div>
							</div>
						</div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Adjuntos</label>
                            <div class="col-sm-8">

                                <div id="adjunto-1" class="fileinput input-group {{!empty($maintenancerecord->adjunto_1) ? 'fileinput-exists'  : 'fileinput-new'}}" data-provides="fileinput">
                                    <div class="form-control" data-trigger="fileinput">
                                        <i class="glyphicon glyphicon-file fileinput-exists"></i> 
                                        <span class="fileinput-filename">
											{{ (!empty($maintenancerecord->adjunto_1) ) ? MenuRoute::filename($maintenancerecord->adjunto_1) : "" }}
										</span>
                                    </div>
                                    <span class="input-group-addon btn btn-default btn-file">
                                        <span class="fileinput-new">Seleccionar archivo...</span>
                                        <span class="fileinput-exists">Cambiar</span>
                                        <input type="file" name="adjunto_1">
										<input type="hidden" id="adjunto-ori-1" name="adjunto_ori_1" value="{{ (isset($maintenancerecord->adjunto_1) ) ? $maintenancerecord->adjunto_1 : '' }}">
                                    </span>
                                    <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Eliminar</a>
                                </div>

                                <div id="adjunto-2" class="fileinput input-group {{!empty($maintenancerecord->adjunto_2) ? 'fileinput-exists'  : 'fileinput-new'}}" data-provides="fileinput">
                                    <div class="form-control" data-trigger="fileinput">
                                        <i class="glyphicon glyphicon-file fileinput-exists"></i> 
                                        <span class="fileinput-filename">
											{{ (!empty($maintenancerecord->adjunto_2) ) ? MenuRoute::filename($maintenancerecord->adjunto_2) : "" }}
										</span>
                                    </div>
                                    <span class="input-group-addon btn btn-default btn-file">
                                        <span class="fileinput-new">Seleccionar archivo...</span>
                                        <span class="fileinput-exists">Cambiar</span>
                                        <input type="file" name="adjunto_2">
										<input type="hidden" id="adjunto-ori-2" name="adjunto_ori_2" value="{{ (isset($maintenancerecord->adjunto_2) ) ? $maintenancerecord->adjunto_2 : '' }}">
                                    </span>
                                    <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Eliminar</a>
                                </div>

                                <div id="adjunto-3" class="fileinput input-group {{!empty($maintenancerecord->adjunto_3) ? 'fileinput-exists'  : 'fileinput-new'}}" data-provides="fileinput">
                                    <div class="form-control" data-trigger="fileinput">
                                        <i class="glyphicon glyphicon-file fileinput-exists"></i> 
                                        <span class="fileinput-filename">
											{{ (!empty($maintenancerecord->adjunto_3) ) ? MenuRoute::filename($maintenancerecord->adjunto_3) : "" }}
										</span>
                                    </div>
                                    <span class="input-group-addon btn btn-default btn-file">
                                        <span class="fileinput-new">Seleccionar archivo...</span>
                                        <span class="fileinput-exists">Cambiar</span>
                                        <input type="file" name="adjunto_3">
										<input type="hidden" id="adjunto-ori-3" name="adjunto_ori_3" value="{{ (isset($maintenancerecord->adjunto_3) ) ? $maintenancerecord->adjunto_3 : '' }}">
                                    </span>
                                    <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Eliminar</a>
                                </div>

                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-success" type="submit" style="margin-right: 10px;">Registrar mantenimiento</button>
                                <a href="{{ route('equipment.maintenancerecord.index')}}" class="btn btn-white">Cancelar</a>
                            </div>
                        </div>
						

                    {!! Form::close() !!}
					                        <!--    ESTA PARTE SOLO PARA LA OPCION <<EDITAR>>       -->
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-12">
                               {!! Form::open(['route' => ['equipment.maintenancerecord.destroy', $maintenancerecord->id], 'method' => 'delete']) !!}
					{!! Form::button('<i class="fa fa-trash"></i>&nbsp;&nbsp;Eliminar...', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('¿Esta usted seguro de eliminar el registro?')"]) !!}
					{!! Form::close() !!}
                            </div>
                        </div>
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

