@extends('layouts.admin')

@section('admin-content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Categorías por periodo y gestión</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.home') }}">Inicio</a>
            </li>
            <li>
                Reportes
            </li>
            <li class="active">
                <strong>Categorías por periodo y gestión</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Categorías por periodo y gestión</h5>
                </div>

                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-8">
                            <form role="form" class="form-horizontal">

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Gestión</label>
                                    <div class="col-sm-4">
                                        <select class="form-control input-sm" name="porgestion">
                                            <option>2016</option>
                                            <option selected>2017</option>
                                            <option>2018</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Incluir gestión anterior</label>
                                    <div class="col-sm-4">
                                        <label><input type="checkbox" class="i-checks"></label>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="col-sm-4"><h4 class="text-muted">Categorías por periodo y gestión</h4>
                            <p class="text-muted">Este reporte refleja los gastos durante una gestión por categorías mes a mes.</p>
                        </div>
                    </div>

                    <div class="row">
                    <div class="col-sm-12">
                        <div class="hr-line-dashed"></div>

                        <div class="form-group text-right">
                            <button class="btn btn-success" type="submit">Siguiente</button>
                        </div>
                    </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5 style="padding-top: 7px;">Categorías por periodo y gestión</h5>

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
                    <h3><i class="fa fa-bar-chart">&nbsp;&nbsp;</i>Categorías por periodo y gestión</h3>
                    <small style="padding-left:36px;">Gestión: 2017 - Moneda: Bolivianos</small>
                </div>

                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive" style="margin-top: 20px;">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr bgcolor="#D6D6D6">
                                            <th>Categoría</th>
                                            <th style="text-align:right;">Ene</th>
                                            <th style="text-align:right;">Feb</th>
                                            <th style="text-align:right;">Mar</th>
                                            <th style="text-align:right;">Abr</th>
                                            <th style="text-align:right;">May</th>
                                            <th style="text-align:right;">Jun</th>
                                            <th style="text-align:right;">Jul</th>
                                            <th style="text-align:right;">Ago</th>
                                            <th style="text-align:right;">Sep</th>
                                            <th style="text-align:right;">Oct</th>
                                            <th style="text-align:right;">Nov</th>
                                            <th style="text-align:right;">Dic</th>
                                            <th style="text-align:right;">Total</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>Mantenimiento ascensor</td>
                                            <td style="text-align:right;">1,600.00</td>
                                            <td style="text-align:right;">1,600.00</td>
                                            <td style="text-align:right;">1,600.00</td>
                                            <td style="text-align:right;">1,600.00</td>
                                            <td style="text-align:right;">1,600.00</td>
                                            <td style="text-align:right;">1,600.00</td>
                                            <td style="text-align:right;">1,600.00</td>
                                            <td style="text-align:right;">1,600.00</td>
                                            <td style="text-align:right;">1,600.00</td>
                                            <td style="text-align:right;">1,600.00</td>
                                            <td style="text-align:right;">1,600.00</td>
                                            <td style="text-align:right;">1,600.00</td>
                                            <td style="text-align:right;">19,200.00</td>
                                        </tr>
                                        <tr>
                                            <td>Mantenimiento general</td>
                                            <td style="text-align:right;">375.00</td>
                                            <td style="text-align:right;">0.00</td>
                                            <td style="text-align:right;">10.00</td>
                                            <td style="text-align:right;">1,350.00</td>
                                            <td style="text-align:right;">1,353.00</td>
                                            <td style="text-align:right;">3,600.00</td>
                                            <td style="text-align:right;">300.00</td>
                                            <td style="text-align:right;">630.00</td>
                                            <td style="text-align:right;">1,300.00</td>
                                            <td style="text-align:right;">0.00</td>
                                            <td style="text-align:right;">188.00</td>
                                            <td style="text-align:right;">0.00</td>
                                            <td style="text-align:right;">9,096.00</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                            <th>Total</td>
                                            <th style="text-align:right;">375.00</td>
                                            <th style="text-align:right;">0.00</td>
                                            <th style="text-align:right;">10.00</td>
                                            <th style="text-align:right;">1,350.00</td>
                                            <th style="text-align:right;">1,353.00</td>
                                            <th style="text-align:right;">3,600.00</td>
                                            <th style="text-align:right;">300.00</td>
                                            <th style="text-align:right;">630.00</td>
                                            <th style="text-align:right;">1,300.00</td>
                                            <th style="text-align:right;">0.00</td>
                                            <th style="text-align:right;">188.00</td>
                                            <th style="text-align:right;">0.00</td>
                                            <th style="text-align:right;">9,096.00</td>                                
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <div class="hr-line-dashed"></div>
                    
                    <div class="row" style="padding-top: 20px;">
                        <div class="col-sm-1">
                        </div>
                        <div class="col-sm-10">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>Gráfico de barras</h5>
                                </div>
                                <div class="ibox-content">
                                    <div>
                                        <canvas id="barChart" height="140"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-1">
                        </div>
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


@section('javascript')

<script src="js/plugins/chartJs/Chart.min.js"></script>

<script>
    
var barData = {
        labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
        datasets: [
            {
                label: "Gestión 2016",
                backgroundColor: 'rgba(26,179,148,0.5)',
                borderColor: "rgba(26,179,148,0.7)",
                pointBackgroundColor: "rgba(26,179,148,1)",
                pointBorderColor: "#fff",
                data: [38, 42, 40, 19, 66, 27, 40, 35, 55, 60, 51, 21]
            }
        ]
    };

    var barOptions = {
        responsive: true
    };

    var ctx2 = document.getElementById("barChart").getContext("2d");
    new Chart(ctx2, {type: 'bar', data: barData, options:barOptions});

</script>
@endsection


@endsection
@section('javascript')
<script>
	$('.date-picker').datetimepicker({
		format: 'DD/MM/YYYY'
	});
</script>
@endsection


