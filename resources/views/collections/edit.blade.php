@extends('layouts.admin')

@section('admin-content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Cobranzas</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.home') }}">Inicio</a>
            </li>
            <li>
                Transacciones
            </li>
            <li>
                <a id="direccion-lista" href="{{ route('transaction.collection.index') }}">Cobranzas</a>
            </li>
            <li class="active">
                <strong>Editar cobranza</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
				<div class="ibox-title">
                    <h5 style="padding-top: 2px;">Editar cobranza</h5>
                </div>
                <div class="ibox-content">
					{!! Form::open(array('route' => array('transaction.collection.update', $collection->id),'method' => 'patch' ,'class' => 'wizard-big form-horizontal', 'id' => 'form')) !!}
					<input type="hidden" class="form-control input-sm" id="cuotas" name="cuotas_originales" value="{{$collection->cuotas}}">
						<h1>Propiedad y contacto</h1>
                        <fieldset>
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label>Propiedad</label>
									{{ Form::select('propiedad',['0'=>'Seleccione una propiedad']+$properties, $collection->property_id, ['class' => 'form-control input-sm','id'=>'propiedades','disabled'=>'disabled']) }}
									<input type="hidden" class="form-control input-sm" id="propiedad" name="propiedad" value="{{$collection->property_id}}">
                                </div>
                                <div class="form-group">
                                    <label>Contacto (A nombre de)</label>
									{{ Form::select('contacto',['0'=>'Seleccione un contacto']+$contacts, $collection->contact_id, ['class' => 'form-control input-sm','id'=>'contactos']) }}
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="text-center">
                                    <div style="margin-top: 0px">
                                        <i class="fa fa-sign-in" style="font-size: 160px;color: #e5e5e5 "></i>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
						<h1>Cuotas por cobrar</h1>
                        <fieldset>
                    		<h4 style="font-weight: normal;">Seleccione la(s) cuota(s) por cobrar que serán canceladas, luego presione el botón siguiente.</h4>
                            <div class="col-lg-10">
                                <div class="form-group">
									<div class="table-responsive">
									<div style="height:270px; overflow: auto;">
										<table class="table table-striped" id="cuentas-cobrar">
											<thead>
												<tr>
													<th width="50" style="background-color: #a4a5a6;"></th>
													<th style="background-color: #a4a5a6">Gestión</th>
													<th style="background-color: #a4a5a6">Periodo</th>
													<th style="background-color: #a4a5a6">Cuota</th>
													<th class="text-right" style="background-color: #a4a5a6">Importe</th>
												</tr>
											</thead>
											<tbody>
												@foreach($cuotas_cobradas as $cuota)
												<tr>
													<td>
														<input type="checkbox" importe="{{ $cuota->importe_por_cobrar }}" value="{{ $cuota->id }}" checked class="i-checks check-cuotas" name="cuotas[]">
													</td>
													<td>{{$cuota->gestion}}</td>
													<td>{{nombremes($cuota->periodo) }}</td>
													<td>{{ $cuota->quota->category->nombre }} : {{ $cuota->quota->cuota }}</td>
													<td class="text-right">{{ $cuota->importe_por_cobrar }}</td>
												</tr>
												@endforeach
												@foreach($cuotas as $cuota)
												<tr>
													<td>
														<input type="checkbox" importe="{{ $cuota->importe_por_cobrar }}" value="{{ $cuota->id }}" class="i-checks check-cuotas" name="cuotas[]">
													</td>
													<td>{{$cuota->gestion}}</td>
													<td>{{nombremes($cuota->periodo) }}</td>
													<td>{{ $cuota->quota->category->nombre }} : {{ $cuota->quota->cuota }}</td>
													<td class="text-right">{{ $cuota->importe_por_cobrar }}</td>
												</tr>
												@endforeach
												
											</tbody>
											<tfoot>
												<tr>
													<th colspan="4">Total Bs.</th>
													<th class="text-right" id="importe-total">{{$collection->transaction->importe_credito}}</th>
												</tr>
											</tfoot>
										</table>
									</div>
									</div>
                                </div>
                            </div>
							<div class="col-lg-2">
                            </div>

                        </fieldset>

						<h1>Fecha, cuenta y concepto</h1>
                        <fieldset>
                            <div class="col-lg-10">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Fecha</label>
                                    <div class="col-sm-4 input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="text" name="fecha" id="fecha" class="form-control input-sm date-picker" value="{{ date_format(date_create($collection->transaction->fecha_pago),'d/m/Y') }}" required>
                                    </div>
                                </div>
								<div class="form-group">
                                    <label class="col-sm-4 control-label">Propiedad y contacto</label>
									<div class="col-sm-8 input-group">
                                    <input type="text" class="form-control input-sm" id="propiedad-contacto" value="{{ $collection->property->nro }} - {{ $collection->contact->nombre }} {{ $collection->contact->apellido }}" disabled="">
									</div>
                                </div>
								<div class="form-group">
                                    <label class="col-sm-4 control-label">Cuenta</label>
                                    <div class="col-sm-8 input-group">
									{{ Form::select('cuenta',['0'=>'Seleccione una cuenta']+$accounts, $collection->account_id , ['class' => 'form-control input-sm','id'=>'select-cuenta']) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                     <label class="col-sm-4 control-label">Concepto</label>
									<div class="col-sm-8 input-group">
                                    <textarea rows="2" id="concepto" class="form-control input-sm" name="concepto" required>{{$collection->transaction->concepto }}</textarea>
									</div>
                                </div>
                            </div>
							<div class="col-lg-2">
                            </div>

                        </fieldset>

						<h1>Forma de pago y notas</h1>
                        <fieldset>
                            <div class="col-lg-10">		
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Forma de pago</label>
                                    <div class="col-sm-6 input-group">
										{{ Form::select('forma_pago', array('efectivo' => 'Efectivo','cheque' => 'Cheque', 'deposito' => 'Depósito','transferencia' => 'Transferencia','tarjeta debito/credito' => 'Tarjeta Débito/Crédito'), $collection->transaction->forma_pago , ['class' => 'form-control input-sm','id'=>'forma-pago']) }}
                                    </div>
                                </div>

                                <div class="form-group" id="cont-forma-pago">
									<!--
									<label>Banco, Nro. Cheque / Nro. Transacción / Banco, Nro. Transacción / Banco, Tipo, Nro. Tarjeta</label>
									-->
									<label class="col-sm-4 control-label" id="label-transaccion">Nro. Transacción</label>
                                    <div class="col-sm-6 input-group">
										<input type="text" class="form-control input-sm" name="nro_forma_pago" value="{{$collection->transaction->numero_forma_pago}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Importe</label>
                                    <div class="col-sm-4 input-group">
			                            <div class="input-group">
			                                <span class="input-group-addon" style="background-color: #CCC; border: 1px solid #ccc;">Bs.</span>
											<input type="text" class="form-control input-sm" readonly id="importe" name="importe_total" value="{{$collection->transaction->importe_credito}}">
										</div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Notas</label>
									<div class="col-sm-8 input-group">
										<textarea rows="3" class="form-control input-sm" name="notas">{{$collection->transaction->notas}}</textarea>
									</div>
                                </div>
                            </div>
							<div class="col-lg-2">
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
<!--Lenguaje datepicker español-->
<script type="text/javascript" src="{{ URL::asset('js/moment.es.js') }}"></script>
<script>
	$(document).ready(function(){

	//Detectar forma de pago
	
	$foma_pago_val = $("#forma-pago option:selected" ).val();
	
	if($foma_pago_val == "cheque"){
			console.log($foma_pago_val);
			$('#label-transaccion').text("Banco, Nro. Cheque");
			$('#cont-forma-pago').show("slow");
			
	}else if($foma_pago_val == "deposito"){
			$('#label-transaccion').text("Nro. Transacción");
			$('#cont-forma-pago').show("slow");
			
	}else if($foma_pago_val == "transferencia"){
			$('#label-transaccion').text("Banco, Nro. Transacción");
			$('#cont-forma-pago').show("slow");
			
	}else if($foma_pago_val == "tarjeta debito/credito"){
			$('#label-transaccion').text("Banco, Tipo, Nro. Tarjeta");
			$('#cont-forma-pago').show("slow");
			
	}else{
			$('#label-transaccion').text("Detalle Transaccion");
			$('#cont-forma-pago').hide();
	}
		
	$("#form").steps({
	bodyTag: "fieldset",
			onStepChanging: function (event, currentIndex, newIndex)
			{
			// Always allow going backward even if the current step contains invalid fields!
			if (currentIndex > newIndex )
			{
			return true;
			}

			// paso 1 con datos
			if (newIndex === 1 && Number($( "#propiedades option:selected" ).val()) == 0 || Number($( "#contactos option:selected" ).val()) == 0)
			{
			return false;
			}
			
			//paso 2 importe mayor a 0
			if (newIndex === 2 && Number($( "#importe-total" ).text()) == 0)
			{
			return false;
			}
			
			//paso 3 validar campos
			if (newIndex === 3 && Number($("#select-cuenta option:selected" ).val()) == 0)
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
			locale:'es',
            format: 'DD/MM/YYYY',
			widgetPositioning: {
			horizontal: 'left',
					vertical: 'bottom'
			}
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
	
	$('#select-cuenta').change(function(){
			
		console.log($("#select-cuenta option:selected" ).val());
	});
	
	
	$('#propiedades').change(function(){
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
				$('#importe').val(importe_total.toFixed(2));
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
		$('#importe').val(suma_importe.toFixed(2));
	});
	
	//Cambio tipo de forma de pago
	//$('#cont-forma-pago').hide();
	$('#forma-pago').change(function(){
		
		if($(this).val() == "cheque"){
			$('#label-transaccion').text("Banco, Nro. Cheque");
			$('#cont-forma-pago').show("slow");
			
		}else if($(this).val() == "deposito"){
			$('#label-transaccion').text("Nro. Transacción");
			$('#cont-forma-pago').show("slow");
			
		}else if($(this).val() == "transferencia"){
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

