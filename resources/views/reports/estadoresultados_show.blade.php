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
                                        <th>Ingresos</th>
                                        <th style="text-align:right;">Porcentaje</th>
                                        <th style="text-align:right;">Importe</th>
                                    </tr>
                                </thead>

                                <tbody>
									@for ($i = 0; $i < count($categorias_ingreso); $i++)
                                    <tr>
                                        <td>{{$categorias_ingreso[$i]['nombre']}}</td>
                                        <td style="text-align:right;">{{number_format($categorias_ingreso[$i]['monto']/$importe_total_ingreso*100,2)."%"}}</td>
                                        <td style="text-align:right;">{{money_format('%i', $categorias_ingreso[$i]['monto'])}}</td>
                                    </tr>
									@endfor
                                </tbody>
                                <tfoot>
                                    <th>Total</th>
                                    <th style="text-align:right;">100%</th>
                                    <th style="text-align:right;">{{money_format('%i', $importe_total_ingreso)}}</th>
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
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td colspan="3"><strong>Fijos</strong></td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left: 30px;">Administración</td>
                                        <td style="text-align:right;">10,07%</td>
                                        <td style="text-align:right;">7.000,00</td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left: 30px;">Mantenimiento de jardín y áreas verdes</td>
                                        <td style="text-align:right;">24,46%</td>
                                        <td style="text-align:right;">17.000,00</td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left: 30px;">Mantenimiento piscina</td>
                                        <td style="text-align:right;">3,81%</td>
                                        <td style="text-align:right;">2.650,00</td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left: 30px;">Material de escritorio</td>
                                        <td style="text-align:right;">0,18%</td>
                                        <td style="text-align:right;">123,00</td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left: 30px;">Refrigerios</td>
                                        <td style="text-align:right;">0,08%</td>
                                        <td style="text-align:right;">55,00</td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left: 30px;">Servicio de agua potable</td>
                                        <td style="text-align:right;">2,71%</td>
                                        <td style="text-align:right;">1.882,92</td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left: 30px;">Servicio de energia eléctrica</td>
                                        <td style="text-align:right;">2,48%</td>
                                        <td style="text-align:right;">1.726,20</td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left: 30px;">Servicio de recojo de basura y reciclaje</td>
                                        <td style="text-align:right;">6,55%</td>
                                        <td style="text-align:right;">4.550,00</td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left: 30px;">Servicio de teléfono fijo/ móvil</td>
                                        <td style="text-align:right;">0,20%</td>
                                        <td style="text-align:right;">140,00</td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left: 30px;">Servicio de vigilancia y seguridad</td>
                                        <td style="text-align:right;">43,74%</td>
                                        <td style="text-align:right;">30.400,00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" style="background-color: #E7E7E7;"><b>Variables</b></td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left: 30px;">Mantenimiento y reparación</td>
                                        <td style="text-align:right;">5,11%</td>
                                        <td style="text-align:right;">3.550,00</td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left: 30px;">Obras varias</td>
                                        <td style="text-align:right;">0,62%</td>
                                        <td style="text-align:right;">430,00</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <th>Total</th>
                                    <th style="text-align:right;">100,00%</th>
                                    <th style="text-align:right;">69.507,12</th>
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
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>Ingresos</td>
                                        <td style="text-align:right;"></td>
                                        <td style="text-align:right;">70.856,23</td>
                                    </tr>
                                    <tr>
                                        <td>Gastos fijos</td>
                                        <td style="text-align:right;"></td>
                                        <td style="text-align:right;">65.527,12</td>
                                    </tr>
                                    <tr>
                                        <td>Gastos variables</td>
                                        <td style="text-align:right;"></td>
                                        <td style="text-align:right;">3.980,00</td>
                                    </tr>
                                    <tr>
                                        <td>Diferencia del periodo</td>
                                        <td style="text-align:right;"></td>
                                        
                                        <!-- Valor mayor o igual a cero (0) -->
                                        <td style="text-align:right; color: #0E9AEF">670,00</td>
                                        
                                        <!-- Valor mayor o igual a cero (0) 
                                        <td style="text-align:right; color: red">670,00</td>
                                        -->
                                    
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
                                <button class="btn btn-success" type="submit">Volver</button>
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

