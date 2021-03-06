@extends('layouts.admin')

@section('admin-content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Histórico de transacciones</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.home') }}">Inicio</a>
            </li>
            <li>
                Reportes
            </li>
            <li class="active">
                <strong>Histórico de transacciones</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Histórico de transacciones</h5>
                </div>
				{!! Form::open(array('route' => 'report.historicotransacciones.show')) !!}
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-8">
                            <div role="form" class="form-horizontal">
                                <div class="form-group" style="padding-top: 10px;">
                                    <label class="col-sm-4 control-label">Tipo</label>
                                    <div class="col-sm-5">
                                        <select class="form-control input-sm" name="tipo" id="tipos">
                                            <option value="cuentas">Cuentas</option>
                                            <option value="categorias">Categorías</option>
                                            <option value="proveedores">Proveedores</option>
                                            <option value="pagos">Pagos por propiedad</option>
                                            <option value="ingresos">Ingresos</option>
                                            <option value="egresos">Egresos</option>
                                            <option value="traspasos">Traspasos</option>
                                            <option value="todas">Todas las transacciones</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Periodo</label>
                                    <div class="col-sm-5">
                                        <select class="form-control input-sm" id="periodo" name="periodo">
                                            <optgroup>
                                                <option value="actual">Mes actual</option>
                                                <option value="anterior">Mes anterior</option>
                                                <option value="gestionactual">Gestión actual</option>
                                                <option value="gestionanterior">Gestión anterior</option>
                                            </optgroup>
                                            <optgroup>
                                                <option value="mesgestion">Por mes y gestión</option>
                                                <option value="porgestion">Por gestión</option>
												<option value="rango">Rango de fechas</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group"  id="meses">
                                    <label class="col-sm-4 control-label">Mes</label>
                                    <div class="col-sm-5">
                                        <select class="form-control input-sm" name="mes">
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
								<div id="fecha-rango">
																	<div class="form-group{{ $errors->has('fecha_ini') ? ' has-error' : '' }}" id="fecha-ini">
									<label class="col-sm-4 control-label">Fecha Inicio</label>
									<div class="col-sm-5">
										<div class="input-group date">
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
											<input type="text" class="form-control input-sm date-picker" name="fecha_ini" value="{{ date('d/m/Y') }}">
											@if ($errors->has('fecha_ini'))
											<span class="help-block">
												<strong>{{ $errors->first('fecha_ini') }}</strong>
											</span>
										@endif
										</div>
									</div>
								</div>
								<div class="form-group{{ $errors->has('fecha_fin') ? ' has-error' : '' }}" id="fecha-fin">
									<label class="col-sm-4 control-label">Fecha Final</label>
									<div class="col-sm-5">
										<div class="input-group date">
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
											<input type="text" class="form-control input-sm date-picker" name="fecha_fin" value="{{ date('d/m/Y') }}">
											@if ($errors->has('fecha_fin'))
											<span class="help-block">
												<strong>{{ $errors->first('fecha_fin') }}</strong>
											</span>
										@endif
										</div>
									</div>
								</div>
								</div>


                                <div class="form-group" id="gestiones">
                                    <label class="col-sm-4 control-label">Gestión</label>
                                    <div class="col-sm-5">
										{{ Form::select('anio',$gestiones, date("Y"), ['class' => 'form-control input-sm']) }}
                                    </div>
                                </div>

                                <div class="form-group" id="cuentas">
                                    <label class="col-sm-4 control-label">Cuentas</label>
                                    <div class="col-sm-5">
                                        {{ Form::select('cuenta',$cuentas, old('cuenta'), ['class' => 'form-control input-sm']) }}
                                    </div>
                                </div>

                                <div class="form-group" id="categorias">
                                    <label class="col-sm-4 control-label">Categorías</label>
                                    <div class="col-sm-5">
                                        {{ Form::select('categoria',$categorias, old('categoria'), ['class' => 'form-control input-sm']) }}
                                    </div>
                                </div>

                                <div class="form-group" id="proveedores">
                                    <label class="col-sm-4 control-label">Proveedor</label>
                                    <div class="col-sm-5">
										{{ Form::select('proveedor',$proveedores, old('proveedor'), ['class' => 'form-control input-sm']) }}
                                        
                                    </div>
                                </div>

                                <div class="form-group" id="propiedades">
                                    <label class="col-sm-4 control-label">Propiedad</label>
                                    <div class="col-sm-5">
                                        {{ Form::select('propiedad',$propiedades, old('propiedad'), ['class' => 'form-control input-sm']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4"><h4 class="text-muted"> </h4>
                            <p class="text-muted"> </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="hr-line-dashed"></div>

                            <div class="form-group text-right">
                                <button class="btn btn-success" type="submit">Siguiente</button>
                            </div>
                        </div>
                    </div>

                </div>
				{!! Form::close() !!}
            </div>
        </div>
    </div>

</div>





@endsection
@section('javascript')
<script type="text/javascript" src="{{ URL::asset('js/moment.es.js') }}"></script>
    <script>
        $(document).ready(function () {
            //Oculta campos dependiendo la opcion
            $('#meses').hide();
            $('#gestiones').hide();
			$('#fecha-rango').hide();
			//cuentas categorias proveedores propiedades
            $('#periodo').change(function(){

                    if ( $(this).val() == "mesgestion" ) {
                        $('#meses').show();
						$('#gestiones').show();
						$('#fecha-rango').hide();
                    }else if($(this).val() == "porgestion"){
                        $('#meses').hide();
						$('#gestiones').show();
						$('#fecha-rango').hide();
					}else if($(this).val() == "rango"){
						$('#fecha-rango').show();
						$('#meses').hide();
						$('#gestiones').hide();
                    }else{
						$('#meses').hide();
						$('#gestiones').hide();
						$('#fecha-rango').hide();
					}
            });
			//Ocutar select depende del tipo
			//$('#cuentas').hide();
			$('#categorias').hide();
			$('#proveedores').hide();
			$('#propiedades').hide();
			$('#tipos').change(function(){

                    if ( $(this).val() == "cuentas" ) {
                        $('#cuentas').show();
						$('#categorias').hide();
						$('#proveedores').hide();
						$('#propiedades').hide();
                    }else if($(this).val() == "categorias"){
                        $('#cuentas').hide();
						$('#categorias').show();
						$('#proveedores').hide();
						$('#propiedades').hide();
                    }else if($(this).val() == "proveedores"){
                        $('#cuentas').hide();
						$('#categorias').hide();
						$('#proveedores').show();
						$('#propiedades').hide();
                    }else if($(this).val() == "pagos"){
                        $('#cuentas').hide();
						$('#categorias').hide();
						$('#proveedores').hide();
						$('#propiedades').show();
                    }else if($(this).val() == "ingresos"){
                        $('#cuentas').hide();
						$('#categorias').hide();
						$('#proveedores').hide();
						$('#propiedades').hide();
                    }else if($(this).val() == "egresos"){
                        $('#cuentas').hide();
						$('#categorias').hide();
						$('#proveedores').hide();
						$('#propiedades').hide();
                    }else if($(this).val() == "traspasos"){
                        $('#cuentas').hide();
						$('#categorias').hide();
						$('#proveedores').hide();
						$('#propiedades').hide();
                    }else if($(this).val() == "todas"){
                        $('#cuentas').hide();
						$('#categorias').hide();
						$('#proveedores').hide();
						$('#propiedades').hide();
                    }else{
						$('#cuentas').show();
						$('#categorias').hide();
						$('#proveedores').hide();
						$('#propiedades').hide();
					}
            });
			
			$('.date-picker').datetimepicker({
				locale:'es',
				format: 'DD/MM/YYYY',
					widgetPositioning: {
					horizontal: 'left',
						vertical: 'bottom'
					}
			});
        });
    </script>
@endsection


