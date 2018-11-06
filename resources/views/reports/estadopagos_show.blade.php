@extends('layouts.admin')

@section('admin-content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Cobranzas por estado</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.home') }}">Inicio</a>
            </li>
            <li>
                Reportes
            </li>
            <li class="active">
                <strong>Cobranzas por estado</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5 style="padding-top: 7px;">Cobranzas por estado</h5>

                    <div class="ibox-tools" style="padding-bottom: 7px;">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-default" id="printButton" data-toggle="tooltip" data-placement="bottom" title="Imprimir reporte" data-original-title="Imprimir reporte">
                                <i class="fa fa-print"></i>&nbsp;&nbsp;Imprimir...
                            </button>
                        </div>
                    </div>
                </div>

                <div class="ibox-content ibox-heading" style="background-color: #ECF7FE">
                    <h3><i class="fa fa-table">&nbsp;&nbsp;</i>Cobranzas por estado</h3>
                    @if($mes != 0)
                    <small style="padding-left:36px;">Periodo: {{nombremes($mes)}}/{{$anio}} - Moneda: Bolivianos</small>
                    @else
                    <small style="padding-left:36px;">Gestión: {{$anio}} - Moneda: Bolivianos</small>
                    @endif
                </div>

                <div class="ibox-content">
                    <div id="printableArea">

                        <!-- Título del Reportes    -->
                        <div class="titreporte" style="display: none;">
                            <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td style="border: 0;">
                                            <div class="p-h-xl"><img src="{{ URL::asset(Auth::user()->company->logotipo) }}" width="{{Auth::user()->company->width_logo}}"></div>
                                        </td>
                                        <td style="border: 0; vertical-align:bottom">
                                            <div class="p-h-xl text-right">
                                                <h2 style="line-height: 18px; font-size: 19px;">Cobranzas por estado</h2>
                                                @if($mes != 0)
                                                <p style="font-size: 10px;">Periodo: {{nombremes($mes)}}/{{$anio}} - Moneda: Bolivianos</p>
                                                @else
                                                <p style="font-size: 10px;">Gestión: {{$anio}} - Moneda: Bolivianos</p>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            </div>
                        </div>


                        <div class="col-sm-1">
                        </div>
                        <div class="col-sm-10">
                            <div class="table-responsive" style="margin-top: 20px;">
                                <table class="table table-hover table-striped texto-impresion">
                                    <thead>
                                        <tr bgcolor="#D6D6D6">
                                            <th>Estado</th>
                                            <th style="text-align:right;" width="15%">Porcentaje</th>
                                            <th style="text-align:right;" width="15%">Importe</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>Vigentes</td>
											<td style="text-align:right;" width="15%">{{ number_format(100*($estado_pagos[1][1]/$estado_pagos[0][1]), 2, ',', '.') }}%</td>
											<td style="text-align:right;" width="15%">{{ number_format($estado_pagos[1][1], 2, ',', '.') }}</td>
                                        </tr>
									     <tr>
                                            <td>Vencidas/ Mora</td>
											<td style="text-align:right;" width="15%">{{ number_format(100*($estado_pagos[2][1]/$estado_pagos[0][1]), 2, ',', '.') }}%</td>
											<td style="text-align:right;" width="15%">{{ number_format($estado_pagos[2][1], 2, ',', '.') }}</td>
                                        </tr>
									     <tr>
                                            <td>Adelantadas</td>
											<td style="text-align:right;" width="15%">{{ number_format(100*($estado_pagos[3][1]/$estado_pagos[0][1]), 2, ',', '.') }}%</td>
											<td style="text-align:right;" width="15%">{{ number_format($estado_pagos[3][1], 2, ',', '.') }}</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <th>Total</th>
										<th style="text-align:right;">100,00%</th>
                                        <th style="text-align:right;">{{ number_format($estado_pagos[0][1], 2, ',', '.') }}</th>
                                    </tfoot>
                                </table>
                            </div>

                    </div>
                  </div>
                    <div class="col-sm-1">
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="hr-line-dashed"></div>

                            <div class="form-group text-left">
                                <a href="{{ route('report.estadopagos') }}" class="btn btn-success" type="submit">Volver</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

@endsection


@section('style')
    <link rel="stylesheet" href="{{ URL::asset('css/varios.css') }}" media="print"/>
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
