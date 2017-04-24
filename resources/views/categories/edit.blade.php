@extends('layouts.admin')

@section('admin-content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Categorías</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('admin.home') }}">Inicio</a>
                </li>
                <li>
                    Configuración
                </li>
                <li>
                    <a href="{{ route('config.category.index') }}">Categorías</a>
                </li>
                <li class="active">
                    <strong>Editar categoría</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">

                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        {!! Form::open(array('route' => array('config.category.update', $category->id),'method' => 'patch' ,'class' => 'form-horizontal', 'files' => true)) !!}

                        <div class="tabs-container">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#tab-1">Editar categoría</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="tab-1" class="tab-pane active">
                                    <div class="panel-body">

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Tipo</label>
                                            <div class="col-sm-3">
                                                {{ Form::select('tipo_categoria',array('0' => 'Seleccione','Egreso' => 'Egreso', 'Ingreso' => 'Ingreso'),$category->tipo_categoria,['class' => 'form-control input-sm']) }}
                                                @if ($errors->has('tipo_categoria'))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first('tipo_categoria') }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Clase</label>
                                            <div class="col-sm-3">
                                                {{ Form::select('clase',array('0' => 'Seleccione','Ordinaria' => 'Ordinaria', 'Extraordinaria' => 'Extraordinaria'),$category->clase,['class' => 'form-control input-sm']) }}
                                                @if ($errors->has('clase'))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first('clase') }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Categoría</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control input-sm" name="nombre" value="{{$category->nombre}}">
                                                @if ($errors->has('nombre'))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first('nombre') }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Descripción</label>
                                            <div class="col-sm-8">
                                                <textarea rows="4" class="form-control input-sm" name="description">{{$category->description}}</textarea>
                                                @if ($errors->has('description'))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first('description') }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Icono</label>
                                            <div class="col-sm-8">
                                                <label title="Upload image file" for="inputImage">

													<div class="fileinput input-group fileinput-new" data-provides="fileinput">
														<div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
														<span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new">Seleccionar archivo...</span><span class="fileinput-exists">Cambiar</span><input type="file" name="icono"></span>
														<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Eliminar</a>
													</div>
                                                </label>
                                                @if ($errors->has('icono'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('icono') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Activa</label>
                                            <div class="col-sm-4">

                                                <div>
                                                    <input type="checkbox" class="i-checks" name="activa" value="1" {{ ($category->activa == 1) ? 'checked' : '' }}>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button class="btn btn-success" type="submit" style="margin-right: 10px;">Guardar</button>
                                    <a href="{{ route('config.category.index') }}" class="btn btn-white" >Cancelar</a>
                                </div>
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
    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>
@endsection
