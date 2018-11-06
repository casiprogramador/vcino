@extends('layouts.admin')

@section('admin-content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Estado de Resultados</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.home') }}">Inicio</a>
            </li>
            <li>
                Reportes
            </li>
            <li class="active">
                <strong>Estado de Resultados</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5 style="padding-top: 7px;">Estado de Resultados</h5>

                    <div class="ibox-tools" style="padding-bottom: 7px;">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-default" id="printButton" data-toggle="tooltip" data-placement="bottom" title="Imprimir reporte" data-original-title="Imprimir reporte">
                                <i class="fa fa-print"></i>&nbsp;&nbsp;Imprimir...
                            </button>
                            <a href="{{ route('report.estadoresultados.excel', $opcion) }}" type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Exportar reporte a Excel" data-original-title="Exportar reporte a Excel">
                                <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Exportar...
                            </a>
                        </div>
                    </div>
                </div>

                <div class="ibox-content ibox-heading" style="background-color: #ECF7FE">
                    <h3><i class="fa fa-table">&nbsp;&nbsp;</i>Estado de Resultados</h3>
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
                                                <h2 style="line-height: 18px; font-size: 19px;">Estado de Resultados</h2>
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
                                            <th>Ingresos</th>
                                            <th style="text-align:right;" width="15%">Porcentaje</th>
                                            <th style="text-align:right;" width="15%">Importe</th>
                                        </tr>
                                    </thead>

                                    <tbody>
    									@for ($i = 0; $i < count($categorias_ingreso); $i++)
                                        <tr>
                                            <td>{{$categorias_ingreso[$i]['nombre']}}</td>
                                            @if($importe_total_ingreso != 0)
                                            <td style="text-align:right;">{{ number_format($categorias_ingreso[$i]['monto']/$importe_total_ingreso*100, 2, ',', '.')."%" }}</td>
                                            @else
                                            <td style="text-align:right;">{{"0,00%"}}</td>
                                            @endif
                                            <td style="text-align:right;">{{ number_format($categorias_ingreso[$i]['monto'], 2, ',', '.') }}</td>
                                        </tr>
    									@endfor
                                    </tbody>
                                    <tfoot>
                                        <th>Total</th>
    									@if($importe_total_ingreso != 0)
                                        <th style="text-align:right;">100,00%</th>
    									@else
    									<th style="text-align:right;">0,00%</th>
    									@endif
                                        <th style="text-align:right;">{{ number_format($importe_total_ingreso, 2, ',', '.') }}</th>
                                    </tfoot>
                                </table>
                            </div>


                            <!--    EGRESOS                 -->
                            <div class="table-responsive" style="margin-top: 20px;">
                                <table class="table table-hover table-striped texto-impresion">
                                    <thead>
                                        <tr bgcolor="#D6D6D6">
                                            <th>Gastos</th>
                                            <th style="text-align:right;" width="15%">Porcentaje</th>
                                            <th style="text-align:right;" width="15%">Importe</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td colspan="3" style="background-color: #E7E7E7;"><strong>Ordinarios</strong></td>
                                        </tr>
                                        @for ($i = 0; $i < count($categorias_egreso_ordinario); $i++)
                                        <tr>
                                            <td>{{$categorias_egreso_ordinario[$i]['nombre']}}</td>
                                            @if($importe_total_egreso != 0)
                                                <td style="text-align:right;">{{number_format($categorias_egreso_ordinario[$i]['monto']/$importe_total_egreso*100, 2, ',', '.')."%"}}</td>
                                            @else
                                                <td style="text-align:right;">{{"0,00%"}}</td>
                                            @endif
                                            <td style="text-align:right;">{{ number_format($categorias_egreso_ordinario[$i]['monto'], 2, ',', '.') }}</td>
                                        </tr>
    									@endfor
                                        <tr>
                                            <td colspan="3" style="background-color: #E7E7E7;"><strong>Extraordinarios</strong></td>
                                        </tr>
                                        @for ($i = 0; $i < count($categorias_egreso_extraordinario); $i++)
                                        <tr>
                                            <td>{{$categorias_egreso_extraordinario[$i]['nombre']}}</td>
                                            @if($importe_total_egreso != 0)
                                            <td style="text-align:right;">{{number_format($categorias_egreso_extraordinario[$i]['monto']/$importe_total_egreso*100, 2, ',', '.')."%"}}</td>
                                            @else
                                            <td style="text-align:right;">{{"0,00%"}}</td>
                                            @endif

                                            <td style="text-align:right;">{{ number_format($categorias_egreso_extraordinario[$i]['monto'], 2, ',', '.') }}</td>
                                        </tr>
    									 @endfor
                                    </tbody>
                                    <tfoot>
                                        <th>Total</th>
                                        @if($importe_total_egreso != 0)
                                        <th style="text-align:right;">100,00%</th>
    									@else
    									<th style="text-align:right;">0,00%</th>
    									@endif
                                        <th style="text-align:right;">{{ number_format($importe_total_egreso, 2, ',', '.') }}</th>
                                    </tfoot>
                                </table>
                            </div>

                            <!--    RESULTADO DEL PERIODO           -->
                            <div class="table-responsive" style="margin-top: 20px;">
                                <table class="table table-hover table-striped texto-impresion">
                                    <thead>
                                        <tr bgcolor="#D6D6D6">
                                            <th>Resultado</th>
                                            <th style="text-align:right;" width="15%"></th>
                                            <th style="text-align:right;" width="15%">Importe</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>Ingresos</td>
                                            <td style="text-align:right;"></td>
                                            <td style="text-align:right;">{{ number_format($importe_total_ingreso, 2, ',', '.') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Gastos ordinarios</td>
                                            <td style="text-align:right;"></td>
                                            <td style="text-align:right;">{{ number_format($importe_total_egreso_ordinario, 2, ',', '.') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Gastos extraordinarios</td>
                                            <td style="text-align:right;"></td>
                                            <td style="text-align:right;">{{ number_format($importe_total_egreso_extraordinario, 2, ',', '.') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Diferencia del periodo</td>
                                            <td style="text-align:right;"></td>

                                            <!-- Valor mayor o igual a cero (0) -->
    										@if(($importe_total_ingreso-$importe_total_egreso)>= 0)
                                            <td style="text-align:right; color: #0E9AEF">{{ number_format($importe_total_ingreso-$importe_total_egreso, 2, ',', '.') }}</td>
    										@else
    										<td style="text-align:right; color: red">{{ number_format($importe_total_ingreso-$importe_total_egreso, 2, ',', '.') }}</td>
    										@endif

                                        </tr>
                                    </tbody>
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
                                <a href="{{ route('report.estadoresultados') }}" class="btn btn-success" type="submit">Volver</a>
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
