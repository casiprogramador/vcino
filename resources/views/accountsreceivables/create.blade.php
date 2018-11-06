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
                <strong>Nueva cuota por cobrar</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <h5 style="padding-top: 2px;">Nueva cuota por cobrar</h5>
                </div>

                <div class="ibox-content">
					{!! Form::open(array('route' => 'transaction.accountsreceivable.store', 'class' => 'form-horizontal')) !!}
					<div class="form-group">
						<label class="col-sm-3 control-label">Propiedad</label>
						<div class="col-sm-3">
							<select id="propiedad" class="form-control input-sm" name="propiedad">
							@foreach($properties as $propertie)

							<option fit="{{$propertie->fit}}" value="{{$propertie->id}}">{{$propertie->nro}}</option>
							@endforeach
							</select>
							@if ($errors->has('propiedad'))
							<span class="help-block">
								<strong>{{ $errors->first('propiedad') }}</strong>
							</span>
							@endif
						</div>
					</div>

					<div class="form-group{{ $errors->has('gestion') ? ' has-error' : '' }}">
						<label class="col-sm-3 control-label">Gestión</label>
						<div class="col-sm-2">
							{{ Form::select('gestion',$gestiones, date("Y"), ['class' => 'form-control input-sm']) }}
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
							),date("m"),
							['class' => 'form-control input-sm']) }}
							@if ($errors->has('periodo'))
							<span class="help-block">
								<strong>{{ $errors->first('periodo') }}</strong>
							</span>
							@endif
						</div>
					</div>

					<div class="hr-line-dashed"></div>

					<div class="form-group{{ $errors->has('cuota') ? ' has-error' : '' }}">
						<label class="col-sm-3 control-label">Cuota</label>
						<div class="col-sm-5">
							<select id="cuota" class="form-control input-sm" name="cuota">
								<option importe="0" value="0">Seleccione una cuota</option> 
								@foreach($quotas as $quota)

								<option importe="{{$quota->importe}}" forma-cobro="{{$quota->forma_cobro}}" value="{{$quota->id}}">{{$quota->cuota}}</option>
								@endforeach
							</select>
							@if ($errors->has('cuota'))
							<span class="help-block">
								<strong>{{ $errors->first('cuota') }}</strong>
							</span>
							@endif
						</div>
					</div>

					<div class="form-group{{ $errors->has('fecha_vencimiento') ? ' has-error' : '' }}" id="fecha">
						<label class="col-sm-3 control-label">Fecha de vencimiento</label>
						<div class="col-sm-3 input-group date" style="padding-left:15px;">
							<span class="input-group-addon"><i class="fa fa-calendar"></i></span>

							<?php
							//	$fecha_vencimiento = date('d/m/Y', strtotime(date("Y").'-'.date("m").'-'.$dias_mora));
							?>

							<input type="text" name="fecha_vencimiento" class="form-control input-sm date-picker" 
								value="{{ date('d/m/Y', strtotime(date("Y").'-'.date("m").'-'.$dias_mora)) }}">

						</div>
						@if ($errors->has('fecha_vencimiento'))
						<div class="col-sm-3 col-sm-offset-3">
							<span class="help-block">
								<strong>{{ $errors->first('fecha_vencimiento') }}</strong>
							</span>
						</div>
						@endif
					</div>

					<div class="hr-line-dashed"></div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Importe por cobrar</label>
						<div class="col-sm-2{{ $errors->has('importe_por_cobrar') ? ' has-error' : '' }}">
                            <div class="input-group">
                                <span class="input-group-addon" style="background-color: #EEE;">Bs.</span>
								<input id="importe-cobrar" name="importe_por_cobrar" type="text" class="form-control input-sm">
							</div>
							@if ($errors->has('importe_por_cobrar'))
							<span class="help-block">
								<strong>{{ $errors->first('importe_por_cobrar') }}</strong>
							</span>
							@endif
						</div>
						<label class="col-sm-3 control-label" style="display: none;">Importe abonado</label>
						<div class="col-sm-2{{ $errors->has('importe_abonado') ? ' has-error' : '' }}" style="display: none;">
							<input name="importe_abonado" type="text" value="0" class="form-control input-sm">
							@if ($errors->has('importe_abonado'))
							<span class="help-block">
								<strong>{{ $errors->first('importe_abonado') }}</strong>
							</span>
							@endif
						</div>
					</div>

					<div class="hr-line-dashed"></div>

					<div class="form-group{{ $errors->has('cancelada') ? ' has-error' : '' }}">
						<label class="col-sm-3 control-label">Cancelada</label>
						<div class="col-sm-1">
							<select class="form-control input-sm" name="cancelada">
								<option value="1">SI</option>
								<option value="0" selected="">NO</option>
							</select>
							@if ($errors->has('cancelada'))
							<span class="help-block">
								<strong>{{ $errors->first('cancelada') }}</strong>
							</span>
							@endif
						</div>
					</div>

					<div class="hr-line-dashed"></div>

					<div class="form-group">
						<div class="col-sm-12">
							<button class="btn btn-success" type="submit" style="margin-right: 10px;">Crear cuota</button>
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
@section('javascript')
<script type="text/javascript" src="{{ URL::asset('js/summernote.min.js') }}"></script>
<script>
	$(document).ready(function () {
		$('#cuota').change(function () {
			forma_cobro = $('#cuota option:selected').attr('forma-cobro');
			fit = $('#propiedad option:selected').attr('fit');
			importe = $('#cuota option:selected').attr('importe');
			console.log(fit);
			if(forma_cobro == 'FIT'){
				$('#importe-cobrar').val(importe*fit);
			}else{
				$('#importe-cobrar').val(importe);	
			}
		});
		$('#propiedad').change(function () {
			forma_cobro = $('#cuota option:selected').attr('forma-cobro');
			fit = $('#propiedad option:selected').attr('fit');
			importe = $('#cuota option:selected').attr('importe');
			console.log(fit);
			if(forma_cobro == 'FIT'){
				$('#importe-cobrar').val(importe*fit);
			}else{
				$('#importe-cobrar').val(importe);	
			}
		});
	});
	$('.date-picker').datetimepicker({
		format: 'DD/MM/YYYY'
	});

</script>
@endsection

