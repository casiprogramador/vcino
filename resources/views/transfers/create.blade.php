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
                <a href="#">Lista de transacciones</a>
            </li>
            <li class="active">
                <strong>Nuevo traspaso</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
				<div class="ibox-title">
                    <h5 style="padding-top: 2px;">Nuevo traspaso</h5>
                </div>
                <div class="ibox-content">
                    <h2>
                        Registro de traspaso
                    </h2>

					{!! Form::open(array('route' => 'transaction.transfer.store', 'class' => 'wizard-big form-horizontal', 'id' => 'form', 'files' => true)) !!}

					<h1>Cuentas</h1>
					<fieldset>
						<div class="row">
							<div class="col-lg-6 col-lg-offset-1">
								<div class="form-group">
									<label>Cuenta origen</label>
									{{ Form::select('cuenta_origen',['0'=>'Selecciona una cuenta']+$accounts, old('cuenta_origen'), ['class' => 'form-control input-sm','id'=>'select-cuenta-origen']) }}
								</div>
								<div class="form-group">
									<label>Modo de traspaso</label>
									<div class="col-sm-6 input-group">
										{{ Form::select('modo_traspaso', array('efectivo' => 'Efectivo','cheque' => 'Cheque', 'deposito' => 'Depósito','transferencia bancaria' => 'Transferencia bancaria','tarjeta debito/credito' => 'Tarjeta Débito/Crédito'),old('modo_traspaso'), ['class' => 'form-control input-sm','id'=>'forma-pago']) }}
									</div>
								</div>
								<div class="form-group" id="cont-forma-pago">
									<label class="control-label" id="label-transaccion">Nro Transaccion</label>

									<input type="text" class="form-control input-sm" name="nro_transanccion" id="nro-pago-input">

								</div>
								<div class="form-group">
									<label>Cuenta destino</label>
									{{ Form::select('cuenta_destino',['0'=>'Selecciona una cuenta']+$accounts, old('cuenta_destino'), ['class' => 'form-control input-sm','id'=>'select-cuenta-destino']) }}
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

					<h1>Detalles</h1>
					<fieldset>
						<div class="row">
							<div class="col-lg-8 col-lg-offset-1">
								<div class="form-group">
									<label class="control-label">Fecha</label>
									<div class="input-group date">
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										<input type="text" name="fecha" id="fecha" class="form-control input-sm date-picker" value="{{ date('d/m/Y') }}" required>
									</div>
								</div>
								<div class="form-group">
									<label>Cuenta origen</label>
									<div class="col-sm-6 input-group">
										<input type="text" class="form-control input-sm" id="input-cuenta-origen" value="" disabled="">
									</div>
								</div>
								<div class="form-group">
									<label>Cuenta destino</label>
									<div class="col-sm-6 input-group">
										<input type="text" class="form-control input-sm" id="input-cuenta-destino" value="" disabled="">
									</div>
								</div>
								<div class="form-group">
									<label>Concepto</label>
									<input type="text" name="concepto" class="form-control input-sm" value="{{old('concepto')}}">
								</div>

							</div>
						</div>
					</fieldset>


					<h1>Datos Adicionales</h1>
					<fieldset>
						<div class="row">
							<div class="col-lg-8 col-lg-offset-1">
								<div class="form-group">
									<label>Importe</label>
									<div class="col-sm-4 input-group">
										<input type="text" class="form-control input-sm" name="importe" value="{{old('importe')}}">
									</div>
								</div>
								<div class="form-group">
									<label>Nota</label>
									<textarea rows="2" class="form-control input-sm" name="nota">{{old('nota')}}</textarea>
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
			if (newIndex === 1 && Number($("#select-cuenta-origen option:selected").val()) == 0 || Number($("#select-cuenta-destino option:selected").val()) == 0)
			{
			return false;
			}

			//paso 2 importe mayor a 0
			if (newIndex === 2 && Number($("#importe-total").text()) == 0)
			{
			//return false;
			}

			//paso 3 validar campos
			if (newIndex === 3 && Number($("#select-cuenta option:selected").val()) == 0)
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

		$("#select-cuenta-origen").change(function(){	
			$('#input-cuenta-origen').val($("#select-cuenta-origen option:selected" ).text());
		});
		$("#select-cuenta-destino").change(function(){	
			$('#input-cuenta-destino').val($("#select-cuenta-destino option:selected" ).text());
		});
	});




</script>
@endsection


