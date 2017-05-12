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
                            <button type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Imprimir reporte" data-original-title="Imprimir reporte">
                                <i class="fa fa-print"></i>&nbsp;&nbsp;Imprimir...
                            </button>
                            <button type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Exportar reporte a Excel" data-original-title="Exportar reporte a Excel">
                                <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Exportar...
                            </button>
                        </div>
                    </div>
                </div>

                <div class="ibox-content ibox-heading" style="background-color: #ECF7FE">
                    <h3><i class="fa fa-table">&nbsp;&nbsp;</i>Estado de Resultados</h3>
                    <small style="padding-left:36px;">Periodo: Marzo/2017 - Moneda: Bolivianos</small>
                </div>

                <div class="ibox-content">
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm-10">
                        <div class="table-responsive" style="margin-top: 20px;">
                            <table class="table table-hover table-striped">
                                <thead>
									<tr bgcolor="#D6D6D6">
                                        <th></th>
                                        <th style="text-align:right;" colspan="2">ANTERIOR</th>
                                        <th style="text-align:right;" colspan="2">ACTUAL</th>

                                    </tr>
                                    <tr bgcolor="#D6D6D6">
                                        <th>Ingresos</th>
                                        <th style="text-align:right;">Porcentaje</th>
                                        <th style="text-align:right;">Importe</th>
										<th style="text-align:right;">Porcentaje</th>
                                        <th style="text-align:right;">Importe</th>
                                    </tr>
                                </thead>

                                <tbody>
									@for ($i = 0; $i < count($categorias_ingreso); $i++)
                                    <tr>
                                        <td>{{$categorias_ingreso[$i]['nombre']}}</td>
										@if($anterior_importe_total_ingreso != 0)
                                        <td style="text-align:right;">{{number_format($anterior_categorias_ingreso[$i]['monto']/$anterior_importe_total_ingreso*100,2)."%"}}</td>
                                        @else
                                        <td style="text-align:right;">{{"0%"}}</td>
                                        @endif

                                        <td style="text-align:right;">{{money_format('%i', $anterior_categorias_ingreso[$i]['monto'])}}</td>
										
										@if($importe_total_ingreso != 0)
                                        <td style="text-align:right;">{{number_format($categorias_ingreso[$i]['monto']/$importe_total_ingreso*100,2)."%"}}</td>
                                        @else
                                        <td style="text-align:right;">{{"0%"}}</td>
                                        @endif
										
                                        <td style="text-align:right;">{{money_format('%i', $categorias_ingreso[$i]['monto'])}}</td>
                                    </tr>
									@endfor
                                </tbody>
                                <tfoot>
                                    <th>Total</th>
									<th style="text-align:right;">100%</th>
                                    <th style="text-align:right;">{{$anterior_importe_total_ingreso}}</th>
                                    <th style="text-align:right;">100%</th>
                                    <th style="text-align:right;">{{$importe_total_ingreso}}</th>
                                </tfoot>
                            </table>
                        </div>


                        <!--    EGRESOS                 -->
                        <div class="table-responsive" style="margin-top: 20px;">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr bgcolor="#D6D6D6">
                                        <th>Gastos</th>
										<th style="text-align:right;">Porcentaje</th>
                                        <th style="text-align:right;">Importe</th>
                                        <th style="text-align:right;">Porcentaje</th>
                                        <th style="text-align:right;">Importe</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td colspan="5"><strong>Fijos</strong></td>
                                    </tr>
                                    @for ($i = 0; $i < count($categorias_egreso_ordinario); $i++)
                                    <tr>
                                        <td>{{$categorias_egreso_ordinario[$i]['nombre']}}</td>
										@if($anterior_importe_total_egreso != 0)
                                        <td style="text-align:right;">{{number_format($anterior_categorias_egreso_ordinario[$i]['monto']/$anterior_importe_total_egreso*100,2)."%"}}</td>
                                        @else
                                        <td style="text-align:right;">{{"0%"}}</td>
                                        @endif
                                        <td style="text-align:right;">{{$anterior_categorias_egreso_ordinario[$i]['monto']}}</td>
										
                                        @if($importe_total_egreso != 0)
                                        <td style="text-align:right;">{{number_format($categorias_egreso_ordinario[$i]['monto']/$importe_total_egreso*100,2)."%"}}</td>
                                        @else
                                        <td style="text-align:right;">{{"0%"}}</td>
                                        @endif
                                        <td style="text-align:right;">{{$categorias_egreso_ordinario[$i]['monto']}}</td>
                                    </tr>
									@endfor
                                    <tr>
                                        <td colspan="5" style="background-color: #E7E7E7;"><b>Variables</b></td>
                                    </tr>
                                    @for ($i = 0; $i < count($categorias_egreso_extraordinario); $i++)
                                    <tr>
                                        <td>{{$categorias_egreso_extraordinario[$i]['nombre']}}</td>
										@if($anterior_importe_total_egreso != 0)
                                        <td style="text-align:right;">{{number_format($anterior_categorias_egreso_extraordinario[$i]['monto']/$anterior_importe_total_egreso*100,2)."%"}}</td>
                                        @else
                                        <td style="text-align:right;">{{"0%"}}</td>
                                        @endif
                                        <td style="text-align:right;">{{$anterior_categorias_egreso_extraordinario[$i]['monto']}}</td>
										
                                        @if($importe_total_egreso != 0)
                                        <td style="text-align:right;">{{number_format($categorias_egreso_extraordinario[$i]['monto']/$importe_total_egreso*100,2)."%"}}</td>
                                        @else
                                        <td style="text-align:right;">{{"0%"}}</td>
                                        @endif
                                        <td style="text-align:right;">{{$categorias_egreso_extraordinario[$i]['monto']}}</td>
                                    </tr>
									@endfor
                                </tbody>
                                <tfoot>
                                    <th>Total</th>
									<th style="text-align:right;">100.00%</th>
                                    <th style="text-align:right;">{{$anterior_importe_total_egreso}}</th>
                                    <th style="text-align:right;">100.00%</th>
                                    <th style="text-align:right;">{{$importe_total_egreso}}</th>
                                </tfoot>
                            </table>
                        </div>

                        <!--    RESULTADO DEL PERIODO           -->
                        <div class="table-responsive" style="margin-top: 20px;">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr bgcolor="#D6D6D6">
                                        <th>Resultado</th>
                                        <th style="text-align:right;"></th>
                                        <th style="text-align:right;">Importe</th>
										<th style="text-align:right;"></th>
                                        <th style="text-align:right;">Importe</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>Ingresos</td>
										<td style="text-align:right;"></td>
                                        <td style="text-align:right;">{{$anterior_importe_total_ingreso}}</td>
                                        <td style="text-align:right;"></td>
                                        <td style="text-align:right;">{{$importe_total_ingreso}}</td>
                                    </tr>
                                    <tr>
                                        <td>Gastos fijos</td>
										<td style="text-align:right;"></td>
                                        <td style="text-align:right;">{{$anterior_importe_total_egreso_ordinario}}</td>
                                        <td style="text-align:right;"></td>
                                        <td style="text-align:right;">{{$importe_total_egreso_ordinario}}</td>
                                    </tr>
                                    <tr>
                                        <td>Gastos variables</td>
										<td style="text-align:right;"></td>
                                        <td style="text-align:right;">{{$anterior_importe_total_egreso_extraordinario}}</td>
                                        <td style="text-align:right;"></td>
                                        <td style="text-align:right;">{{$importe_total_egreso_extraordinario}}</td>
                                    </tr>
                                    <tr>
                                        <td>Diferencia del periodo</td>
										<td style="text-align:right;"></td>

                                        <td style="text-align:right; color: #0E9AEF">{{$anterior_importe_total_ingreso-$anterior_importe_total_egreso}}</td>
                                        <td style="text-align:right;"></td>

                                        <td style="text-align:right; color: #0E9AEF">{{$importe_total_ingreso-$importe_total_egreso}}</td>

                                    </tr>
                                </tbody>
                            </table>
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
@section('javascript')
<script>
	$('.date-picker').datetimepicker({
		format: 'DD/MM/YYYY'
	});
</script>
@endsection
