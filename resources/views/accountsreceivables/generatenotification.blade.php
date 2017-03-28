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
            <li class="active">
                <strong>Enviar aviso de cobranza</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <h5 style="padding-top: 2px;">Enviar aviso de cobranza</h5>
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
                        <div class="col-sm-2 m-b-xs">
                            <select class="input-sm form-control input-s-sm inline" name="gestion">
                                <option value="2017">2017</option>
								<option value="2016">2016</option>
                                <option value="2015">2015</option>
                                <option value="2014">2014</option>
                            </select>
                        </div>
                        <div class="col-sm-3 m-b-xs">
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
                            <button class="btn btn-success" type="submit">Generar lista de distribución</button>
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