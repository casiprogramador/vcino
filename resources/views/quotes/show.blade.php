@extends('layouts.admin')

@section('admin-content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Cuotas</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('admin.home') }}">Inicio</a>
                </li>
                <li>
                    Configuración
                </li>
                <li>
                    <a href="{{ route('config.quota.index') }}">Cuotas</a>
                </li>
                <li class="active">
                    <strong>Ver cuota</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">

                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <form action="#" class="form-horizontal">

                            <div class="tabs-container">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#tab-1">Detalle cuota: {{ $quota->cuota }}</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="tab-1" class="tab-pane active">
                                        <div class="panel-body">

                                            <div class="form-group{{ $errors->has('cuota') ? ' has-error' : '' }}">
                                                <label class="col-sm-3 control-label">Cuota</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control input-sm" name="cuota" value="{{ $quota->cuota }}" readonly>
                                                    @if ($errors->has('cuota'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('cuota') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                                                <label class="col-sm-3 control-label">Categoría</label>
                                                <div class="col-sm-5">
                                                    {{ Form::select('category',$categories, $quota->category_id, ['class' => 'form-control input-sm','disabled'=>'disabled']) }}
                                                    @if ($errors->has('category'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('category') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('type_property') ? ' has-error' : '' }}">
                                                <label class="col-sm-3 control-label">Tipo propiedad</label>
                                                <div class="col-sm-5">
                                                    {{ Form::select('type_property',$typeProperties,$quota->type_property_id, ['class' => 'form-control input-sm','disabled'=>'disabled']) }}
                                                    @if ($errors->has('type_property'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('type_property') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('frecuencia_pago') ? ' has-error' : '' }}">
                                                <label class="col-sm-3 control-label">Frecuencia de pago</label>
                                                <div class="col-sm-5">
                                                    {{ Form::select('frecuencia_pago',array('0' => 'Seleccione','Mensual' => 'Mensual', 'Bimestral' => 'Bimestral', 'Semestral' => 'Semestral', 'Anual' => 'Anual', 'Variable' => 'Variable'),$quota->frecuencia_pago,['class' => 'form-control input-sm','disabled'=>'disabled']) }}
                                                    @if ($errors->has('frecuencia_pago'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('frecuencia_pago') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="hr-line-dashed"></div>

                                            <div class="form-group{{ $errors->has('importe') ? ' has-error' : '' }}">
                                                <label class="col-sm-3 control-label">Importe</label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control input-sm" name="importe" value="{{$quota->importe}}" readonly>
                                                    @if ($errors->has('importe'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('importe') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('tipo_importe') ? ' has-error' : '' }}">
                                                <label class="col-sm-3 control-label">Tipo de importe</label>
                                                <div class="col-sm-3">
                                                    {{ Form::select('tipo_importe',array('0' => 'Seleccione','Fijo' => 'Fijo', 'Variable' => 'Variable'),$quota->tipo_importe,['class' => 'form-control input-sm','disabled'=>'disabled']) }}
                                                    @if ($errors->has('tipo_importe'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('tipo_importe') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="hr-line-dashed"></div>

                                            <div class="form-group{{ $errors->has('notas') ? ' has-error' : '' }}">
                                                <label class="col-sm-3 control-label">Notas</label>
                                                <div class="col-sm-8">
                                                    <textarea rows="3" class="form-control input-sm" name="notas" readonly>{{$quota->notas}}</textarea>
                                                    @if ($errors->has('notas'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('notas') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="hr-line-dashed"></div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Activa</label>
                                                <div class="col-sm-4">
                                                    <input type="checkbox" class="i-checks" name="activa" value="1" {{ ($quota->activa == 1) ? 'checked' : '' }} disabled="disabled">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <a href="{{ route('config.quota.index') }}" class="btn btn-success" >Volver</a>
                                    </div>
                                </div>
                            </div>
                        </form>
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