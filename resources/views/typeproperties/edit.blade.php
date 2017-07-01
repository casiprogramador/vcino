@extends('layouts.admin')

@section('admin-content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Tipos de propiedad</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('admin.home') }}">Inicio</a>
                </li>
                <li>
                    Configuración
                </li>
                <li>
                    <a href="{{ route('config.typeproperty.index') }}">Tipos de propiedad</a>
                </li>
                <li class="active">
                    <strong>Editar tipo de propiedad</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">

                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        {!! Form::open(array('route' => array('config.typeproperty.update', $typeproperty->id),'method' => 'patch' ,'class' => 'form-horizontal')) !!}
                        <div class="tabs-container">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#tab-1">Editar tipo de propiedad</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="tab-1" class="tab-pane active">
                                    <div class="panel-body">

                                        <div class="form-group{{ $errors->has('tipo_propiedad') ? ' has-error' : '' }}">
                                            <label class="col-sm-3 control-label">Tipo</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control input-sm" name="tipo_propiedad" value="{{$typeproperty->tipo_propiedad}}">
                                                @if ($errors->has('tipo_propiedad'))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first('tipo_propiedad') }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Activo</label>
                                            <div class="col-sm-4">
                                                <input type="checkbox" class="i-checks" name="activa" value="1" {{ ($typeproperty->activa == 1) ? 'checked' : '' }}>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button class="btn btn-success" type="submit" style="margin-right: 10px;">Guardar</button>
                                    <a href="{{ route('config.typeproperty.index') }}" class="btn btn-white" >Cancelar</a>
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