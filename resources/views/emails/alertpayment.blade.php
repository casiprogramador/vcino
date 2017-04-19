@extends('layouts.app')

@section('content')


<div class="row">
    <div class="col-lg-12">
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="ibox float-e-margins">
                <div class="ibox-content p-xl" id="printableArea">
                    <div class="row">
                        <table style="margin: 0 auto; width: 90%; padding-top: 10px;">
                            <tbody>
                                <tr>
                                    <td style="border: 0; width: 50%; padding-right: 20px;">
                                        <div class="p-h-xl"><img src="{{ URL::asset(Auth::user()->company->logotipo) }}" width="{{Auth::user()->company->width_logo}}"></div>
                                    </td>
                                    <td style="border: 0; vertical-align:bottom;">
                                        <div class="p-h-xl text-right">
                                            <h3 style="line-height: 16px; text-align: right;">AVISO DE COBRANZA</h3>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="row">
                        <table style="margin: 10px auto; text-align: left; width: 90%; font-size: 14px;">
                            <tr>
                                <td>
                                    <div class="row" style="padding: 10px 0 20px 0;">
                                        <div class="col-sm-6">
                                            Propiedad:&nbsp;&nbsp;<span><strong>{{ $sendalertpayment->property->nro }}</strong></span>
                                        </div>
                                        <div class="col-sm-6">
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
                                        <tr>
                                            <td style="border-top: 0px solid #333; border-bottom: 2px solid #333; font-weight: 500;" class="alignright" width="80%; padding: 5px 0;">Cuota(s)</td>
                                            <td style="border-top: 0px solid #333; border-bottom: 2px solid #333; font-weight: 500; text-align: right; padding: 3px 0;">Importe</td>
                                        </tr>

										@for ($i = 0; $i < count($categorias); $i++)
                                        <tr>
                                            <td style="border-top: #eee 1px solid; padding: 5px 0;">{{ $nombrecuotas[$i] }} - 
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
                                            <td style="border-top: #eee 1px solid; text-align: right; padding: 5px 0;">{{money_format('%i', $importes[$i] ) }}</td>
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

                    <table style="margin: auto; text-align: left; width: 90%; font-size: 11px;">
                        <tr>
                            <td>
                                <address style="color: #9ba3a9;">
                                    <?php echo $formapago?>
                                </address>

                                @if($sendalertpayment->nota<>'')
                                    <address style="color: #9ba3a9;">
                                        <strong>Nota: </strong>
                                        <p>{{ $sendalertpayment->nota }}</p>
                                    </address>
                                @endif
                            </td>
                        </tr>
                    </table>

                </div>
            </div>

        </div>
    </div>
</div>


@endsection
