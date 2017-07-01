@extends('layouts.admin')

@section('admin-content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Instalaciones comunes</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('admin.home') }}">Inicio</a>
                </li>
                <li class="active">
                    Configuración
                </li>
                <li class="active">
                    <a href="{{ route('config.installation.index') }}">Instalaciones comunes</a>
                </li>
                <li class="active">
                    <strong>Editar instalación</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">

                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        {!! Form::open(array('route' => array('config.installation.update', $installation->id),'method' => 'patch' ,'class' => 'form-horizontal', 'files' => true)) !!}

                        <div class="tabs-container">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#tab-1">Editar Instalación</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="tab-1" class="tab-pane active">
                                    <div class="panel-body">

                                        <div class="form-group{{ $errors->has('instalacion') ? ' has-error' : '' }}">
                                            <label class="col-sm-3 control-label">Instalación</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control input-sm" name="instalacion" value="{{$installation->instalacion}}">
                                                @if ($errors->has('instalacion'))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first('instalacion') }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}">
                                            <label class="col-sm-3 control-label">Descripción</label>
                                            <div class="col-sm-9">
                                                <textarea rows="2" class="form-control input-sm" name="descripcion">{{$installation->descripcion}}</textarea>
                                                @if ($errors->has('descripcion'))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first('descripcion') }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group{{ $errors->has('costo') ? ' has-error' : '' }}">
                                            <label class="col-sm-3 control-label">Costo</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control input-sm" name="costo" value="{{$installation->costo}}">
                                                @if ($errors->has('costo'))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first('costo') }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                            <div class="col-md-5">
                                                <p style="font-size: 11px; color: #B0B0B0;">Si la instalación comun tiene un costo por utilización. Al momento de realizar la reserva, este monto será acreditado a la propiedad.</p>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Requiere reserva</label>
                                            <div class="col-sm-4">
                                                <label><input type="checkbox" class="i-checks" value="1" name="requiere_reserva" {{ ($installation->requiere_reserva == 1) ? 'checked' : '' }}></label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Permitir reserva con deuda</label>
                                            <div class="col-sm-4">
                                                <label><input type="checkbox" class="i-checks" name="reserva_deuda" value="1" {{ ($installation->reserva_deuda == 1) ? 'checked' : '' }}></label>
                                            </div>
                                        </div>

                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Días permitidos</label>
                                            <div class="col-sm-2">
                                                <label class="checkbox-inline" style="padding-top: 0; padding-left: 0;">
                                                    <input type="checkbox" class="i-checks" name='dias_permitidos[]' value="lunes" {{ (in_array('lunes',explode(',',$installation->dias_permitidos))) ? 'checked' : '' }}>&nbsp;&nbsp;Lunes</label>
                                            </div>
                                            <div class="col-sm-2">
                                                <label class="checkbox-inline" style="padding-top: 0; padding-left: 0;">
                                                    <input type="checkbox" class="i-checks" name='dias_permitidos[]' value="martes" {{ (in_array('martes',explode(',',$installation->dias_permitidos))) ? 'checked' : '' }}>&nbsp;&nbsp;Martes</label>
                                            </div>
                                            <div class="col-sm-2">
                                                <label class="checkbox-inline" style="padding-top: 0; padding-left: 0;">
                                                    <input type="checkbox" class="i-checks" name='dias_permitidos[]' value="miercoles" {{ (in_array('miercoles',explode(',',$installation->dias_permitidos))) ? 'checked' : '' }}>&nbsp;&nbsp;Miércoles</label>
                                            </div>
                                            <div class="col-sm-2">
                                                <label class="checkbox-inline" style="padding-top: 0; padding-left: 0;">
                                                    <input type="checkbox" class="i-checks" name='dias_permitidos[]' value="jueves" {{ (in_array('jueves',explode(',',$installation->dias_permitidos))) ? 'checked' : '' }}>&nbsp;&nbsp;Jueves</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"></label>
                                            <div class="col-sm-2">
                                                <label class="checkbox-inline" style="padding-top: 0; padding-left: 0;">
                                                    <input type="checkbox" class="i-checks" name='dias_permitidos[]' value="viernes" {{ (in_array('viernes',explode(',',$installation->dias_permitidos))) ? 'checked' : '' }}>&nbsp;&nbsp;Viernes</label>
                                            </div>
                                            <div class="col-sm-2">
                                                <label class="checkbox-inline" style="padding-top: 0; padding-left: 0;">
                                                    <input type="checkbox" class="i-checks" name='dias_permitidos[]' value="sabado" {{ (in_array('sabado',explode(',',$installation->dias_permitidos))) ? 'checked' : '' }}>&nbsp;&nbsp;Sábado</label>
                                            </div>
                                            <div class="col-sm-2">
                                                <label class="checkbox-inline" style="padding-top: 0; padding-left: 0;">
                                                    <input type="checkbox" class="i-checks" name='dias_permitidos[]' value="domingo" {{ (in_array('domingo',explode(',',$installation->dias_permitidos))) ? 'checked' : '' }}>&nbsp;&nbsp;Domingo</label>
                                            </div>

                                        </div>
                                        @if ($errors->has('dias_permitidos'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('dias_permitidos') }}</strong>
                                            </span>
                                        @endif

                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group{{ $errors->has('hora_dia_semana_hasta') ? ' has-error' : '' }}">
                                            <label class="col-sm-3 control-label">Horario semana</label>
                                            <div class="col-sm-3">
                                                <div class="input-group clockpicker" data-autoclose="true">
                                                    <input type="text" class="form-control" name="hora_dia_semana_hasta" value="{{$installation->hora_dia_semana_hasta}}">

                                                    <span class="input-group-addon">
                                                            <span class="fa fa-clock-o"></span>
                                                        </span>

                                                </div>
                                                @if ($errors->has('hora_dia_semana_hasta'))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first('hora_dia_semana_hasta') }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <p style="font-size: 11px; color: #B0B0B0;">Ingrese el horario máximo permitido de permanencia para los días entre semana.</p>
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('hora_fin_de_semana_hasta') ? ' has-error' : '' }}">
                                            <label class="col-sm-3 control-label">Horario fin de semana</label>
                                            <div class="col-sm-3">
                                                <div class="input-group clockpicker" data-autoclose="true">
                                                    <input type="text" class="form-control"  name="hora_fin_de_semana_hasta" value="{{$installation->hora_fin_de_semana_hasta}}">
                                                    <span class="input-group-addon">
                                                    <span class="fa fa-clock-o"></span>
                                                </span>
                                                </div>
                                                @if ($errors->has('hora_fin_de_semana_hasta'))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first('hora_fin_de_semana_hasta') }}</strong>
                                                        </span>
                                                @endif
                                            </div>

                                            <div class="col-md-6">
                                                <p style="font-size: 11px; color: #B0B0B0;">Ingrese el horario máximo permitido de permanencia para los fines de semana y feriados.</p>
                                            </div>
                                        </div>

                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group{{ $errors->has('normas') ? ' has-error' : '' }}">
                                            <label class="col-sm-3 control-label">Principales normas</label>
                                            <div class="col-sm-9">
                                                <div class="no-padding">
                                                    <textarea id="summernote" name="normas">{{ $installation->normas }}</textarea>
                                                </div>
                                                @if ($errors->has('normas'))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first('normas') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group{{ $errors->has('reglamento') ? ' has-error' : '' }}">
                                            <label class="col-sm-3 control-label">Normas o Reglamento</label>
                                            <div class="col-sm-9">
                                                <label title="Upload image file" for="inputImage">

                                                    {{Form::file('reglamento', array('class'=>'') )}}
                                                </label>
                                                @if ($errors->has('reglamento'))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first('reglamento') }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group{{ $errors->has('fotografia_principal') ? ' has-error' : '' }}">
                                            <label class="col-sm-3 control-label">Fotografía principal</label>
                                            <div class="col-sm-9">
                                                <label title="Upload image file" for="inputImage">

                                                    {{Form::file('fotografia_principal', array('class'=>'') )}}
                                                </label>
                                                @if ($errors->has('fotografia_principal'))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first('fotografia_principal') }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('fotografia_1') ? ' has-error' : '' }}">
                                            <label class="col-sm-3 control-label">Fotografía #1</label>
                                            <div class="col-sm-9">
                                                <label title="Upload image file" for="inputImage">

                                                    {{Form::file('fotografia_1', array('class'=>'') )}}
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
                                            <div class="col-sm-9">
                                                <label title="Upload image file" for="inputImage">

                                                    {{Form::file('fotografia_2', array('class'=>'') )}}
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
                                            <div class="col-sm-9">
                                                <label title="Upload image file" for="inputImage">

                                                    {{Form::file('fotografia_3', array('class'=>'') )}}
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
                                            <label class="col-sm-3 control-label">Activa</label>
                                            <div class="col-sm-4">
                                                <label><input type="checkbox" class="i-checks" name="activa" value="1" {{ ($installation->activa == 1) ? 'checked' : '' }}></label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button class="btn btn-success" type="submit" style="margin-right: 10px;">Guardar</button>
                                    <a href="{{ route('config.installation.index') }}" class="btn btn-white" >Cancelar</a>
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

        $('.clockpicker').clockpicker();
    </script>
@endsection
