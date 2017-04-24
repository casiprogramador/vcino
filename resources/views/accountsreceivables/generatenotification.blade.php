@extends('layouts.admin')

@section('admin-content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Avisos de cobranza</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.home') }}">Inicio</a>
            </li>
            <li>
                Transacciones
            </li>
            <li>
                <a href="{{ route('transaction.accountsreceivable.send') }}">Avisos de cobranza</a>
            </li>
            <li class="active">
                <strong>Nuevo aviso de cobranza</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <h5 style="padding-top: 2px;">Nuevo aviso de cobranza</h5>
                </div>

                <div class="ibox-content">

                {!! Form::open(array('route' => 'transaction.accountsreceivable.storealertpayment', 'class' => 'form-horizontal')) !!}

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Propiedad</label>
                        <div class="col-sm-5">
							{{ Form::select('propiedad',['todas'=>'Todas']+$properties, old('propiedad'), ['class' => 'form-control input-sm']) }}
							@if ($errors->has('propiedad'))
							<span class="help-block">
								<strong>{{ $errors->first('propiedad') }}</strong>
							</span>
							@endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Asunto</label>
                        <div class="col-sm-5">
                            {{ Form::select('asunto',$subjects, old('asunto'), ['class' => 'form-control input-sm']) }}
							@if ($errors->has('asunto'))
							<span class="help-block">
								<strong>{{ $errors->first('asunto') }}</strong>
							</span>
							@endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Vencimiento a</label>
                        <div class="col-sm-3 m-b-xs">
                            {{ Form::select('periodo',
                            array(
                            '1' => 'Enero',
                            '2' => 'Febrero',
                            '3' => 'Marzo',
                            '4' => 'Abril',
                            '5' => 'Mayo',
                            '6' => 'Junio',
                            '7' => 'Julio',
                            '8' => 'Agosto',
                            '9' => 'Septiembre',
                            '10' => 'Octubre',
                            '11' => 'Noviembre',
                            '12' => 'Diciembre',
                            ), date("m"),
                            ['class' => 'form-control input-sm']) }}
                            @if ($errors->has('periodo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('periodo') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="col-sm-2 m-b-xs">
                            {{ Form::select('gestion',$gestiones, date("Y"), ['class' => 'form-control input-sm']) }}
                            @if ($errors->has('gestion'))
                            <span class="help-block">
                                <strong>{{ $errors->first('gestion') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nota</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control input-sm" name="nota">
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-success" type="submit" style="margin-right: 10px;">Crear avisos</button>
							<a href="{{ route('transaction.accountsreceivable.send') }}" class="btn btn-white" >Cancelar</a>
                        </div>
                    </div>
				{!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>


@endsection