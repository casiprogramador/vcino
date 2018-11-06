@extends('layouts.admin')

@section('admin-content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Documentos de interés</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.home') }}">Inicio</a>
            </li>
            <li>
                Comunicación & Información
            </li>
            <li>
                <a href="{{ route('communication.document.index') }}">Documentos de interés</a>
            </li>
            <li class="active">
                <strong>Nuevo documento</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <h5 style="padding-top: 2px;">Nuevo documento</h5>
                </div>

                <div class="ibox-content">
                     {!! Form::open(array('route' => 'communication.document.store', 'class' => 'form-horizontal', 'files' => true)) !!}

                    <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
						<label class="col-sm-2 control-label">Nombre documento</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control input-sm" name="nombre" value="{{old('nombre')}}">
							@if ($errors->has('nombre'))
								<span class="help-block">
									<strong>{{ $errors->first('nombre') }}</strong>
								</span>
							@endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('fecha') ? ' has-error' : '' }}">
                        <label class="col-sm-2 control-label">Fecha</label>
                        <div class="col-sm-3">
                            <div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" class="form-control input-sm date-picker" name="fecha" value="{{ date('d/m/Y') }}">
								@if ($errors->has('fecha'))
									<span class="help-block">
											<strong>{{ $errors->first('fecha') }}</strong>
										</span>
								@endif
                            </div>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Archivo</label>
                        <div class="col-sm-8">

                            <div class="fileinput input-group fileinput-new" data-provides="fileinput">
                                <div class="form-control" data-trigger="fileinput">
                                    <i class="glyphicon glyphicon-file fileinput-exists"></i> 
                                    <span class="fileinput-filename"></span>
                                </div>
                                <span class="input-group-addon btn btn-default btn-file">
                                    <span class="fileinput-new">Seleccionar archivo...</span>
                                    <span class="fileinput-exists">Cambiar</span>
                                    <input type="hidden" value=""><input type="file" name="archivo">
                                </span>
                                <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Eliminar</a>
                            </div>
							@if ($errors->has('archivo'))
								<span class="help-block">
										<strong>{{ $errors->first('archivo') }}</strong>
									</span>
							@endif
                            <span class="help-block m-b-none" style="color: #d1d1d1">Tamaño máximo permitido de 5 Mb.</span>

                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-success" type="submit" style="margin-right: 10px;">Guardar</button>
                            <a href="{{ route('communication.document.index') }}" class="btn btn-white" type="submit">Cancelar</a>
                        </div>
                    </div>
                    {!! Form::close() !!}

                    

                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@section('javascript')
<script type="text/javascript" src="{{ URL::asset('js/summernote.min.js') }}"></script>
<script>

	$('.date-picker').datetimepicker({
		format: 'DD/MM/YYYY'
	});
</script>
@endsection