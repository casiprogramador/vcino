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
                <a href="#">Lista de gastos</a>
            </li>
            <li class="active">
                <strong>Nuevo gasto</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
				<div class="ibox-title">
                    <h5 style="padding-top: 2px;">Nuevo gasto</h5>
                </div>
                <div class="ibox-content">
                    <h2>
                        Registro de gastos
                    </h2>
					{!! Form::open(array('route' => 'transaction.expense.store', 'class' => 'wizard-big form-horizontal', 'id' => 'form', 'files' => true)) !!}
					<h1>Categoría y concepto</h1>
					<fieldset>
						<div class="row">
							<div class="col-lg-6 col-lg-offset-3">
								<div class="form-group">
									<label>Proveedor</label>
									{{ Form::select('proveedor',['0'=>'Selecciona un proveedor']+$suppliers, old('proveedor'), ['class' => 'form-control input-sm','id'=>'proveedor-select']) }}
								</div>
								<div class="form-group">
									<label>Categoría</label>
									{{ Form::select('categoria',['0'=>'Selecciona una categoria']+$categories, old('categoria'), ['class' => 'form-control input-sm','id'=>'cotegoria-select']) }}
								</div>
								<div class="form-group">
									<label>Concepto *</label>
									<div class="col-sm-12 input-group">
                                        <input type="text" class="form-control input-sm" name="concepto" id="concepto-input">
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="text-center">
									<div style="margin-top: 0px">
										<i class="fa fa-sign-in" style="font-size: 160px;color: #e5e5e5 "></i>
									</div>
								</div>
							</div>
						</div>
					</fieldset>
					<h1>Transacciones Pasadas</h1>
					<fieldset>
						<div class="row">
							<div class="col-lg-10 col-lg-offset-1">
								<h5>Lista de últimos gastos categoría: Mantenimiento ascensores</h5>
								<div class="form-group">
                                    <div class="table-responsive">
                                        <table class="table table-striped" style="font-size: 12px;">
                                            <thead>
												<tr>
													<th>Fecha</th>
													<th>Proveedor</th>
													<th>Concepto</th>
													<th>Forma de pago</th>
													<th class="text-right">Importe</th>
												</tr>
                                            </thead>
                                            <tbody>
												<tr>
													<td>10/09/2016</td>
													<td>OTIS</td>
													<td>Pago mantenimiento agosto 2016</td>
													<td>Cheque Nro. 142</td>
													<td class="text-right">1.600,00</td>
												</tr>
												<tr>
													<td>11/08/2016</td>
													<td>OTIS</td>
													<td>Pago mantenimiento julio 2016</td>
													<td>Cheque Nro. 98</td>
													<td class="text-right">1.600,00</td>
												</tr>
												<tr>
													<td>08/07/2016</td>
													<td>OTIS</td>
													<td>Pago mantenimiento junio 2016</td>
													<td>Cheque Nro. 56</td>
													<td class="text-right">1.500,00</td>
												</tr>
                                            </tbody>
                                        </table>
                                    </div>
								</div>
							</div>
						</div>
					</fieldset>
					<h1>Importe y forma de pago</h1>
					<fieldset>
						<div class="row">
							<div class="col-lg-8 col-lg-offset-2">
								<div class="form-group">
									<label class="col-sm-4 control-label">Fecha</label>
									<div class="col-sm-4 input-group date">
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										<input type="text" name="fecha" id="fecha" class="form-control input-sm date-picker" value="{{ date('d/m/Y') }}" required>
									</div>
								</div>
								<div class="form-group">
									 <label class="col-sm-4 control-label">Importe</label>
									<div class="col-sm-4 input-group">
                                        <input type="text" class="form-control input-sm" name="importe" id="importe-input">
									</div>
								</div>
								<div class="form-group">
									 <label class="col-sm-4 control-label">Cuenta</label>
									<div class="col-sm-8 input-group">
										{{ Form::select('cuenta',['0'=>'Selecciona una cuenta']+$accounts, old('cuenta'), ['class' => 'form-control input-sm','id'=>'select-cuenta']) }}
									</div>
								</div>
								<div class="form-group">
									 <label class="col-sm-4 control-label">Forma de pago</label>
									<div class="col-sm-8 input-group">

											{{ Form::select('forma_pago', array('efectivo' => 'Efectivo','cheque' => 'Cheque', 'deposito' => 'Depósito','transferencia bancaria' => 'Transferencia bancaria','tarjeta debito/credito' => 'Tarjeta Débito/Crédito'), old('forma_pago') , ['class' => 'form-control input-sm','id'=>'forma-pago']) }}
                                    </div>
								</div>

								<div class="form-group" id="cont-forma-pago">
									 <label class="col-sm-4 control-label" id="label-transaccion">Nro Transaccion</label>
									<div class="col-sm-8 input-group">
										<input type="text" class="form-control input-sm" name="nro_forma_pago" id="nro-pago-input">
									</div>
								</div>
							</div>
						</div>

					</fieldset>
					

					<h1>Grabar transacción</h1>
					<fieldset>
						<div class="row">
							<div class="col-lg-8 col-lg-offset-2">
								
								<div class="form-group">
									<label>Notas</label>
									<textarea rows="2" class="form-control input-sm" name="notas"></textarea>
								</div>

								<div class="form-group">
									<label>Adjunto</label>

									<div class="fileinput input-group fileinput-new" data-provides="fileinput">
										<div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
										<span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new">Seleccionar archivo...</span><span class="fileinput-exists">Cambiar</span><input type="file" name="adjunto"></span>
										<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Eliminar</a>
									</div>
								</div>

							</div>
						</div>
					</fieldset>


					{!! Form::close() !!}

                    <form id="form" action="#" class="wizard-big">

                        <h1>Categoría y concepto</h1>
                        <fieldset>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Proveedor</label>
                                        <select class="form-control input-sm" name="tipo-cuenta">
                                            <option>Seleccione proveedor</option>
                                            <option>Proveedor 1</option>
                                            <option>Proveedor 2</option>
                                            <option>Proveedor 3</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Categoría</label>
                                        <select class="form-control input-sm" name="tipo-cuenta">
                                            <!-- Lista de todas las categorías de tipo Egreso   -->
                                            <option>Mantenimiento ascensores</option>
                                            <option>Categoría 2</option>
                                            <option>Categoría 3</option>
                                            <option>Categoría 4</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Concepto *</label>
                                        <div class="col-sm-12 input-group">
											<input type="text" class="form-control input-sm">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="text-center">
                                        <div style="margin-top: 0px">
                                            <i class="fa fa-sign-in" style="font-size: 160px;color: #e5e5e5 "></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <h1>Importe y forma de pago</h1>
                        <fieldset>
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label>Importe</label>
                                        <div class="col-sm-4 input-group">
											<input type="text" class="form-control input-sm">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Cuenta</label>
                                        <div class="col-sm-6 input-group">
											<select class="form-control input-sm" name="forma_de_pago">
												<option>Bco. 323-23232-23</option>
												<option>Caja Chica</option>
												<option>Caja General</option>
											</select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Forma de pago</label>
                                        <div class="col-sm-4 input-group">
											<select class="form-control input-sm" name="forma_de_pago">
												<option>Efectivo</option>
												<option>Cheque</option>
												<option>Transferencia bancaria</option>
												<option>Tarjeta Débito/Crédito</option>
											</select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Nro. Cheque / Banco, Nro. Transacción / Tipo tarjeta, Nro. Tarjeta</label>
                                        <div class="col-sm-6 input-group">
											<input type="text" class="form-control input-sm">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="row">
                                <div class="col-lg-10">
                                    <h5>Lista de últimos gastos categoría: Mantenimiento ascensores</h5>
                                    <div class="form-group">
										<div class="table-responsive">
											<table class="table table-striped" style="font-size: 12px;">
												<thead>
													<tr>
														<th>Fecha</th>
														<th>Proveedor</th>
														<th>Concepto</th>
														<th>Forma de pago</th>
														<th class="text-right">Importe</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>10/09/2016</td>
														<td>OTIS</td>
														<td>Pago mantenimiento agosto 2016</td>
														<td>Cheque Nro. 142</td>
														<td class="text-right">1.600,00</td>
													</tr>
													<tr>
														<td>11/08/2016</td>
														<td>OTIS</td>
														<td>Pago mantenimiento julio 2016</td>
														<td>Cheque Nro. 98</td>
														<td class="text-right">1.600,00</td>
													</tr>
													<tr>
														<td>08/07/2016</td>
														<td>OTIS</td>
														<td>Pago mantenimiento junio 2016</td>
														<td>Cheque Nro. 56</td>
														<td class="text-right">1.500,00</td>
													</tr>
												</tbody>
											</table>
										</div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <h1>Grabar transacción</h1>
                        <fieldset>
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label>Fecha</label>
                                        <div class="col-sm-4 input-group date">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" class="form-control input-sm" value="17/10/2016">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Proveedor</label>
                                        <input type="text" class="form-control input-sm" value="OTIS" disabled="">
                                    </div>
                                    <div class="form-group">
                                        <label>Categoría</label>
                                        <input type="text" class="form-control input-sm" value="Mantenimiento ascensor" disabled="">
                                    </div>
                                    <div class="form-group">
                                        <label>Concepto</label>
                                        <input type="text" class="form-control input-sm" value="Pago sericio mensual..." disabled="">
                                    </div>
                                    <div class="form-group">
                                        <label>Cuenta y forma de pago</label>
                                        <div class="col-sm-6 input-group">
											<input type="text" class="form-control input-sm" value="Bco. 323-23232-23: Cheque" disabled="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Importe</label>
                                        <div class="col-sm-4 input-group">
											<input type="text" class="form-control input-sm" value="1.600,00" disabled="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Notas</label>
                                        <textarea rows="2" class="form-control input-sm"></textarea>
                                    </div>

									<div class="form-group">
										<label>Adjunto</label>

										<div class="fileinput input-group fileinput-new" data-provides="fileinput">
											<div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
											<span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new">Seleccionar archivo...</span><span class="fileinput-exists">Cambiar</span><input type="hidden" value="" name="..."><input type="file" name=""></span>
											<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Eliminar</a>
										</div>
									</div>

                                </div>
                            </div>
                        </fieldset>


                        <h1>Imprimir</h1>
                        <fieldset>


							<div class="alert alert-success alert-dismissable">
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								Transacción registrada correctamente.
							</div>

							<div class="row">
								<div class="table-responsive">
									<table class="table" style="width: 80%; margin: auto; margin-bottom: 10px;">
										<tbody>
											<tr>
												<td style="border: 0;">
													<div class="p-h-xl"><img src="files/logoEmpresa.png" width="150"></div>
												</td>
												<td style="border: 0; vertical-align:bottom">
													<div class="p-h-xl text-right">
														<h2 style="line-height: 0;">RECIBO DE EGRESO</h2>
														<h3 style="line-height: 0; padding-top: 20px;">N&#186;&nbsp;<span>0067</span></h3>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-3">
								</div>
								<div class="col-sm-6">
									<div class="hr-line-solid"></div>
								</div>
								<div class="col-sm-3">
								</div>
							</div>

							<div class="row">
								<table style="margin: 10px auto; text-align: left; width: 80%; font-size: 13px;">
									<tr>
										<td>
											<div class="row" style="padding: 0 0 30px 0; line-height: 20px;">
												<div class="col-sm-1" style="width: 80px;">
													<span>Fecha:</span>
													<br/>
													<span>Proveedor:</span>
												</div>
												<div class="col-sm-8">
													<span>15/10/2016</span>
													<br/>
													<span style="text-transform: uppercase;"><strong>OTIS</strong></span>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<table cellpadding="0" cellspacing="0" style="width: 100%;">
												<tr>
													<td style="border-top: #333 1px solid; padding: 3px 0;" colspan="2">
														Mantenimiento ascensor: pago servicio mes de septiembre 2016
													</td>
												</tr>
												<tr>
													<td style="border-top: #eee 1px solid; padding: 3px 0;" colspan="2">
														Cuenta: Bco. 323-23232-23
													</td>
												</tr>
												<tr>
													<td style="border-top: #eee 1px solid; padding: 3px 0;" colspan="2">
														Forma de pago: Cheque No. 67
													</td>
												</tr>

												<tr style="font-size: 14px;">
													<td style="border-top: 2px solid #333; border-bottom: 2px solid #333; font-weight: 700;" class="alignright" width="80%; padding: 5px 0;">Total Bs.</td>
													<td style="border-top: 2px solid #333; border-bottom: 2px solid #333; font-weight: 700; text-align: right; padding: 3px 0;">1.600,00</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td style="padding-top: 8px;">
											<h4>SON: UN MIL SEISCIENTOS 00/100 BOLIVIANOS</h4>
										</td>
									</tr>
								</table>
							</div>

							<div class="row">
								<div class="table-responsive">
									<table style="margin: auto; text-align: left; width: 80%; font-size: 14px; margin-top: 10px;">
										<tr>
											<td>
												<div class="col-sm-3" style="width: 190px; padding-left: 0;">
													<div class="hr-line-solid" style="margin-bottom: 1px; border-top: 1px solid #A4A4A4;"></div>
													<span style="font-size: 10px;">Recibí conforme</span><br/>
													<span style="color: #F2F2F2; font-size: 16px;">_ _ _ _ _ _ _ _ _ _ _ _ _ _</span>
												</div>
												<div class="col-sm-1">
												</div>
											</td>
											<td>
												<div class="col-sm-3" style="width: 190px; padding-left: 0;">
													<div class="hr-line-solid" style="margin-bottom: 1px; border-top: 1px solid #A4A4A4;"></div>
													<span style="font-size: 10px;">Vo. Bo. Tesorero</span><br/>
													<span style="color: #F2F2F2; font-size: 16px;">_ _ _ _ _ _ _ _ _ _ _ _ _ _</span>
												</div>
											</td>
											<td>
												<div class="col-sm-1">
												</div>
												<div class="col-sm-3" style="width: 190px;">
													<div class="hr-line-solid" style="margin-bottom: 1px; border-top: 1px solid #A4A4A4;"></div>
													<span style="font-size: 10px;">Entregue conforme<br>
														Administración</span>
												</div>
											</td>
										</tr>
									</table>
								</div>
							</div>

							<div class="hr-line-dashed"></div>

							<div class="form-group">
								<div class="row">
									<div class="col-md-12">
										<button class="btn btn-success" type="submit">
											<i class="fa fa-print"></i>&nbsp;&nbsp;Imprimir</button>
										<button class="btn btn-default">
											<i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;Exportar</button>
										<span class="text-muted" style="margin: 0 10px;">|</span>
										<button class="btn btn-default">
											<i class="fa fa-file-o"></i>&nbsp;&nbsp;Nuevo gasto</button>
									</div>
								</div>
							</div>

							<div class="hr-line-dashed"></div>

							<div class="form-group">
								<div class="row">
									<div class="col-sm-12">
										<button class="btn btn-danger" type="submit">
											<i class="fa fa-trash"></i>&nbsp;&nbsp;Anular...</button>
									</div>
								</div>
							</div>

                        </fieldset>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('style')
<link rel="stylesheet" href="{{ URL::asset('css/wizard/jquery.steps.css') }}" />
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection


@section('javascript')
<script type="text/javascript" src="{{ URL::asset('js/wizard/jquery.steps.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/wizard/jquery.metisMenu.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/wizard/jquery.slimscroll.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/wizard/pace.min.js') }}"></script>

<script type="text/javascript" src="{{ URL::asset('js/wizard/jquery.validate.min.js') }}"></script>
<script>
	$(document).ready(function(){



	$("#form").steps({
	bodyTag: "fieldset",
			onStepChanging: function (event, currentIndex, newIndex)
			{
			// Always allow going backward even if the current step contains invalid fields!
			if (currentIndex > newIndex)
			{
			return true;
			}

			// paso 1 con datos
			if (newIndex === 1 && Number($("#proveedor-select option:selected").val()) == 0 || Number($("#cotegoria-select option:selected").val()) == 0 || $("#concepto-input").val() == "")
			{
			  return false;
			}

			//paso 2 importe mayor a 0
			if (newIndex === 2 && Number($("#importe-total").text()) == 0)
			{
			//return false;
			}

			//paso 3 validar campos
			if (newIndex === 3 && Number($("#select-cuenta option:selected").val()) == 0 )
			{
			  return false;
			}


			var form = $(this);
			// Clean up if user went backward before
			if (currentIndex < newIndex)
			{
			// To remove error styles
			$(".body:eq(" + newIndex + ") label.error", form).remove();
			$(".body:eq(" + newIndex + ") .error", form).removeClass("error");
			}

			// Disable validation on fields that are disabled or hidden.
			form.validate().settings.ignore = ":disabled,:hidden";
			// Start validation; Prevent going forward if false
			return form.valid();
			},
			labels: {
			finish: 'Enviar',
					next: 'Siguiente',
					previous: 'Retroceder',
					cancel: 'Cancelar'
			},
			onCanceled:function (event)
			{
			href = $("#direccion-lista").attr("href");
			console.log(href);
			window.location = href;
			},
			onFinishing: function (event, currentIndex)
			{
			var form = $(this);
			// Disable validation on fields that are disabled.
			// At this point it's recommended to do an overall check (mean ignoring only disabled fields)
			form.validate().settings.ignore = ":disabled";
			// Start validation; Prevent form submission if false
			return form.valid();
			},
			onFinished: function (event, currentIndex)
			{
			var form = $(this);
			// Submit form input
			form.submit();
			}
	})
	
	$('.date-picker').datetimepicker({
            format: 'DD/MM/YYYY'
    });

	//ajax contactos por propiedad
	$.ajaxSetup({
	headers: {
	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
	});
	$('#propiedades').change(function(){
	var propiedad_id = $(this).val();
	$.post('/contact/' + propiedad_id + '/property', function(response){
	if (response.success)
	{
	var contactos = $('#contactos').empty();
	$('<option/>', {
	value:0,
			text:"Seleccione un contacto"
	}).appendTo(contactos);
	$.each(response.contacts, function(i, contact){
	$('<option/>', {
	value:i,
			text:contact
	}).appendTo(contactos);
	})
	}
	}, 'json');
	});
	$('#select-cuenta').change(function(){

	console.log($("#select-cuenta option:selected").val());
	});
	$('#contactos').change(function(){
	//Cabio campo propiedades y contacto
	propiedad = $("#propiedades option:selected").text();
	contacto = $("#contactos option:selected").text();
	$('#propiedad-contacto').val(propiedad + " - " + contacto);
	//LLenado de cuentas por cobrar
	var propiedad_id = $("#propiedades option:selected").val();
	$.post('/accountsreceivable/' + propiedad_id + '/property', function(response){
	if (response.success)
	{
	var table_contacto = $('#cuentas-cobrar tbody').empty();
	var importe_total = 0;
	$.each(response.accountsreceivables, function(i, accountsreceivable){
	console.log(accountsreceivable);
	
	importe_total = importe_total + Number(accountsreceivable.importe_por_cobrar);
	trHtml = '<tr><td><input type="checkbox" importe="' + accountsreceivable.importe_por_cobrar + '" value="' + accountsreceivable.id + '" checked class="i-checks check-cuotas" name="cuotas[]"></td><td>' + accountsreceivable.gestion + '</td><td>' + periodo_literal + '</td><td>' + accountsreceivable.quota.cuota + '</td><td class="text-right">' + accountsreceivable.importe_por_cobrar + '</td></tr>';
	table_contacto.append(trHtml);
	});
	//console.log(importe_total);
	$('#importe-total').text(importe_total.toFixed(2));
	$('#importe').val(importe_total.toFixed(2));
	}
	}, 'json');
	});
	//Cabio de cuota check
	$('#form').on('change', ".check-cuotas", function () {
	var suma_importe = 0;
	$(".check-cuotas:checked").each(function() {
	suma_importe = suma_importe + parseFloat($(this).attr("importe"));
	});
	$('#importe-total').text(suma_importe.toFixed(2));
	$('#importe').val(suma_importe.toFixed(2));
	});
	//Cambio tipo de forma de pago
	$('#cont-forma-pago').hide();
	$('#forma-pago').change(function(){

	if ($(this).val() == "cheque"){
	$('#label-transaccion').text("Banco, Nro. Cheque");
	$('#cont-forma-pago').show("slow");
	} else if ($(this).val() == "deposito"){
	$('#label-transaccion').text("Nro. Transacción");
	$('#cont-forma-pago').show("slow");
	} else if ($(this).val() == "transferencia bancaria"){
	$('#label-transaccion').text("Banco, Nro. Transacción");
	$('#cont-forma-pago').show("slow");
	} else if ($(this).val() == "tarjeta debito/credito"){
	$('#label-transaccion').text("Banco, Tipo, Nro. Tarjeta");
	$('#cont-forma-pago').show("slow");
	} else{
	$('#label-transaccion').text("Detalle Transaccion");
	$('#cont-forma-pago').hide();
	}

	});
	});




</script>
@endsection


