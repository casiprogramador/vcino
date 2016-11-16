@extends('layouts.admin')

@section('admin-content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Cuentas</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('admin.home') }}">Inicio</a>
                </li>
                <li class="active">
                    <a href="{{ route('config.account.index') }}">Cuentas</a>
                </li>
                <li class="active">
                    <strong>Ver cuenta</strong>
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
                                <li class="active"><a data-toggle="tab" href="#tab-1">Detalle cuenta: {{ $account->nombre }}</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="tab-1" class="tab-pane active">
                                    <div class="panel-body">

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Cuenta</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control input-sm" name="nombre" value="{{ $account->nombre }}" readonly>
                                                @if ($errors->has('nombre'))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first('nombre') }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Tipo de cuenta</label>
                                            <div class="col-sm-4">
                                                {{ Form::select('tipo_cuenta',array('0' => 'Seleccione','Caja de Ahorro' => 'Caja de Ahorro', 'Cuenta Corriente' => 'Cuenta Corriente','Efectivo' => 'Efectivo'),  $account->tipo_cuenta , ['class' => 'form-control input-sm','disabled'=>'disabled','id'=>'tipo-cuenta']) }}
                                                @if ($errors->has('tipo_cuenta'))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first('tipo_cuenta') }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group" id="banco">
                                            <label class="col-sm-3 control-label">Banco</label>
                                            <div class="col-sm-4">
                                                {{ Form::select('banco',$banks, $account->bank_id, ['class' => 'form-control input-sm','disabled'=>'disabled']) }}
                                            </div>
                                        </div>

                                        <div class="form-group" id="nro-cuenta">
                                            <label class="col-sm-3 control-label">Número cuenta</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control input-sm" name="nro_cuenta" value="{{ $account->nro_cuenta }}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group" id="nombre-cuentahabiente">
                                            <label class="col-sm-3 control-label">Nombre cuentahabiente</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control input-sm" name="nombre_cuentahabiente" value="{{ $account->nombre_cuentahabiente }}" readonly>
                                            </div>
                                        </div>

                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Notas</label>
                                            <div class="col-sm-8">
                                                <textarea rows="4" class="form-control input-sm" name="nota" readonly>{{ $account->nota }}</textarea>
                                                @if ($errors->has('nota'))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first('nota') }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Activa</label>
                                            <div class="col-sm-4">

                                                <div>
                                                    <input type="checkbox" class="i-checks" name="activa" value="1" {{ ($account->activa == 1) ? 'checked' : '' }} disabled="disabled">
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <a href="{{ route('config.account.index') }}" class="btn btn-success" >Volver</a>
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
            if($('#tipo-cuenta').val() == "Efectivo" ){
                $('#nombre-cuentahabiente').hide();
                $('#nro-cuenta').hide();
                $('#banco').hide();
            }
        });
    </script>
@endsection