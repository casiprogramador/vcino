@extends('layouts.admin')

@section('admin-content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Transacciones</h2>
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
                    <h5 style="padding-top: 2px;">Ver cuota por cobrar</h5>
                </div>

                <div class="ibox-content">

					 <form action="#" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Propiedad</label>
                            <div class="col-sm-3">
								{{ Form::select('propiedad',$properties, $accountsreceivable->property_id, ['class' => 'form-control input-sm','disabled'=>'disabled']) }}
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
                                {{ Form::select('gestion',
								array(
								'2016' => '2016',
								'2017' => '2017',
								'2018' => '2018'
								),$accountsreceivable->gestion,
								['class' => 'form-control input-sm','disabled'=>'disabled']) }}
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
								),$accountsreceivable->periodo,
								['class' => 'form-control input-sm','disabled'=>'disabled']) }}
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
								{{ Form::select('cuota',$quotas, $accountsreceivable->quota_id, ['class' => 'form-control input-sm','disabled'=>'disabled']) }}
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

										<input type="text" name="fecha_vencimiento" class="form-control input-sm date-picker" value="{{date('d/m/Y', strtotime($accountsreceivable->fecha_vencimiento)) }}" readonly>
										@if ($errors->has('fecha_vencimiento'))
										<span class="help-block">
											<strong>{{ $errors->first('fecha_vencimiento') }}</strong>
										</span>
										@endif

                                </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Importe por cobrar</label>
                            <div class="col-sm-2{{ $errors->has('importe_por_cobrar') ? ' has-error' : '' }}">
                                <input name="importe_por_cobrar" type="text" class="form-control input-sm" value="{{ $accountsreceivable->importe_por_cobrar }}" readonly>
								@if ($errors->has('importe_por_cobrar'))
								<span class="help-block">
									<strong>{{ $errors->first('importe_por_cobrar') }}</strong>
								</span>
								@endif
                            </div>
                            <label class="col-sm-3 control-label">Importe abonado</label>
                            <div class="col-sm-2{{ $errors->has('importe_abonado') ? ' has-error' : '' }}">
                                <input name="importe_abonado" type="text" value="0" class="form-control input-sm" value="{{ $accountsreceivable->importe_abonado }}" readonly>
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
								{{ Form::select('cancelada',
								array(
								'1' => 'SI',
								'0' => 'NO'
								),$accountsreceivable->cancelada,
								['class' => 'form-control input-sm','disabled'=>'disabled']) }}
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
                                 <a href="{{ route('transaction.accountsreceivable.index') }}" class="btn btn-success" >Volver</a>
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
    <script type="text/javascript" src="{{ URL::asset('js/summernote.min.js') }}"></script>
    <script>
        $('.date-picker').datetimepicker({
            format: 'DD/MM/YYYY'
        });
    </script>
@endsection

