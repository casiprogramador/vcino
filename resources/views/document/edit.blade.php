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
                <strong>Editar documento</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <h5 style="padding-top: 2px;">Editar documento</h5>
                </div>

                <div class="ibox-content">
					 {!! Form::open(array('route' => array('communication.document.update', $document->id),'method' => 'patch' ,'class' => 'form-horizontal', 'files' => true)) !!}

                    <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
						<label class="col-sm-2 control-label">Nombre documento</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control input-sm" name="nombre" value="{{$document->nombre}}">
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
                                <input type="text" class="form-control input-sm date-picker" name="fecha" value="{{date('d/m/Y', strtotime($document->fecha)) }}">
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
                            <div id="archivo" class="fileinput input-group {{!empty($document->archivo) ? 'fileinput-exists'  : 'fileinput-new'}}" data-provides="fileinput">
                                <div class="form-control" data-trigger="fileinput">
                                    <i class="glyphicon glyphicon-file fileinput-exists"></i> 
                                    <span class="fileinput-filename">{{ (!empty($document->archivo) ) ? MenuRoute::filename($document->archivo) : "" }}</span>
                                </div>
                                <span class="input-group-addon btn btn-default btn-file">
                                    <span class="fileinput-new">Seleccionar archivo...</span>
                                    <span class="fileinput-exists">Cambiar</span>
                                    <input type="hidden" id="archivo-ori" name="archivo_ori" value="{{ (isset($document->archivo) ) ? $document->archivo : '' }}">
									<input type="hidden"name="size" value="{{ $document->size }}">
									<input type="hidden"name="type" value="{{ $document->type }}">
									<input type="file" name="archivo">
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

                    <div class="hr-line-dashed"></div>
                    <!--        SOLO PARA LA EDICIÓN SE ADICIONA EL BOTON Eliminar-->
					{!! Form::open(['route' => ['communication.document.destroy', $document->id], 'method' => 'delete']) !!}
					{!! Form::button('<i class="fa fa-trash"></i>&nbsp;&nbsp;Eliminar...', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('¿Esta usted seguro de eliminar este documento?')"]) !!}
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
	$('#archivo').on('clear.bs.fileinput', function(event) {
			$('#archivo-ori').val('');
	});
</script>
@endsection