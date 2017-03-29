@extends('layouts.admin')

@section('admin-content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Ver aviso de cobranza</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.home') }}">Inicio</a>
            </li>
            <li>
                Transacciones
            </li>
            <li>
                <a href="{{ route('transaction.accountsreceivable.send') }}">Avisos de cobranza</a>
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
            <div class="ibox float-e-margins" id="printableArea">
				@foreach($sendalertpayments as $sendalertpayment)
                <div class="ibox-content p-xl">
                    <div class="row">
                        <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td style="border: 0;">
                                        <div class="p-h-xl"><img src="{{ URL::asset(Auth::user()->company->logotipo) }}" width="200"></div>
                                    </td>
                                    <td style="border: 0; vertical-align:bottom">
                                        <div class="p-h-xl text-right">
                                            <h2 style="line-height: 0;">AVISO DE COBRANZA</h2>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>

                    <div class="row" style="padding: 0 0 10px 0;">
                        <div class="col-sm-3">
                        </div>
                        <div class="col-sm-6">
                            <div class="hr-line-solid"></div>
                        </div>
                        <div class="col-sm-3">
                        </div>
                    </div>

                    <div class="row">
                        <table style="margin: 10px auto; text-align: left; width: 80%; font-size: 14px;">
                            <tr>
                                <td>
                                    <div class="row" style="padding: 0 0 30px 0;">
                                        <div class="col-sm-6">
                                            Propiedad:&nbsp;&nbsp;<span><strong>{{ $sendalertpayment->property->nro }}</strong></span>
                                        </div>
                                        <div class="col-sm-6 text-right">
                                            Al periodo:&nbsp;&nbsp;<span><strong>

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
                                        </div>
                                    </div>                                    
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
										@for ($i = 0; $i < count($categorias); $i++)
                                        <tr>
                                            <td style="border-top: #999 1px solid; padding: 5px 0;">{{ $categorias[$i] }}: {{ $nombrecuotas[$i] }} - {{ $periodos[$i] }}/{{ $gestiones[$i] }}</td>
                                            <td style="border-top: #999 1px solid; text-align: right; padding: 5px 0;">{{money_format('%i', $importes[$i] ) }}</td>
                                        </tr>
										@endfor

                                        <tr style="font-size: 16px;">
                                            <td style="border-top: 2px solid #333; border-bottom: 2px solid #333; font-weight: 700;" class="alignright" width="80%; padding: 5px 0;">Total</td>
                                            <td style="border-top: 2px solid #333; border-bottom: 2px solid #333; font-weight: 700; text-align: right; padding: 5px 0;">{{ $sendalertpayment->importe_total }}</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="row" style="padding: 10px 0;">
                        <div class="col-sm-3">
                        </div>
                        <div class="col-sm-6">
                            <div class="hr-line-solid"></div>
                        </div>
                        <div class="col-sm-3">
                        </div>
                    </div>

                    <table style="margin: auto; text-align: left; width: 80%; font-size: 11px;">
                        <tr>
                            <td>
                                <address style="color: #9ba3a9;">
                                    <?php echo Auth::user()->company->forma_pago?>
                                </address>
                            </td>
                        </tr>
                    </table>

                    <?php
                        if ($sendalertpayment->nota <> '') { ?>

                            <div class="row" style="padding: 0;">
                                <div class="col-sm-3">
                                </div>
                                <div class="col-sm-6">
                                    <div class="hr-line-solid"></div>
                                </div>
                                <div class="col-sm-3">
                                </div>
                            </div>
                    <?php
                          }
                    ?>

                    <table style="margin: auto; text-align: left; width: 80%; font-size: 11px;">
                        <tr>
                            <td>
                                <?php
                                if ($sendalertpayment->nota <> '') { ?>
                                
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

                                <?php
                                    }
                                ?>

                            </td>
                        </tr>
                    </table>

                    <div class="row" style="padding: 10px 0;">
                        <div class="col-sm-3">
                        </div>
                        <div class="col-sm-6">
                            <div class="hr-line-solid"></div>
                        </div>
                        <div class="col-sm-3">
                        </div>
                    </div>

                    <table width="100%">
                        <tr>
                            <td style="text-align: center;">Consultas o comentarios: <a href="mailto:{{ Auth::user()->email }}">{{ Auth::user()->email }}</a>
                            </td>
                        </tr>
                    </table>

                </div>
				<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
				@endforeach
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
