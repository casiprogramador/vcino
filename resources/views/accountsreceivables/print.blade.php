@extends('layouts.admin')

@section('admin-content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Avisos de cobranza</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.home') }}">Inicio</a>
            </li>
            <li>
                Transacciones
            </li>
            <li>
                <a href="{{ route('transaction.notification.send') }}">Avisos de cobranza</a>
            </li>
            <li class="active">
                <strong>Ver aviso de cobranza</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-4">
        <div class="title-action">
            <button id="printButton" class="btn btn-success">
            <i class="fa fa-print">&nbsp;&nbsp;&nbsp;</i>Imprimir aviso</button>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="ibox float-e-margins" style="border-width: 1px;">
                <div class="ibox-content p-xl" >
                <div id="printableArea" class="p-xl" style="padding-top: 0; padding-left: 10px; padding-right: 10px;">
                    <div class="row">
                        <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td style="border: 0; padding-right: 10px;">
                                        <div class="p-h-xl"><img src="{{ URL::asset(Auth::user()->company->logotipo) }}" width="{{Auth::user()->company->width_logo}}"></div>
                                    </td>
                                    <td style="border: 0; vertical-align:bottom">
                                        <div class="p-h-xl text-right">
                                            <h2 style="line-height: 18px;">AVISO DE COBRANZA</h2>
                                            <h3 style="line-height: 0; padding-top: 20px;">&nbsp;</h3>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>

                    <div class="row" style="padding: 0 0 0 0;">
						<div class="col-sm-3">
						</div>
						<div class="col-sm-6" style="width: 50%; margin: auto;">
							<div class="hr-line-solid"></div>
						</div>
						<div class="col-sm-3">
						</div>
					</div>

                    <div class="row">
                        <table style="margin: 10px auto; text-align: left; width: 90%; font-size: 14px;">
                            <tr>
								<td style="padding: 0 0 20px 0; line-height: 20px;">
									<table cellpadding="0" cellspacing="0" style="width: 100%;">
										<tr>
											<td>Propiedad:&nbsp;&nbsp;<span><strong>{{ $sendalertpayment->property->nro }}</strong></span></td>
											<td class="text-right">Al periodo:&nbsp;&nbsp;<span><strong>
												 @if($sendalertpayment->limite_periodo == 1)
													{{ 'Enero' }}
												 @elseif($sendalertpayment->limite_periodo == 2)
													{{ 'Febrero' }}
												 @elseif($sendalertpayment->limite_periodo == 3)
													{{ 'Marzo' }}
												 @elseif($sendalertpayment->limite_periodo == 4)
													{{ 'Abril' }}
												 @elseif($sendalertpayment->limite_periodo == 5)
													{{ 'Mayo' }}
												 @elseif($sendalertpayment->limite_periodo == 6)
													{{ 'Junio' }}
												 @elseif($sendalertpayment->limite_periodo == 7)
													{{ 'Julio' }}
												 @elseif($sendalertpayment->limite_periodo == 8)
													{{ 'Agosto' }}
												 @elseif($sendalertpayment->limite_periodo == 9)
													{{ 'Septiembre' }}
												 @elseif($sendalertpayment->limite_periodo == 10)
													{{ 'Octubre' }}
												 @elseif($sendalertpayment->limite_periodo == 11)
													{{ 'Noviembre' }}
												 @elseif($sendalertpayment->limite_periodo == 12)
													{{ 'Diciembre' }}
												 @endif
													{{ $sendalertpayment->limite_gestion }}</strong></span>
											</td>
										</tr>
									</table>
								</td>
                            </tr>
                            <tr>
                                <td>
									@var $categorias = explode(',',$sendalertpayment->categoria_cuotas)
									@var $nombrecuotas = explode(',',$sendalertpayment->nombre_cuotas)
									@var $periodos = explode(',',$sendalertpayment->periodos)
									@var $gestiones = explode(',',$sendalertpayment->gestiones)
									@var $importes = explode(',',$sendalertpayment->importes)
									
                                    <table cellpadding="0" cellspacing="0" style="width: 100%;">

                                        <tr>
                                            <td style="border-top: 0px solid #333; border-bottom: 2px solid #333; font-weight: 500;" class="alignright" width="80%; padding: 5px 0;">Cuota(s)</td>
                                            <td style="border-top: 0px solid #333; border-bottom: 2px solid #333; font-weight: 500; text-align: right; padding: 3px 0;">Importe</td>
                                        </tr>

										@for ($i = 0; $i < count($categorias); $i++)
                                        <tr>
                                            <td style="border-top: #D6D6D6 1px solid; padding: 5px 0;">{{ $nombrecuotas[$i] }} -
												@if($periodos[$i] == 1)
													{{ ' Enero' }}/{{ $gestiones[$i] }}
												@elseif($periodos[$i] == 2)
													{{ ' Febrero' }}/{{ $gestiones[$i] }}
												@elseif($periodos[$i] == 3)
													{{ ' Marzo' }}/{{ $gestiones[$i] }}
												@elseif($periodos[$i] == 4)
													{{ ' Abril' }}/{{ $gestiones[$i] }}
												@elseif($periodos[$i] == 5)
													{{ ' Mayo' }}/{{ $gestiones[$i] }}
												@elseif($periodos[$i] == 6)
													{{ ' Junio' }}/{{ $gestiones[$i] }}
												@elseif($periodos[$i] == 7)
													{{ ' Julio' }}/{{ $gestiones[$i] }}
												@elseif($periodos[$i] == 8)
													{{ ' Agosto' }}/{{ $gestiones[$i] }}
												@elseif($periodos[$i] == 9)
													{{ ' Septiembre' }}/{{ $gestiones[$i] }}
												@elseif($periodos[$i] == 10)
													{{ ' Octubre' }}/{{ $gestiones[$i] }}
												@elseif($periodos[$i] == 11)
													{{ ' Noviembre' }}/{{ $gestiones[$i] }}
												@elseif($periodos[$i] == 12)
													{{ ' Diciembre' }}/{{ $gestiones[$i] }}
												@endif
											</td>
                                            <td style="border-top: #D6D6D6 1px solid; text-align: right; padding: 5px 0;">{{ number_format($importes[$i], 2, '.', '.') }}</td>
                                        </tr>
										@endfor

                                        <tr style="font-size: 16px;">
                                            <td style="border-top: 2px solid #333; border-bottom: 2px solid #333; font-weight: 700;" class="alignright" width="80%; padding: 5px 0;">Total</td>
                                            <td style="border-top: 2px solid #333; border-bottom: 2px solid #333; font-weight: 700; text-align: right; padding: 5px 0;">{{ number_format($sendalertpayment->importe_total, 2, '.', '.') }}</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="row" style="padding: 10px 0;">
                        <div class="col-sm-3">
                        </div>
                        <div class="col-sm-6" style="width: 50%; margin: auto;">
                            <div class="hr-line-solid"></div>
                        </div>
                        <div class="col-sm-3">
                        </div>
                    </div>

                    <table style="margin: auto; text-align: left; width: 90%; font-size: 11px;">
                        <tr>
                            <td>
                                <address style="color: #9ba3a9;">
                                    <?php echo Auth::user()->company->forma_pago?>
                                </address>
                            </td>
                        </tr>
                    </table>

                    @if($sendalertpayment->nota<>'')
                            <div class="row" style="padding: 0;">
                                <div class="col-sm-3">
                                </div>
                                <div class="col-sm-6" style="width: 50%; margin: auto;">
                                    <div class="hr-line-solid"></div>
                                </div>
                                <div class="col-sm-3">
                                </div>
                            </div>
					@endif

                    <table style="margin: auto; text-align: left; width: 90%; font-size: 11px;">
                        <tr>
                            <td>

                                @if($sendalertpayment->nota<>'')
	                                <div class="col-lg-12">
	                                    <div class="widget style1" style="background-color: #f2f2f2;">
	                                        <div class="row vertical-align">
	                                            <div class="col-xs-1">
	                                                <i class="fa fa-bell fa-3x"></i>
	                                            </div>
	                                            <div class="col-xs-11">
	                                                <h5 class="no-margins">
	                                                    Nota: 
	                                                </h5>
	                                                <p>{{ $sendalertpayment->nota }}</p>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
								@endif

                            </td>
                        </tr>
                    </table>

					<!--
                    <table width="100%">
                        <tr>
                            <td style="text-align: center;">Consultas o comentarios: <a>{{ Auth::user()->email }}</a>
                            </td>
                        </tr>
                    </table>
					-->

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
		$("#printButton").click(function(){
			var mode = 'iframe'; //popup
			var close = mode == "popup";
			var options = { mode : mode, popClose : close};
			$("#printableArea").printArea( options );
		});
	});
</script>
@endsection