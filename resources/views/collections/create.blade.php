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
                <a href="#">Lista de cobranzas</a>
            </li>
            <li class="active">
                <strong>Nueva cobranza</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
				<div class="ibox-title">
                    <h5 style="padding-top: 2px;">Nueva cobranza</h5>
                </div>
                <div class="ibox-content">
                    <h2>
                        Cobranza de cuotas
                    </h2>

                    <form id="form" action="#" class="wizard-big form-horizontal">
						<h1>Propiedad y contacto</h1>
                        <fieldset>
                            <div class="row">
                                <div class="col-lg-6 col-lg-offset-3">
                                    <div class="form-group">
                                        <label>Propiedad</label>
										{{ Form::select('propiedad',['0'=>'Selecciona una propiedad']+$properties, old('propiedad'), ['class' => 'form-control input-sm','id'=>'propiedades']) }}
                                    </div>
                                    <div class="form-group">
                                        <label>Contacto (A nombre de)</label>
                                        <select class="form-control input-sm" name="contacto" id="contactos">
                                            <option value="0">Seleccione contacto</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
						<h1>Cuotas por cobrar</h1>
                        <fieldset>
                            <div class="row">
                                <div class="col-lg-10 col-lg-offset-1">
                                    <div class="form-group">
										<div class="table-responsive">
											<table class="table table-striped" id="cuentas-cobrar">
												<thead>
													<tr>
														<th></th>
														<th>Gestión</th>
														<th>Periodo</th>
														<th>Cuota</th>
														<th class="text-right">Monto</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td><input type="checkbox"  checked class="i-checks" name="input[]"></td>
														<td>2016</td>
														<td>Junio</td>
														<td>Expensas: cuota mensual</td>
														<td class="text-right">700,00</td>
													</tr>
													
												</tbody>
												<tfoot>
													<tr>
														<th>Total Bs.</th>
														<th></th>
														<th></th>
														<th></th>
														<th class="text-right" id="importe-total">0</th>
													</tr>
												</tfoot>
											</table>
										</div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

						<h1>Datos transacción</h1>
                        <fieldset>
                            <div class="row">
                                <div class="col-lg-8 col-lg-offset-2">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Fecha</label>
                                        <div class="col-sm-4 input-group date">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" name="fecha" class="form-control input-sm date-picker" value="{{ date('d/m/Y') }}" required>
                                        </div>
                                    </div>
									<div class="form-group">
                                        <label class="col-sm-4 control-label">Propiedad y contacto</label>
										<div class="col-sm-6 input-group">
                                        <input type="text" class="form-control input-sm" id="propiedad-contacto" value="" disabled="">
										</div>
                                    </div>
                                    <div class="form-group">
                                         <label class="col-sm-4 control-label">Concepto</label>
										<div class="col-sm-8 input-group">
                                        <textarea rows="2" class="form-control input-sm" name="concepto" required></textarea>
										</div>
                                    </div>
									
                                </div>
                            </div>
                        </fieldset>

						<h1>Detalle transacción</h1>
                        <fieldset>
                            <div class="row">
                                <div class="col-lg-8 col-lg-offset-2">

									<div class="form-group">
                                        <label class="col-sm-4 control-label">Cuenta</label>
                                        <div class="col-sm-8 input-group">
										{{ Form::select('cuenta',['0'=>'Selecciona una cuenta']+$accounts, old('cuenta'), ['class' => 'form-control input-sm','id'=>'cuenta']) }}
                                        </div>
                                    </div>		
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Forma de pago</label>
                                        <div class="col-sm-8 input-group">
											<select class="form-control input-sm" name="forma_de_pago" id="forma-pago">
												<option value="efectivo">Efectivo</option>
												<option value="cheque">Cheque</option>
												<option value="deposito">Depósito</option>
												<option value="transferencia bancaria">Transferencia bancaria</option>
												<option value="tarjeta debito/credito">Tarjeta Débito/Crédito</option>
											</select>
                                        </div>
                                    </div>

                                    <div class="form-group" id="cont-forma-pago">
<!--                                        <label>Banco, Nro. Cheque / Nro. Transacción / Banco, Nro. Transacción / Banco, Tipo, Nro. Tarjeta</label>-->
										<label class="col-sm-4 control-label" id="label-transaccion">Nro Transaccion</label>
                                        <div class="col-sm-8 input-group">
											<input type="text" class="form-control input-sm" name="nro_transaccion">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Importe</label>
                                        <div class="col-sm-8 input-group">
											<input type="text" class="form-control input-sm" value="1.400,00" disabled="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Notas</label>
										<div class="col-sm-8 input-group">
                                        <textarea rows="2" class="form-control input-sm" name="notas"></textarea>
										</div>
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
			if (currentIndex > newIndex )
			{
			return true;
			}

			// Forbid suppressing "Warning" step if the user is to young
			if (newIndex === 1 && Number($( "#propiedades option:selected" ).val()) == 0 || Number($( "#contactos option:selected" ).val()) == 0)
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
		$.post('/contact/'+propiedad_id+'/property', function(response){
		if(response.success)
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
	
	
	$('#contactos').change(function(){
		//Cabio campo propiedades y contacto
		propiedad = $( "#propiedades option:selected" ).text();
		contacto = $( "#contactos option:selected" ).text();
		$('#propiedad-contacto').val(propiedad+" - "+contacto);
		//LLenado de cuentas por cobrar
		var propiedad_id = $( "#propiedades option:selected" ).val();
		$.post('/accountsreceivable/'+propiedad_id+'/property', function(response){
			if(response.success)
			{
				var table_contacto = $('#cuentas-cobrar tbody').empty();
				var importe_total = 0;
				$.each(response.accountsreceivables, function(i, accountsreceivable){
					console.log(accountsreceivable);
					switch(Number(accountsreceivable.periodo)){
						case 1:
							periodo_literal = "Enero";
							break;
						case 2:
							periodo_literal = "Febrero";
							break;
						case 3:
							periodo_literal = "Marzo";
							break;
						case 4:
							periodo_literal = "Abril";
							break;
						case 5:
							periodo_literal = "Mayo";
							break;
						case 6:
							periodo_literal = "Junio";
							break;
						case 7:
							periodo_literal = "Julio";
							break;
						case 8:
							periodo_literal = "Agosto";
							break;
						case 9:
							periodo_literal = "Septiembre";
							break;
						case 10:
							periodo_literal = "Octubre";
							break;
						case 11:
							periodo_literal = "Noviembre";
							break;
						case 12:
							periodo_literal = "Diciembre";
							break;
						default: 
							periodo_literal = "NN";
						
					}
					importe_total = importe_total + Number(accountsreceivable.importe_por_cobrar);
					trHtml = '<tr><td><input type="checkbox" importe="'+accountsreceivable.importe_por_cobrar+'" value="'+accountsreceivable.id+'" checked class="i-checks check-cuotas" name="cuotas[]"></td><td>'+accountsreceivable.gestion+'</td><td>'+periodo_literal+'</td><td>'+accountsreceivable.quota.cuota+'</td><td class="text-right">'+accountsreceivable.importe_por_cobrar+'</td></tr>';
					table_contacto.append(trHtml);
				});
				//console.log(importe_total);
				$('#importe-total').text(importe_total.toFixed(2));
			}
		}, 'json');
		
		
    });
	
	//Cabio de cuota check
	$('#form').on('change',".check-cuotas", function () {
		var suma_importe = 0;
		$(".check-cuotas:checked").each(function() {
			suma_importe = suma_importe + parseFloat($(this).attr("importe"));
			
		});
		$('#importe-total').text(suma_importe.toFixed(2));
	});
	
	//Cambio tipo de forma de pago
	$('#cont-forma-pago').hide();
	$('#forma-pago').change(function(){
		
		if($(this).val() == "cheque"){
			$('#label-transaccion').text("Banco, Nro. Cheque");
			$('#cont-forma-pago').show("slow");
			
		}else if($(this).val() == "deposito"){
			$('#label-transaccion').text("Nro. Transacción");
			$('#cont-forma-pago').show("slow");
			
		}else if($(this).val() == "transferencia bancaria"){
			$('#label-transaccion').text("Banco, Nro. Transacción");
			$('#cont-forma-pago').show("slow");
			
		}else if($(this).val() == "tarjeta debito/credito"){
			$('#label-transaccion').text("Banco, Tipo, Nro. Tarjeta");
			$('#cont-forma-pago').show("slow");
			
		}else{
			$('#label-transaccion').text("Detalle Transaccion");
			$('#cont-forma-pago').hide();
		}
			
	});

	});
	
	
	
	
</script>
@endsection