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
                    <h5 style="padding-top: 2px;">Nuevo plan de mantenimiento</h5>
                </div>

                <div class="ibox-content">
                     {!! Form::open(array('route' => 'equipment.maintenanceplan.store', 'class' => 'form-horizontal', 'files' => true)) !!}

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Fecha estimada</label>
                            <div class="col-sm-3">
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" class="form-control input-sm date-picker" name="fecha" value="{{ date('d/m/Y') }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Equipo</label>
                            <div class="col-sm-6">
                                {{ Form::select('equipo',['0' => 'Seleccione un equipo']+$equipmets,old('equipo'), ['class' => 'form-control input-sm']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Referencia</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control input-sm">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Costo estimado</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control input-sm">
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
						
						<div class="form-group" id="nota">
							<label class="col-sm-3 control-label">Notas</label>
							<div class="col-sm-8">
								<div class="no-padding">
									<textarea id="summernote" name="notas"></textarea>
								</div>
							</div>
						</div>

                        <div class="hr-line-dashed"></div>
                        
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-success" type="submit" style="margin-right: 10px;">Crear plan</button>
                                <a href="#" class="btn btn-white" type="submit">Cancelar</a>
                            </div>
                        </div>

                        <!--    ESTA PARTE SOLO PARA LA OPCION <<EDITAR>>       -->
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-danger" type="submit">
                                    <i class="fa fa-trash"></i>&nbsp;&nbsp;Eliminar...</button>
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

