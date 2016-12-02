@extends('layouts.admin')

@section('admin-content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Transacciones</h2>
        <ol class="breadcrumb">
            <li>
                <a href="#/">Inicio</a>
            </li>
            <li>
                Transacciones
            </li>
            <li>
                <a href="#">Lista de cuotas por cobrar</a>
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
								{{ Form::select('propiedad',$properties, old('propiedad'), ['class' => 'form-control input-sm']) }}
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
                                <select class="form-control input-sm" name="gestion">
                                    <option value="2016">2016</option>
                                    <option value="2017">2017</option>
                                    <option value="2018">2018</option>
                                </select>
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
                                <select class="form-control input-sm" name="periodo">
                                    <option value="1">Enero</option>
                                    <option value="2">Febrero</option>
                                    <option value="3">Marzo</option>
                                    <option value="4">Abril</option>
                                    <option value="5">Mayo</option>
                                    <option value="6">Junio</option>
                                    <option value="7">Julio</option>
                                    <option value="8">Agosto</option>
                                    <option value="9">Septiembre</option>
                                    <option value="10">Octubre</option>
                                    <option value="11">Noviembre</option>
                                    <option value="12">Diciembre</option>
                                </select>
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
								{{ Form::select('cuota',$quotas, old('propiedad'), ['class' => 'form-control input-sm']) }}
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

										<input type="text" name="fecha_vencimiento" class="form-control input-sm date-picker">
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
                                <input name="importe_por_cobrar" type="text" class="form-control input-sm">
								@if ($errors->has('importe_por_cobrar'))
								<span class="help-block">
									<strong>{{ $errors->first('importe_por_cobrar') }}</strong>
								</span>
								@endif
                            </div>
                            <label class="col-sm-3 control-label">Importe abonado</label>
                            <div class="col-sm-2{{ $errors->has('importe_abonado') ? ' has-error' : '' }}">
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
                                    <option value="1">Si</option>
                                    <option value="0" selected="">No</option>
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
                                <button class="btn btn-danger" type="submit">
                                    <i class="fa fa-trash"></i>&nbsp;&nbsp;Eliminar...</button>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                 <button class="btn btn-success" type="submit">Guardar</button>
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
        $('.date-picker').datetimepicker({
            format: 'DD/MM/YYYY'
        });
    </script>
@endsection

