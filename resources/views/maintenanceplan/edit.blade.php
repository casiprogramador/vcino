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
                <strong>Editar</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <h5 style="padding-top: 2px;">Editar plan de mantenimiento</h5>
                </div>

                <div class="ibox-content">
					 {!! Form::open(array('route' => array('equipment.maintenanceplan.update', $maintenanceplan->id),'method' => 'patch' ,'class' => 'form-horizontal')) !!}

                        <div class="form-group{{ $errors->has('fecha') ? ' has-error' : '' }}">
                            <label class="col-sm-3 control-label">Fecha estimada</label>
                            <div class="col-sm-3">
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" class="form-control input-sm date-picker" name="fecha" value="{{ date_format(date_create($maintenanceplan->fecha_estimada),'d/m/Y') }}">
									 @if ($errors->has('fecha'))
										<span class="help-block">
											<strong>{{ $errors->first('fecha') }}</strong>
										</span>
									@endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Equipo</label>
                            <div class="col-sm-6">
                                {{ Form::select('equipo',['0' => 'Seleccione un equipo']+$equipmets,
								$maintenanceplan->equipment_id, ['class' => 'form-control input-sm']) }}
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('referencia') ? ' has-error' : '' }}">
                            <label class="col-sm-3 control-label">Referencia</label>
                            <div class="col-sm-6">
                                <input type="text" name="referencia" class="form-control input-sm" value="{{$maintenanceplan->referencia}}">
								@if ($errors->has('referencia'))
									<span class="help-block">
										<strong>{{ $errors->first('referencia') }}</strong>
									</span>
								@endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('costo') ? ' has-error' : '' }}">
                            <label class="col-sm-3 control-label">Costo estimado</label>
                            <div class="col-sm-3">
                                <input type="text" name="costo" class="form-control input-sm" value="{{$maintenanceplan->costo_estimado}}">
								@if ($errors->has('costo'))
									<span class="help-block">
										<strong>{{ $errors->first('costo') }}</strong>
									</span>
								@endif
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
						
						<div class="form-group" id="nota">
							<label class="col-sm-3 control-label">Notas</label>
							<div class="col-sm-8">
								<div class="no-padding">
									<textarea id="summernote" name="notas">{{$maintenanceplan->notas}}</textarea>
								</div>
							</div>
						</div>

                        <div class="hr-line-dashed"></div>
                        
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-success" type="submit" style="margin-right: 10px;">Editar plan</button>
                                <a href="{{ route('equipment.maintenanceplan.index')}}" class="btn btn-white" type="submit">Cancelar</a>
                            </div>
                        </div>

                       

                    {!! Form::close() !!}
					 <!--    ESTA PARTE SOLO PARA LA OPCION <<EDITAR>>       -->
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                  {!! Form::open(['route' => ['equipment.maintenanceplan.destroy', $maintenanceplan->id], 'method' => 'delete']) !!}
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

	</script>

@endsection

