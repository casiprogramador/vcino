@extends('layouts.admin')

@section('admin-content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Equipamiento</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('admin.home') }}">Inicio</a>
                </li>
                <li>
                    Equipamiento
                </li>
                <li>
                    <a href="{{ route('equipment.machinery.index') }}">Equipos y maquinarias</a>
                </li>
                <li class="active">
                    <strong>Nuevo equipo</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">

                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        {!! Form::open(array('route' => 'equipment.machinery.store', 'class' => 'form-horizontal', 'files' => true)) !!}

                            <div class="tabs-container">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#tab-1">Nuevo equipo</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="tab-1" class="tab-pane active">
                                        <div class="panel-body">

                                            <div class="form-group{{ $errors->has('equipo') ? ' has-error' : '' }}">
                                                <label class="col-sm-3 control-label">Equipo</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control input-sm" name="equipo" value="{{old('equipo')}}">
                                                    @if ($errors->has('equipo'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('equipo') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('tipo_equipo') ? ' has-error' : '' }}">
                                                <label class="col-sm-3 control-label">Tipo de equipo</label>
                                                <div class="col-sm-3">
                                                    {{ Form::select('tipo_equipo',array('0' => 'Seleccione','Equipo' => 'Equipo', 'Instalaciones' => 'Instalaciones', 'Mobiliario' => 'Mobiliario', 'Otro' => 'Otro'),old('tipo_equipo'),['class' => 'form-control input-sm']) }}
                                                    @if ($errors->has('tipo_equipo'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('tipo_equipo') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('ubicacion') ? ' has-error' : '' }}">
                                                <label class="col-sm-3 control-label">Ubicación</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control input-sm" name="ubicacion" value="{{old('ubicacion')}}">
                                                    @if ($errors->has('ubicacion'))
                                                        <span class="help-block">
                                                    <strong>{{ $errors->first('ubicacion') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="hr-line-dashed"></div>

                                            <div class="form-group{{ $errors->has('proveedor') ? ' has-error' : '' }}">
                                                <label class="col-sm-3 control-label">Proveedor</label>
                                                <div class="col-sm-6">
                                                    {{ Form::select('proveedor',['0' => 'Seleccione']+$suppliers,old('proveedor'), ['class' => 'form-control input-sm']) }}
                                                    @if ($errors->has('proveedor'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('proveedor') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('fecha_instalacion') ? ' has-error' : '' }}">
                                                <label class="col-sm-3 control-label">Fecha de instalación o compra</label>
                                                <div class="col-sm-4">
                                                    <div class="input-group date">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        <input type="text" class="form-control date-picker" name="fecha_instalacion" 
                                                        value="{{ old('fecha_instalacion', date('d/m/Y')) }}">
                                                        @if ($errors->has('fecha_instalacion'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('fecha_instalacion') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('vida') ? ' has-error' : '' }}">
                                                <label class="col-sm-3 control-label">Vida útil (meses)</label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control input-sm" name="vida" value="{{old('vida')}}">
                                                    @if ($errors->has('vida'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('vida') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('garantia') ? ' has-error' : '' }}">
                                                <label class="col-sm-3 control-label">Garantía (meses)</label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control input-sm" name="garantia" value="{{old('garantia')}}">
                                                    @if ($errors->has('garantia'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('garantia') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('mantenimiento') ? ' has-error' : '' }}">
                                                <label class="col-sm-3 control-label">Frecuencia mantenimiento (meses)</label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control input-sm" name="mantenimiento" value="{{old('mantenimiento')}}">
                                                    @if ($errors->has('mantenimiento'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('mantenimiento') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="hr-line-dashed"></div>

                                            <div class="form-group{{ $errors->has('notas') ? ' has-error' : '' }}">
                                                <label class="col-sm-3 control-label">Notas</label>
                                                <div class="col-sm-9">
                                                    <textarea id="summernote" name="notas" name="notas">{{old('notas')}}</textarea>
                                                </div>
                                                @if ($errors->has('notas'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('notas') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="hr-line-dashed"></div>

                                            <div class="form-group{{ $errors->has('documento') ? ' has-error' : '' }}">
                                                <label class="col-sm-3 control-label">Documento</label>

                                                <div class="col-sm-5">
                                                    <label title="Upload image file" for="inputImage">
                                                        <div class="fileinput input-group fileinput-new" data-provides="fileinput">
                                                            <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                                                            <span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new">Seleccionar archivo...</span><span class="fileinput-exists">Cambiar</span><input type="file" name="documento"></span>
                                                            <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Eliminar</a>
                                                        </div>
                                                    </label>
                                                    @if ($errors->has('documento'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('documento') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="col-sm-3">
                                                    <p style="font-size: 11px; color: #B0B0B0;">Manual, ficha técnica. Documento que se adjunta al equipo.</p>
                                                </div>
                                            </div>

                                            <div class="hr-line-dashed"></div>

                                            <div class="form-group{{ $errors->has('fotografia_1') ? ' has-error' : '' }}">
                                                <label class="col-sm-3 control-label">Fotografía #1</label>
                                                <div class="col-sm-7">
                                                    <label title="Upload image file" for="inputImage">
                                                        <div class="fileinput input-group fileinput-new" data-provides="fileinput">
                                                            <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                                                            <span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new">Seleccionar archivo...</span><span class="fileinput-exists">Cambiar</span><input type="file" name="fotografia_1"></span>
                                                            <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Eliminar</a>
                                                        </div>
                                                    </label>
                                                    @if ($errors->has('fotografia_1'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('fotografia_1') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('fotografia_2') ? ' has-error' : '' }}">
                                                <label class="col-sm-3 control-label">Fotografía #2</label>
                                                <div class="col-sm-7">
                                                    <label title="Upload image file" for="inputImage">
                                                        <div class="fileinput input-group fileinput-new" data-provides="fileinput">
                                                            <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                                                            <span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new">Seleccionar archivo...</span><span class="fileinput-exists">Cambiar</span><input type="file" name="fotografia_2"></span>
                                                            <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Eliminar</a>
                                                        </div>
                                                    </label>
                                                    @if ($errors->has('fotografia_2'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('fotografia_2') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('fotografia_3') ? ' has-error' : '' }}">
                                                <label class="col-sm-3 control-label">Fotografía #3</label>
                                                <div class="col-sm-7">
                                                    <label title="Upload image file" for="inputImage">
                                                        <div class="fileinput input-group fileinput-new" data-provides="fileinput">
                                                            <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                                                            <span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new">Seleccionar archivo...</span><span class="fileinput-exists">Cambiar</span><input type="file" name="fotografia_3"></span>
                                                            <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Eliminar</a>
                                                        </div>
                                                    </label>
                                                    @if ($errors->has('fotografia_3'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('fotografia_3') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="hr-line-dashed"></div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Activo</label>
                                                <div class="col-sm-4">
                                                    <label><input type="checkbox" class="i-checks" name="activa" value="1" checked></label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-success" type="submit" style="margin-right: 10px;">Crear equipo</button>
                                        <a href="{{ route('equipment.machinery.index') }}" class="btn btn-white" >Cancelar</a>
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

@section('style')
    <link rel="stylesheet" href="{{ URL::asset('css/summernote.css') }}" />
@endsection

@section('javascript')
    <script type="text/javascript" src="{{ URL::asset('js/summernote.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });

        });
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 300,
                toolbar: [
                ['style', ['style']],
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']]
               ]
            });
        });
        $('.date-picker').datetimepicker({
            format: 'DD/MM/YYYY'
        });
    </script>
@endsection