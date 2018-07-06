@extends('layouts.admin')

@section('admin-content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Cuotas por cobrar</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.home') }}">Inicio</a>
            </li>
            <li>
                Transacciones
            </li>
            <li>
                <a href="{{ route('transaction.accountsreceivable.index') }}">Cuotas por cobrar</a>
            </li>
            <li class="active">
                <strong>Nuevas cuotas por cobrar</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <h5 style="padding-top: 2px;">Nuevas cuotas: Todas las propiedades</h5>
                </div>

                 <div class="ibox-content">
					{!! Form::open(array('route' => 'transaction.accountsreceivable.storegenerate', 'class' => 'form-horizontal')) !!}

					<div class="form-group">
						<label class="col-sm-3 control-label">Propiedad</label>
						<div class="col-sm-3">
                            <select class="form-control input-sm" name="todaslaspropiedades" disabled="">
                                <option>Todas</option>
                            </select>							
						</div>
					</div>

					<div class="form-group{{ $errors->has('gestion') ? ' has-error' : '' }}">
						<label class="col-sm-3 control-label">Gestión</label>
						<div class="col-sm-2">
							{{ Form::select('gestion',$gestiones,  date("Y"), ['class' => 'form-control input-sm']) }}
							@if ($errors->has('gestion'))
							<span class="help-block">
								<strong>{{ $errors->first('gestion') }}</strong>
							</span>
							@endif
						</div>
					</div>

					<div class="form-group{{ $errors->has('periodo') ? ' has-error' : '' }}">
						<label class="col-sm-3 control-label">Periodo</label>
						<div class="col-sm-2">
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
							),$mes_actual,
							['class' => 'form-control input-sm']) }}
							@if ($errors->has('periodo'))
							<span class="help-block">
								<strong>{{ $errors->first('periodo') }}</strong>
							</span>
							@endif
						</div>
						<label class="col-sm-6 control-label" style="text-align: left;"><span class="text-danger">Mes sugerido: {{ nombremes($mes_actual) }}</span> ({{ $mes_cobro }})</label>
					</div>

					<div class="hr-line-dashed"></div>

					<div class="form-group">
						<div class="col-sm-12">
							<button class="btn btn-success" type="submit" style="margin-right: 10px;">Crear cuotas</button>
							<a href="{{ route('transaction.accountsreceivable.index') }}" class="btn btn-white" >Cancelar</a>
						</div>
					</div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

