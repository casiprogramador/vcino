@extends('layouts.admin')

@section('admin-content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Gastos</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.home') }}">Inicio</a>
            </li>
            <li>
                Transacciones
            </li>
            <li>
                <a id="direccion-lista" href="{{ route('transaction.expense.index') }}">Gastos</a>
            </li>
            <li class="active">
                <strong>Copiar gasto</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
				<div class="ibox-title">
                    <h5 style="padding-top: 2px;">Copiar gasto</h5>
                </div>
                <div class="ibox-content">
					{!! Form::open(array('route' => 'transaction.expense.store', 'class' => 'wizard-big form-horizontal', 'id' => 'form', 'files' => true)) !!}
					<input type="hidden" name="transaction_id" value="{{$expense->transaction->id}}">
					<h1>Categoría y concepto</h1>
					<fieldset>
						<div class="col-lg-8">
							<div class="form-group">
								<label>Proveedor</label>
								{{ Form::select('proveedor',['0'=>'Seleccione un proveedor']+$suppliers,$expense->supplier_id, ['class' => 'form-control input-sm','id'=>'proveedor-select']) }}
							</div>
							<div class="form-group">
								<label>Categoría</label>
								{{ Form::select('categoria',['0'=>'Seleccione una categoría']+$categories,$expense->category_id, ['class' => 'form-control input-sm','id'=>'categoria-select']) }}
							</div>
							<div class="form-group">
								<label>Concepto</label>
								<div class="col-sm-12 input-group">
                                    <input type="text" class="form-control input-sm" value="{{$expense->transaction->concepto}}" name="concepto" id="concepto-input">
								</div>
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
					<h1>Transacciones anteriores</h1>
					<fieldset>
						<h4 style="font-weight: normal;">Últimos gastos de la categoría: <span id="nombre-proveedor" style="font-weight: bold;"></span></h4>
						<div class="col-lg-12">
							<div class="form-group">
                                <div class="table-responsive">
                                	<table class="table table-striped" style="font-size: 12px;" id="gastos-table">
                                        <thead>
											<tr>
												<th style="background-color: #a4a5a6">Fecha de pago</th>
												<th style="background-color: #a4a5a6">Proveedor</th>
												<th style="background-color: #a4a5a6">Concepto</th>
												<th style="background-color: #a4a5a6">Forma de pago</th>
												<th style="background-color: #a4a5a6" class="text-right">Importe</th>
											</tr>
                                        </thead>
                                        <tbody>
											<tr>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td class="text-right"></td>
											</tr>
											<tr>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td class="text-right"></td>
											</tr>
											<tr>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td class="text-right"></td>
											</tr>
                                        </tbody>
                                    </table>
                                </div>
							</div>
						</div>
					</fieldset>

					<h1>Importe y forma de pago</h1>
					<fieldset>
						<div class="col-lg-10">
							<div class="form-group">
								<label class="col-sm-4 control-label">Fecha</label>
								<div class="col-sm-4 input-group date">
									<span class="input-group-addon" style="border-top: 1px solid #CCC; border-bottom: 1px solid #CCC; border-left: 1px solid #CCC;"><i class="fa fa-calendar"></i></span>
									<input type="text" name="fecha" id="fecha" class="form-control input-sm date-picker" value="{{ date_format(date_create($expense->transaction->fecha_pago),'d/m/Y') }}" required>
								</div>
							</div>
							<div class="form-group">
								 <label class="col-sm-4 control-label">Importe</label>
								<div class="col-sm-4 input-group">
	                                <span class="input-group-addon" style="border-top: 1px solid #CCC; border-bottom: 1px solid #CCC; border-left: 1px solid #CCC;">Bs.</span>
                                    <input type="text" class="form-control input-sm" name="importe" id="importe-input" value="{{$expense->transaction->importe_debito}}">
								</div>
							</div>
							<div class="form-group">
								 <label class="col-sm-4 control-label">Cuenta</label>
								<div class="col-sm-8 input-group">
									{{ Form::select('cuenta',['0'=>'Seleccione una cuenta']+$accounts,$expense->account_id, ['class' => 'form-control input-sm','id'=>'select-cuenta']) }}
								</div>
							</div>
							<div class="form-group">
								 <label class="col-sm-4 control-label">Forma de pago</label>
								<div class="col-sm-8 input-group">
									{{ Form::select('forma_pago', array('efectivo' => 'Efectivo','cheque' => 'Cheque', 'deposito' => 'Depósito','transferencia' => 'Transferencia','tarjeta debito/credito' => 'Tarjeta Débito/Crédito'),$expense->transaction->forma_pago, ['class' => 'form-control input-sm','id'=>'forma-pago']) }}
                                </div>
							</div>

							<div class="form-group" id="cont-forma-pago">
								 <label class="col-sm-4 control-label" id="label-transaccion">Nro Transaccion</label>
								<div class="col-sm-8 input-group">
									<input type="text" class="form-control input-sm" name="nro_forma_pago" id="nro-pago-input" value="{{$expense->transaction->numero_forma_pago}}">
								</div>
							</div>
						</div>
						<div class="col-lg-2">
                        </div>
					</fieldset>
					
					<h1>Grabar transacción</h1>
					<fieldset>
						<div class="col-lg-9">
							<div class="form-group">
								<label>Notas</label>
								<textarea rows="2" class="form-control input-sm" name="notas">{{$expense->transaction->notas}}</textarea>
							</div>
							<div class="form-group">
								<label>Adjunto:</label>

								<div id="adjunto-file" class="fileinput input-group {{!empty($expense->adjunto) ? 'fileinput-exists'  : 'fileinput-new'}}" data-provides="fileinput">
									<div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename">{{ (!empty($expense->adjunto) ) ? MenuRoute::filename($expense->adjunto) : "" }}</span></div>
									<span class="input-group-addon btn btn-default btn-file">
										<span class="fileinput-new">Seleccionar archivo...</span><span class="fileinput-exists">Cambiar</span>
										<input type="file" name="adjunto">
										<input type="hidden" id="adjunto-ori" name="adjunto_ori" value="{{ (isset($expense->adjunto) ) ? $expense->adjunto : '' }}">
									</span>
									<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Eliminar</a>
								</div>
							</div>
						</div>
						<div class="col-lg-3">
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

		$.ajaxSetup({
		headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
		});
		//llenado e gastos al inicios
		var proveedor_id = $('#categoria-select option:selected').val();
		var proveedor_text = $('#categoria-select option:selected').text(); 
		$('#nombre-proveedor').text(proveedor_text);
		$.post('/expenses/'+ proveedor_id +'/category', function(response){
			if (response.success)
			{
				console.log(response.expenses);
				var table_gastos = $('#gastos-table tbody').empty();
				$.each(response.expenses, function(i, expense){
					console.log(expense.fecha_pago)
					var fecha_pago = new Date(expense.fecha_pago);
					fecha_pago.setDate(fecha_pago.getDate() + 1);
					mes = fecha_pago.getMonth()+1;
					dia = fecha_pago.getDate();
					var fecha_pago_format = ("0" + dia).slice(-2)+"/"+("0" + mes).slice(-2)+"/"+fecha_pago.getFullYear();
					//console.log(fecha_pago);

					trHtml = '<tr><td>'+fecha_pago_format+'</td><td>'+expense.razon_social+'</td><td>'+expense.concepto+'</td><td>'+expense.forma_pago+'</td><td class="text-right">'+expense.importe_debito+'</td></tr>';
					table_gastos.append(trHtml);
				})
			}
		}, 'json');


		
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
			$('#label-transaccion').text("Detalle transacción");
			$('#cont-forma-pago').hide();
	}

	//formularios de pasos
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
			if (newIndex === 1)
			{
				if (Number($("#proveedor-select option:selected").val()) == 0 || Number($("#categoria-select option:selected").val()) == 0 || $("#concepto-input").val() == "")
				{
				  return false;
				}
			}

			//paso 3 validar campos
			if (newIndex === 3)
			{
				if (Number($("#select-cuenta option:selected").val()) == 0 || Number($("#importe-input").val()) == 0 || isNaN($("#importe-input").val()))
				{
			  		return false;
			  	}
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
            format: 'DD/MM/YYYY',
			widgetPositioning: {
			horizontal: 'left',
					vertical: 'bottom'
			}
    });

	//ajax contactos por propiedad

	$('#categoria-select').change(function(){
		//se cambio a categoria en lugar de proveedor
		var proveedor_id = $(this).val();
		var proveedor_text = $('#categoria-select option:selected').text(); 
		$('#nombre-proveedor').text(proveedor_text);
		$.post('/expenses/'+ proveedor_id +'/category', function(response){
			if (response.success)
			{
				//console.log(response.expenses);
				var table_gastos = $('#gastos-table tbody').empty();
				$.each(response.expenses, function(i, expense){
					//console.log(expense.fecha_pago)
					var fecha_pago = new Date(expense.fecha_pago);
					fecha_pago.setDate(fecha_pago.getDate() + 1);
					mes = fecha_pago.getMonth()+1;
					dia = fecha_pago.getDate();
					var fecha_pago_format = ("0" + dia).slice(-2)+"/"+("0" + mes).slice(-2)+"/"+fecha_pago.getFullYear();
					//console.log(fecha_pago);

					trHtml = '<tr><td>'+fecha_pago_format+'</td><td>'+expense.razon_social+'</td><td>'+expense.concepto+'</td><td style="text-transform: capitalize;">'+expense.forma_pago+'</td><td class="text-right">'+expense.importe_debito+'</td></tr>';
					table_gastos.append(trHtml);
				})
			}
		}, 'json');
	});


	//Cambio tipo de forma de pago
		$('#forma-pago').change(function(){

			if ($(this).val() == "cheque"){
			$('#label-transaccion').text("Banco, Nro. Cheque");
			$('#cont-forma-pago').show("slow");
			} else if ($(this).val() == "deposito"){
			$('#label-transaccion').text("Nro. Transacción");
			$('#cont-forma-pago').show("slow");
			} else if ($(this).val() == "transferencia"){
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
		$('#adjunto-file').on('clear.bs.fileinput', function(event) {
			console.log('eliminar');
			$('#adjunto-ori').val('');
		});
	});




</script>
@endsection


