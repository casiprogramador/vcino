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
                    <h5 style="padding-top: 7px;">Categorías por periodo y gestión</h5>

                    <div class="ibox-tools" style="padding-bottom: 7px;">
                        <div class="btn-group">
                            <button type="button" id="printButton" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Imprimir reporte" data-original-title="Imprimir reporte">
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
                    <small style="padding-left:36px;">Gestión: <span id="gestion">{{$gestion}}</span> - Moneda: Bolivianos</small>
                </div>

                <div class="ibox-content">
					<div id="printableArea">
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
										@for ($i = 0; $i < count($categorias); $i++)
										@if($categorias[$i][0] != 'Total')
                                        <tr>
                                            <td>{{$categorias[$i][0]}}</td>
                                            <td style="text-align:right;">{{$categorias[$i][1]}}</td>
                                            <td style="text-align:right;">{{$categorias[$i][2]}}</td>
                                            <td style="text-align:right;">{{$categorias[$i][3]}}</td>
                                            <td style="text-align:right;">{{$categorias[$i][4]}}</td>
                                            <td style="text-align:right;">{{$categorias[$i][5]}}</td>
                                            <td style="text-align:right;">{{$categorias[$i][6]}}</td>
                                            <td style="text-align:right;">{{$categorias[$i][7]}}</td>
                                            <td style="text-align:right;">{{$categorias[$i][8]}}</td>
                                            <td style="text-align:right;">{{$categorias[$i][9]}}</td>
                                            <td style="text-align:right;">{{$categorias[$i][10]}}</td>
                                            <td style="text-align:right;">{{$categorias[$i][11]}}</td>
                                            <td style="text-align:right;">{{$categorias[$i][12]}}</td>
                                            <td style="text-align:right;">{{$categorias[$i][13]}}</td>
                                        </tr>
										@else
										<tr>
                                            <td><strong>{{$categorias[$i][0]}}</strong></td>
                                            <td style="text-align:right;" id="ene_total"><strong>{{$categorias[$i][1]}}</strong></td>
                                            <td style="text-align:right;" id="feb_total"><strong>{{$categorias[$i][2]}}</strong></td>
                                            <td style="text-align:right;" id="mar_total"><strong>{{$categorias[$i][3]}}</strong></td>
                                            <td style="text-align:right;" id="abr_total"><strong>{{$categorias[$i][4]}}</strong></td>
                                            <td style="text-align:right;" id="may_total"><strong>{{$categorias[$i][5]}}</strong></td>
                                            <td style="text-align:right;" id="jun_total"><strong>{{$categorias[$i][6]}}</strong></td>
                                            <td style="text-align:right;" id="jul_total"><strong>{{$categorias[$i][7]}}</strong></td>
                                            <td style="text-align:right;" id="ago_total"><strong>{{$categorias[$i][8]}}</strong></td>
                                            <td style="text-align:right;" id="sep_total"><strong>{{$categorias[$i][9]}}</strong></td>
                                            <td style="text-align:right;" id="oct_total"><strong>{{$categorias[$i][10]}}</strong></td>
                                            <td style="text-align:right;" id="nov_total"><strong>{{$categorias[$i][11]}}</strong></td>
                                            <td style="text-align:right;" id="dic_total"><strong>{{$categorias[$i][12]}}</strong></td>
                                            <td style="text-align:right;" id="ene_total"><strong>{{$categorias[$i][13]}}</strong></td>
                                        </tr>
										@endif
                                        @endfor
                                    </tbody>
                                    
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
					</div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="hr-line-dashed"></div>

                            <div class="form-group text-left">
                                <a href="{{ route('report.reportcategoriaperiodogestion') }}" class="btn btn-success">Volver</a>
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
<script type="text/javascript" src="{{ URL::asset('js/jquery.PrintArea.js') }}"></script>
<script src="{{ URL::asset('js/Chart.min.js') }}"></script>
<script>
$(document).ready(function(){
	ene = $('#ene_total').text();
	feb = $('#feb_total').text();
	mar = $('#mar_total').text();
	abr = $('#abr_total').text();
	may = $('#may_total').text();
	jun = $('#jun_total').text();
	jul = $('#jul_total').text();
	ago = $('#ago_total').text();
	sep = $('#sep_total').text();
	oct = $('#oct_total').text();
	nov = $('#nov_total').text();
	dic = $('#dic_total').text();
	
	gestion = $('#gestion').text();

var barData = {
        labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
		datasets: [
            {
                label: "Gestión "+gestion,
                backgroundColor: 'rgba(26,179,148,0.5)',
                borderColor: "rgba(26,179,148,0.7)",
                pointBackgroundColor: "rgba(26,179,148,1)",
                pointBorderColor: "#fff",
                data: [ene, feb, mar, abr, may, jun, jul, ago, sep, oct, nov, dic]
            }
        ]
    };

    var barOptions = {
        responsive: true
    };

    var ctx2 = document.getElementById("barChart").getContext("2d");
    new Chart(ctx2, {type: 'bar', data: barData, options:barOptions});
	
	$("#printButton").click(function () {
			var mode = 'iframe'; //popup
			var close = mode == "popup";
			var options = {mode: mode, popClose: close};
			$("#printableArea").printArea(options);
	});
});
</script>
@endsection
