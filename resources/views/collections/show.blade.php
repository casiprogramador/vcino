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
                <a href="{{ route('transaction.collection.index') }}">Lista de cobranzas</a>
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
                <div class="ibox-content" >
                    <h2>
                        Cobranza de cuotas
                    </h2>

                    <div id="form" class="wizard-big">


                        <h1>Imprimir/ Enviar comprobante</h1>
                        <fieldset>


							<div class="alert alert-success alert-dismissable">
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								Transacción registrada correctamente.
							</div>

							<div id="printableArea">
								<div class="row">
									<div class="table-responsive">
										<table class="table" style="width: 80%; margin: auto; margin-bottom: 10px;">
											<tbody>
												<tr>
													<td style="border: 0;">
														<div class="p-h-xl"><img src="{{ URL::asset(Auth::user()->company->logotipo)}}" width="150"></div>
													</td>
													<td style="border: 0; vertical-align:bottom">
														<div class="p-h-xl text-right">
															<h2 style="line-height: 0;">RECIBO DE INGRESO</h2>
															<h3 style="line-height: 0; padding-top: 20px;">N&#186;&nbsp;<span>{{ str_pad($collection->transaction->nro_documento, 6, "0", STR_PAD_LEFT)}}</span></h3>
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
														<span>Propiedad:</span>
													</div>
													<div class="col-sm-8">
														<span>{{ date_format(date_create($collection->transaction->fecha_pago),'d/m/Y') }}</span>
														<br/>
														<span style="text-transform: uppercase;"><strong>{{ $collection->property->nro }} - {{ $collection->contact->nombre }} {{ $collection->contact->apellido }}</strong></span>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td>
												<table cellpadding="0" cellspacing="0" style="width: 100%;">


													@foreach($cuotas as $cuota)
													<tr>
														<td style="border-top: #eee 1px solid; padding: 3px 0;">
															{{ $cuota->quota->category->nombre }} : {{ $cuota->quota->cuota }} {{nombremes($cuota->periodo) }}/{{$cuota->gestion}}
														</td>
														<td style="border-top: #eee 1px solid; text-align: right; padding: 3px 0;">{{ $cuota->importe_por_cobrar }}</td>
													</tr>
													@endforeach
													<tr>
														<td style="border-top: #eee 1px solid; padding: 3px 0;">
															&nbsp;
														</td>
														<td style="border-top: #eee 1px solid; text-align: right; padding: 3px 0;"></td>
													</tr>

													<tr style="font-size: 14px;">
														<td style="border-top: 2px solid #333; border-bottom: 2px solid #333; font-weight: 700;" class="alignright" width="80%; padding: 5px 0;">Total Bs.</td>
														<td style="border-top: 2px solid #333; border-bottom: 2px solid #333; font-weight: 700; text-align: right; padding: 3px 0;">{{$collection->transaction->importe_credito}}</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td style="padding-top: 8px;">
												<h4>SON: {{ numeroaliteral($collection->transaction->importe_credito) }}</h4>
											</td>
										</tr>
									</table>
								</div>

								<div class="row">
									<table width="100%">

										<tr>
											<td width="20%"></td>
											<td width="20%">
												<div class="hr-line-solid" style="margin-bottom: 1px; border-top: 1px solid #A4A4A4;"></div>
                                        <span style="font-size: 10px;">Entregue conforme</span><br/>
											</td>
											<td width="20%"></td>
											<td width="20%">
												 <div class="hr-line-solid" style="margin-bottom: 1px; border-top: 1px solid #A4A4A4;"></div>
                                        <span style="font-size: 10px;">Recibí conforme<br>
											Administración</span>
											</td>
											<td width="20%"></td>
										</tr>
									</table>

								</div>
							</div>
							<div class="hr-line-dashed"></div>

							<div class="form-group">
								<div class="row">
									<div class="col-md-12">
										<button class="btn btn-success" id="printButton">
											<i class="fa fa-print"></i>&nbsp;&nbsp;Imprimir</button>
										<a href="{{ route('transaction.collection.pdf', $collection->id) }}" class="btn btn-default">
											<i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;Exportar</a>
										<button id="button-enviar" class="btn btn-default">
											<i class="fa fa-envelope-o"></i>&nbsp;&nbsp;Enviar</button>
										<span class="text-muted" style="margin: 0 10px;">|</span>
										<a href="{{ route('transaction.collection.create') }}" class="btn btn-default">
											<i class="fa fa-file-o"></i>&nbsp;&nbsp;Nueva cobranza</a>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row" id="block-enviar">
									{!! Form::open(array('route' => 'transaction.collection.send', 'class' => '', 'id' => 'form')) !!}
									<div class="col-md-6">
										{{ Form::select('contacto',['0'=>'Selecciona un contacto']+$contacts, old('contacto'), ['class' => 'form-control input-sm','id'=>'contactos']) }}
									</div>
									<input type="hidden" name="id_collection" value="{{$collection->id}}">
									<div class="col-md-6">
										<button class="btn btn-success">
											<i class="fa fa-envelope-o"></i>&nbsp;&nbsp;Enviar</button>
									</div>
									{!! Form::close() !!}
									
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
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script type="text/javascript" src="{{ URL::asset('js/jquery.PrintArea.js') }}"></script>
<script>
	$(document).ready(function () {
		
		$("#printButton").click(function () {
			var mode = 'iframe'; //popup
			var close = mode == "popup";
			var options = {mode: mode, popClose: close};
			$("#printableArea").printArea(options);
		});
		$("#block-enviar").hide();
		$("#button-enviar").click(function() {
			$("#block-enviar").show("slow");
		  });
	});
</script>
@endsection