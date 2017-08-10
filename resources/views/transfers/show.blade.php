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
                <a id="direccion-lista" href="{{ route('transaction.transfer.index') }}">Transacciones</a>
            </li>
            <li class="active">
                <strong>Ver traspaso</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">

    @if (Session::has('message'))
    <div class="alert alert-success alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        Transacción registrada correctamente.
    </div>
    @endif

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                 <div class="ibox-title">
                    <h5 style="padding-top: 2px;">Ver traspaso</h5>
                </div>
                <div class="ibox-content">
                    <div id="form" class="wizard-big" style="margin-top: 20px;"> 
					<div id="printableArea">		
                        <div class="row">
                            <div class="table-responsive">
                            <table class="table" style="width: 90%; margin: auto; margin-bottom: 10px;">
                                <tbody>
                                    <tr>
                                        <td style="border: 0; padding-left: 0;">
                                            <div class="p-h-xl"><img src="{{ URL::asset(Auth::user()->company->logotipo)}}" width="{{Auth::user()->company->width_logo}}"></div>
                                        </td>
                                        <td style="border: 0; vertical-align:bottom">
                                            <div class="p-h-xl text-right">
                                                <h2 style="line-height: 0;">COMPROBANTE TRASPASO</h2>
                                                <h3 style="line-height: 0; padding-top: 20px;">N&#186;&nbsp;<span>{{ str_pad($transfer->transactionOrigin->nro_documento, 6, "0", STR_PAD_LEFT)}}</span></h3>
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
                            <div class="col-sm-6" style="width: 50%; margin: auto;">
                                <div class="hr-line-solid"></div>
                            </div>
                            <div class="col-sm-3">
                            </div>
                        </div>

                        <div class="row">
                            <table style="margin: 10px auto; text-align: left; width: 90%; font-size: 13px;">
                                <tr>
                                    <td style="padding: 0 0 20px 0; line-height: 20px;">
                                        <table cellpadding="0" cellspacing="0" style="width: 100%;">
                                            <tr>
                                                <td style="width: 100px;">Fecha:</td>
                                                <td>{{ date_format(date_create($transfer->transactionOrigin->fecha_pago),'d/m/Y') }}</td>
                                            </tr>
                                            <tr>
                                                <td>Beneficiario:</td>
                                                <td><span style="text-transform: uppercase;"><strong>{{Auth::user()->company->nombre}}</strong></span></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <table cellpadding="0" cellspacing="0" style="width: 100%;">
                                            <tr>
                                                <td style="border-top: 0px solid #333; border-bottom: 2px solid #333; font-weight: 500;" class="alignright" width="80%; padding: 5px 0;">Detalles</td>
                                                <td style="border-top: 0px solid #333; border-bottom: 2px solid #333; font-weight: 500; text-align: right; padding: 3px 0;">Total</td>
                                            </tr>
                                            <tr>
                                                <td style="border-top: #333 1px solid; padding: 3px 0;" colspan="2">
                                                    Concepto: {{$transfer->transactionOrigin->concepto}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="border-top: #eee 1px solid; padding: 3px 0;" colspan="2">
                                                    &nbsp;
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="border-top: #eee 1px solid; padding: 3px 0;" colspan="2">
                                                    Cuenta origen: {{$transfer->accountOrigin->nombre}} ({{$transfer->accountOrigin->tipo_cuenta}})
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="border-top: #eee 1px solid; padding: 3px 0;" colspan="2">
                                                    Cuenta destino: {{$transfer->accountDestiny->nombre}} ({{$transfer->accountDestiny->tipo_cuenta}})
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="border-top: #eee 1px solid; padding: 3px 0;" colspan="2">
                                                    &nbsp;
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="border-top: #eee 1px solid; padding: 3px 0;" colspan="2">
                                                    Modo de traspaso: {{ucfirst($transfer->transactionOrigin->forma_pago)}} 
                                                    @if ( $transfer->transactionOrigin->numero_forma_pago <> '')
                                                        No. {{$transfer->transactionOrigin->numero_forma_pago}}
                                                    @endif
                                                </td>
                                            </tr>
    										@if(!empty($transfer->transactionOrigin->notas))
                                            <tr>
                                                <td style="border-top: #eee 1px solid; padding: 3px 0;" colspan="2">
                                                    &nbsp;
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="border-top: #eee 1px solid; padding: 3px 0;" colspan="2">
                                                    Nota: {{$transfer->transactionOrigin->notas }}
                                                </td>
                                            </tr>
    										@endif
                                            <tr style="font-size: 14px;">
                                                <td style="border-top: 2px solid #333; border-bottom: 2px solid #333; font-weight: 700;" class="alignright" width="80%; padding: 5px 0;">Total Bs.</td>
                                                <td style="border-top: 2px solid #333; border-bottom: 2px solid #333; font-weight: 700; text-align: right; padding: 3px 0;">{{ number_format($transfer->transactionOrigin->importe_debito, 2, '.', '.') }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-top: 8px;">
                                    <h4>SON: {{ numeroaliteral($transfer->transactionOrigin->importe_debito) }}</h4>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="row">
                            <table width="100%">
                                <tr>
                                    <td width="15%"></td>
                                    <td width="25%">
                                        <div class="hr-line-solid" style="margin-bottom: 1px; border-top: 1px solid #A4A4A4;"></div>
                                        <span style="font-size: 10px;">Vo. Bo. Tesorero<br/>&nbsp;</span>
                                    </td>
                                    <td width="20%"></td>
                                    <td width="25%">
                                        <div class="hr-line-solid" style="margin-bottom: 1px; border-top: 1px solid #A4A4A4;"></div>
                                        <span style="font-size: 10px;">Interesado<br/>&nbsp;</span>
                                    </td>
                                    <td width="15%"></td>
                                </tr>
                            </table>
                        </div>
					</div>
                    
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <button class="btn btn-success" id="printButton">
									<i class="fa fa-print"></i>&nbsp;&nbsp;Imprimir</button>
                                <span class="text-muted" style="margin: 0 10px;">|</span>
                                <a href="{{ route('transaction.transfer.create') }}" class="btn btn-default">
									<i class="fa fa-file-o"></i>&nbsp;&nbsp;Nuevo traspaso</a>
                            </div>
                        </div>
                    </div>

                    @if(!empty($transfer->adjunto))
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{ URL::asset($transfer->adjunto)}}" target="_blank">
                                        <img src="{{ URL::asset($transfer->adjunto)}}" width="300px">
                                    </a>                            
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="hr-line-dashed"></div>

                    {!! Form::open(array('route' => 'transaction.cancel', 'class' => '', 'id' => 'form-anular')) !!}
						<input type="hidden" name="id_transaction" value="{{$transfer->transactionOrigin->id}}">
						<input type="hidden" name="id_transaction_destino" value="{{$transfer->transactionDestiny->id}}">
						<div class="form-group">
							<div class="row">
								<div class="col-sm-12">
									<button class="btn btn-danger" type="submit" onclick="return confirm('¿Está seguro de anular el registro?')">
									<i class="fa fa-trash"></i>&nbsp;&nbsp;Anular...</button>
								</div>
							</div>
						</div>
					{!! Form::close() !!}
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
	});
</script>
@endsection

