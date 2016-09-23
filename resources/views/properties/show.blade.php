@extends('layouts.admin')

@section('admin-content')
   <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Propiedades</h2>
        <ol class="breadcrumb">
			<li>
				<a href="{{ route('admin.home') }}">Inicio</a>
			</li>
			<li>
				<a href="{{ route('properties.property.index') }}">Lista de propiedades</a>
			</li>
			<li class="active">
				<strong>Ver propiedad</strong>
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
                            <li class="active"><a data-toggle="tab" href="#tab-1">Información general</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-2">Servicios</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-3">Características</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                                <div class="panel-body">

                                    <div class="form-group{{ $errors->has('nro') ? ' has-error' : '' }}">
										<label class="col-sm-3 control-label">Número</label>
                                        <div class="col-sm-3">
											<input type="text" class="form-control input-sm" name="nro" value="{{ $property->nro }}" readonly>
											@if ($errors->has('nro'))
												<span class="help-block">
													<strong>{{ $errors->first('nro') }}</strong>
												</span>
											@endif
										</div>
                                    </div>
                                    <div class="form-group{{ $errors->has('type_property') ? ' has-error' : '' }}">
										<label class="col-sm-3 control-label">Tipo</label>
                                        <div class="col-sm-4">
                                             {{ Form::select('type_property',$typeproperties, $property->type_property_id, ['class' => 'form-control input-sm','disabled'=>'disabled']) }}
											 @if ($errors->has('type_property'))
												<span class="help-block">
													<strong>{{ $errors->first('type_property') }}</strong>
												</span>
											@endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('situacion_habitacionals') ? ' has-error' : '' }}">
										<label class="col-sm-3 control-label">Situación habitacional</label>
                                        <div class="col-sm-4">
                                             {{ Form::select('situacion_habitacionals',$sithabs,$property->situacion_habitacionals_id, ['class' => 'form-control input-sm','disabled'=>'disabled']) }}
											 @if ($errors->has('situacion_habitacionals'))
												<span class="help-block">
													<strong>{{ $errors->first('situacion_habitacionals') }}</strong>
												</span>
											@endif
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
 
                                    <div class="form-group{{ $errors->has('nro_intecomunicador') ? ' has-error' : '' }}">
										<label class="col-sm-3 control-label">Nro. Intercomunicador</label>
                                        <div class="col-sm-3">
											<input type="text" class="form-control input-sm" name="nro_intecomunicador" value="{{ $property->nro_intecomunicador }}" readonly>
											@if ($errors->has('nro_intecomunicador'))
												<span class="help-block">
													<strong>{{ $errors->first('nro_intecomunicador') }}</strong>
												</span>
											@endif
										</div>
                                    </div>

                                    <div class="hr-line-dashed"></div>

                                    <div class="form-group{{ $errors->has('etiquetas') ? ' has-error' : '' }}">
										<label class="col-sm-3 control-label">Etiquetas</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control input-sm" name="etiquetas" value="{{ $property->etiquetas }}" readonly>
											@if ($errors->has('etiquetas'))
												<span class="help-block">
													<strong>{{ $errors->first('etiquetas') }}</strong>
												</span>
											@endif
                                            <span class="help-block m-b-none">Permite agrupar o clasificar las propiedades por otros criterios.</span>
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('campo_1') ? ' has-error' : '' }}">
										<label class="col-sm-3 control-label">Campo 1</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control input-sm" name="campo_1" value="{{ $property->campo_1 }}" readonly>
											@if ($errors->has('campo_1'))
												<span class="help-block">
													<strong>{{ $errors->first('campo_1') }}</strong>
												</span>
											@endif
                                            <span class="help-block m-b-none">Campo personalizado para almacenar valores o referencias adicionales.</span>
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('campo_2') ? ' has-error' : '' }}">
										<label class="col-sm-3 control-label">Campo 2</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control input-sm" name="campo_2" value="{{ $property->campo_2 }}" readonly>
											@if ($errors->has('campo_2'))
												<span class="help-block">
													<strong>{{ $errors->first('campo_2') }}</strong>
												</span>
											@endif
                                            <span class="help-block m-b-none">Campo personalizado para almacenar valores o referencias adicionales.</span>
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>

                                    <div class="form-group{{ $errors->has('notas') ? ' has-error' : '' }}">
										<label class="col-sm-3 control-label">Notas</label>
                                        <div class="col-sm-8">
                                            <textarea rows="6" class="form-control input-sm" name="notas" readonly>{{ $property->notas }}</textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div id="tab-2" class="tab-pane">
                                <div class="panel-body">
                                    <div class="form-group{{ $errors->has('codigo_electricidad') ? ' has-error' : '' }}">
										<label class="col-sm-3 control-label">Código energía eléctrica</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control input-sm" name="codigo_electricidad" value="{{ $property->codigo_electricidad }}" readonly>
											@if ($errors->has('codigo_electricidad'))
												<span class="help-block">
													<strong>{{ $errors->first('codigo_electricidad') }}</strong>
												</span>
											@endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('codigo_agua') ? ' has-error' : '' }}">
										<label class="col-sm-3 control-label">Código agua potable</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control input-sm" name="codigo_agua" value="{{ $property->codigo_agua }}" readonly>
											@if ($errors->has('codigo_agua'))
												<span class="help-block">
													<strong>{{ $errors->first('codigo_agua') }}</strong>
												</span>
											@endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('codigo_gas') ? ' has-error' : '' }}">
										<label class="col-sm-3 control-label">Código gas domiciliario</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control input-sm" name="codigo_gas" value="{{ $property->codigo_gas }}" readonly>
											@if ($errors->has('codigo_gas'))
												<span class="help-block">
													<strong>{{ $errors->first('codigo_gas') }}</strong>
												</span>
											@endif
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group{{ $errors->has('tvservices') ? ' has-error' : '' }}">
										<label class="col-sm-3 control-label">Servicio TV Cable</label>
                                        <div class="col-sm-4">
                                            {{ Form::select('tvservices',$tvs, $property->tvservices_id, ['class' => 'form-control input-sm','disabled'=>'disabled']) }}
											@if ($errors->has('tvservices'))
												<span class="help-block">
													<strong>{{ $errors->first('tvservices') }}</strong>
												</span>
											@endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('internetservices') ? ' has-error' : '' }}">
										<label class="col-sm-3 control-label">Servicio Internet</label>
                                        <div class="col-sm-4">
                                            {{ Form::select('internetservices',$internets,$property->internetservices_id, ['class' => 'form-control input-sm','disabled'=>'disabled']) }}
											@if ($errors->has('internetservices'))
												<span class="help-block">
													<strong>{{ $errors->first('internetservices') }}</strong>
												</span>
											@endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('phone_services') ? ' has-error' : '' }}">
										<label class="col-sm-3 control-label">Servicio teléfono</label>
                                        <div class="col-sm-4">
                                            {{ Form::select('phone_services',$phones,$property->phone_services_id, ['class' => 'form-control input-sm','disabled'=>'disabled']) }}
											@if ($errors->has('phone_services'))
												<span class="help-block">
													<strong>{{ $errors->first('phone_services') }}</strong>
												</span>
											@endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('waterservices') ? ' has-error' : '' }}">
										<label class="col-sm-3 control-label">Servicio agua potable</label>
                                        <div class="col-sm-4">
                                            {{ Form::select('waterservices',$waters,$property->waterservices_id, ['class' => 'form-control input-sm','disabled'=>'disabled']) }}
											@if ($errors->has('waterservices'))
												<span class="help-block">
													<strong>{{ $errors->first('waterservices') }}</strong>
												</span>
											@endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('electricservices') ? ' has-error' : '' }}">
										<label class="col-sm-3 control-label">Servicio energía eléctrica</label>
                                        <div class="col-sm-4">
                                            {{ Form::select('electricservices',$electrics,$property->electricservices_id, ['class' => 'form-control input-sm','disabled'=>'disabled']) }}
											@if ($errors->has('electricservices'))
												<span class="help-block">
													<strong>{{ $errors->first('electricservices') }}</strong>
												</span>
											@endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-3" class="tab-pane">
                                <div class="panel-body">
                                    <div class="form-group{{ $errors->has('superficie') ? ' has-error' : '' }}">
										<label class="col-sm-3 control-label">Superficie</label>
                                        <div class="col-sm-3">
											<input type="text" class="form-control input-sm" name="superficie" value="{{ $property->superficie }}" readonly>
											@if ($errors->has('superficie'))
												<span class="help-block">
													<strong>{{ $errors->first('superficie') }}</strong>
												</span>
											@endif
										</div>
                                    </div>
                                    <div class="form-group{{ $errors->has('scc') ? ' has-error' : '' }}">
										<label class="col-sm-3 control-label">S.C.C.</label>
                                        <div class="col-sm-3">
											<input type="text" class="form-control input-sm" name="scc" value="{{ $property->scc }}" readonly>
											@if ($errors->has('scc'))
												<span class="help-block">
													<strong>{{ $errors->first('scc') }}</strong>
												</span>
											@endif
										</div>
                                    </div>
                                    <div class="form-group{{ $errors->has('fit') ? ' has-error' : '' }}">
										<label class="col-sm-3 control-label">F.I.T.</label>
                                        <div class="col-sm-3">
											<input type="text" class="form-control input-sm" name="fit" value="{{ $property->fit }}" readonly>
											@if ($errors->has('fit'))
												<span class="help-block">
													<strong>{{ $errors->first('fit') }}</strong>
												</span>
											@endif
										</div>
                                    </div>
                                    <div class="form-group{{ $errors->has('nro_dormitorios') ? ' has-error' : '' }}">
										<label class="col-sm-3 control-label">Nro. Dormitorios</label>
                                        <div class="col-sm-3">
											<input type="text" class="form-control input-sm" name="nro_dormitorios" value="{{ $property->nro_dormitorios }}" readonly> 
											@if ($errors->has('nro_dormitorios'))
												<span class="help-block">
													<strong>{{ $errors->first('nro_dormitorios') }}</strong>
												</span>
											@endif
										</div>
                                    </div>
                                    <div class="form-group{{ $errors->has('nro_banos') ? ' has-error' : '' }}">
										<label class="col-sm-3 control-label">Nro. Baños</label>
                                        <div class="col-sm-3">
											<input type="text" class="form-control input-sm" name="nro_banos" value="{{ $property->nro_banos }}" readonly>
											@if ($errors->has('nro_banos'))
												<span class="help-block">
													<strong>{{ $errors->first('nro_banos') }}</strong>
												</span>
											@endif
										</div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group{{ $errors->has('plano') ? ' has-error' : '' }}">
										<label class="col-sm-3 control-label">Plano de distribución</label>
                                        <div class="col-sm-8">
											<input type="text" class="form-control input-sm" name="plano" value="{{ $property->plano }}" readonly>
											@if ($errors->has('plano'))
												<span class="help-block">
													<strong>{{ $errors->first('plano') }}</strong>
												</span>
											@endif
										</div>
                                    </div>
                                    <div class="form-group{{ $errors->has('caracteristicas') ? ' has-error' : '' }}">
										<label class="col-sm-3 control-label">Características</label>
                                        <div class="col-sm-8">
                                            <textarea rows="4" disable="" class="form-control input-sm" name="caracteristicas" readonly>{{ $property->caracteristicas }}</textarea>
											@if ($errors->has('caracteristicas'))
												<span class="help-block">
													<strong>{{ $errors->first('caracteristicas') }}</strong>
												</span>
											@endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                    </div>
				</form>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- iCheck -->
    <script src="js/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>


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
