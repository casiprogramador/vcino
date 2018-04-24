@extends('layouts.admin')

@section('admin-content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Registro de mantenimiento</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.home') }}">Inicio</a>
            </li>
            <li>
                Equipamiento
            </li>
            <li>
                <a href="{{ route('equipment.maintenancerecord.index') }}">Registro de mantenimiento</a>
            </li>
            <li class="active">
                <strong>Nuevo</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <h5 style="padding-top: 2px;">Nuevo registro de mantenimiento</h5>
                </div>

                <div class="ibox-content">
                    {!! Form::open(array('route' => 'equipment.maintenancerecord.store', 'class' => 'form-horizontal', 'files' => true)) !!}
					<input type="hidden" value="{{ (isset($maintenanceplan->id) ) ? $maintenanceplan->id : '0' }}" name="id_maintenanceplan">
                         <div class="form-group{{ $errors->has('fecha') ? ' has-error' : '' }}">
                            <label class="col-sm-3 control-label">Fecha de realización</label>
                            <div class="col-sm-3">
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" class="form-control input-sm date-picker" name="fecha" 
										   value="{{ old('fecha',(isset($maintenanceplan->fecha_estimada) ) ? date_format(date_create($maintenanceplan->fecha_estimada),'d/m/Y') : date('d/m/Y') ) }}">
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
                                {{ Form::select('equipo',['0' => 'Seleccione un equipo']+$equipmets,(isset($maintenanceplan->id) ) ? $maintenanceplan->equipment_id :old('equipo'), ['class' => 'form-control input-sm']) }}
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
                                {{ Form::select('proveedor',['0' => 'Seleccione un proveedor']+$suppliers,old('proveedor'), ['class' => 'form-control input-sm']) }}
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
                                <input type="text" class="form-control input-sm" name="costo" value="{{ (isset($maintenanceplan->costo_estimado) ) ? $maintenanceplan->costo_estimado : old('costo') }}">
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
								 {{ Form::select('tipo',array('Preventivo' => 'Preventivo','Correctivo' => 'Correctivo', 'Emergencia' => 'Emergencia'),old('tipo'),['class' => 'form-control input-sm']) }}
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group" id="nota">
							<label class="col-sm-3 control-label">Notas</label>
							<div class="col-sm-8">
								<div class="no-padding">
									<textarea id="summernote" name="notas">
										<?php echo (isset($maintenanceplan->notas) ) ? $maintenanceplan->notas : old('notas') ?>
									</textarea>
								</div>
							</div>
						</div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Adjuntos</label>
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

                        <div class="hr-line-dashed"></div>
                        
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-success" type="submit" style="margin-right: 10px;">Registrar mantenimiento</button>
                                <a href="{{ route('equipment.maintenancerecord.index')}}" class="btn btn-white" >Cancelar</a>
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

	</script>

@endsection

