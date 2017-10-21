@extends('layouts.admin')

@section('admin-content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Teléfonos y sitios útiles</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('admin.home') }}">Inicio</a>
                </li>
                <li>
                    Comunicación & Información
                </li>
                <li>
                    <a href="{{ route('communication.phonesite.index') }}">Teléfonos y sitios útiles</a>
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
                    <div class="ibox-content">
                        {!! Form::open(array('route' => 'communication.phonesite.store', 'class' => 'form-horizontal')) !!}

                            <div class="tabs-container">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#tab-1">Nuevo</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="tab-1" class="tab-pane active">
                                        <div class="panel-body">

                                            <div class="form-group{{ $errors->has('razon_social') ? ' has-error' : '' }}">
                                                <label class="col-sm-3 control-label">Razón social/ Nombre</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control input-sm" name="razon_social" value="{{old('razon_social')}}">
                                                    @if ($errors->has('razon_social'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('razon_social') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('categoria') ? ' has-error' : '' }}">
                                                <label class="col-sm-3 control-label">Categoría</label>
                                                <div class="col-sm-5">
                                                    {{ Form::select('categoria',array('0' => 'Seleccione','Emergencias y seguridad ciudadana' => 'Emergencias y seguridad ciudadana', 'Empresas y servicios profesionales' => 'Empresas y servicios profesionales', 'Instituciones financieras' => 'Instituciones financieras', 'Instituciones públicas' => 'Instituciones públicas', 'Medios de comunicación' => 'Medios de comunicación', 'Salud' => 'Salud','Servicios básicos' => 'Servicios básicos', 'Otras categorías' => 'Otras categorías'),old('categoria'),['class' => 'form-control input-sm']) }}
                                                    @if ($errors->has('categoria'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('categoria') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('telefono') ? ' has-error' : '' }}">
                                                <label class="col-sm-3 control-label">Teléfonos</label>
                                                <div class="col-sm-9">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <input type="text" placeholder="Fijo/ Móvil" class="form-control input-sm" name="telefono" value="{{old('telefono')}}">
                                                            @if ($errors->has('telefono'))
                                                                <span class="help-block">
                                                            <strong>{{ $errors->first('telefono') }}</strong>
                                                        </span>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="text" placeholder="Tel. Emergencias" class="form-control input-sm" style= "background-color: #ECF7FE" name="telefono_emergencia" value="{{old('telefono_emergencia')}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="hr-line-dashed"></div>

                                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                <label class="col-sm-3 control-label">E-mail</label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control input-sm" name="email" value="{{old('email')}}">
                                                    @if ($errors->has('email'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('sitio_web') ? ' has-error' : '' }}">
                                                <label class="col-sm-3 control-label">Sitio web</label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control input-sm" placeholder="http://www.empresa.com" name="sitio_web" value="{{old('sitio_web')}}">
                                                    @if ($errors->has('sitio_web'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('sitio_web') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Dirección</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control input-sm" name="direccion" value="{{old('direccion')}}">
                                                </div>
                                            </div>

                                            <div class="hr-line-dashed"></div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Notas</label>
                                                <div class="col-sm-9">
                                                    <textarea rows="3" class="form-control input-sm" name="notas">{{old('notas')}}</textarea>
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
                                        <button class="btn btn-success" type="submit" style="margin-right: 10px;">Crear</button>
                                        <a href="{{ route('communication.phonesite.index') }}" class="btn btn-white" >Cancelar</a>
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
