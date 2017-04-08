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
                <a id="direccion-lista" href="{{ route('transaction.expense.index') }}">Lista de gastos</a>
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
								<h5>Lista de últimos gastos proveedor: <span id="nombre-proveedor"></span></h5>
								<div class="form-group">
                                    <div class="table-responsive">
                                        <table class="table table-striped" style="font-size: 12px;" id="gastos-table">
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
	$('#proveedor-select').change(function(){
		var proveedor_id = $(this).val();
		var proveedor_text = $('#proveedor-select option:selected').text(); 
		$('#nombre-proveedor').text(proveedor_text);
		$.post('/expenses/'+ proveedor_id +'/supplier', function(response){
			if (response.success)
			{
				
				var table_gastos = $('#gastos-table tbody').empty();
				$.each(response.expenses, function(i, expense){

					var fecha_pago = new Date(expense.transaction.fecha_pago);
					fecha_pago.setDate(fecha_pago.getDate() + 1);
					mes = fecha_pago.getMonth()+1;
					dia = fecha_pago.getDate();
					var fecha_pago_format = ("0" + dia).slice(-2)+"/"+("0" + mes).slice(-2)+"/"+fecha_pago.getFullYear();
					//console.log(fecha_pago);

					trHtml = '<tr><td>'+fecha_pago_format+'</td><td>'+expense.supplier.razon_social+'</td><td>'+expense.transaction.concepto+'</td><td>'+expense.transaction.forma_pago+'</td><td class="text-right">'+expense.transaction.importe_debito+'</td></tr>';
					table_gastos.append(trHtml);
				})
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


