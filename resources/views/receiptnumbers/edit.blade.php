@extends('layouts.admin')

@section('admin-content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Números de comprobantes</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('admin.home') }}">Inicio</a>
                </li>
                <li>
                    <a href="{{ route('config.receiptnumber.index') }}">Numero de comprobante</a>
                </li>
                <li class="active">
                    <strong>Editar Numero de comprobante</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">

                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        {!! Form::open(array('route' => array('config.receiptnumber.update', $receiptnumber->id),'method' => 'patch' ,'class' => 'form-horizontal', 'files' => true)) !!}
                        <div class="tabs-container">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#tab-1">Editar Numero comprobante</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="tab-1" class="tab-pane active">
                                    <div class="panel-body">

                                        <div class="form-group{{ $errors->has('gestion') ? ' has-error' : '' }}">
                                            <label class="col-sm-3 control-label">Gestión</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control input-sm" name="gestion" value="{{$receiptnumber->gestion}}">
                                                @if ($errors->has('gestion'))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first('gestion') }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('ingreso') ? ' has-error' : '' }}">
                                            <label class="col-sm-3 control-label">Número Ingreso</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control input-sm" name="ingreso" value="{{$receiptnumber->ingreso}}">
                                                @if ($errors->has('ingreso'))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first('ingreso') }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('egreso') ? ' has-error' : '' }}">
                                            <label class="col-sm-3 control-label">Número Egreso</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control input-sm" name="egreso" value="{{$receiptnumber->egreso}}">
                                                @if ($errors->has('egreso'))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first('egreso') }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('traspaso') ? ' has-error' : '' }}">
                                            <label class="col-sm-3 control-label">Número Traspaso</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control input-sm" name="traspaso" value="{{$receiptnumber->traspaso}}">
                                                @if ($errors->has('traspaso'))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first('traspaso') }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button class="btn btn-success" type="submit">Guardar</button>
                                    <a href="{{ route('config.receiptnumber.index') }}" class="btn btn-white" >Cancelar</a>
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