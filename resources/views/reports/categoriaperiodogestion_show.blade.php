@extends('layouts.admin')

@section('admin-content')
<div class="row wrapper border-bottom white-bg page-heading migaspan sec-volver">
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
                            <button type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Imprimir reporte" data-original-title="Imprimir reporte" onClick="window.print()">
                                <i class="fa fa-print"></i>&nbsp;&nbsp;Imprimir...
                            </button>
                            <a href="{{ route('report.categoriaperiodogestion.excel',$gestion) }}" type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Exportar reporte a Excel" data-original-title="Exportar reporte a Excel">
                                <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Exportar...
                            </a>
                        </div>
                    </div>
                </div>

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
                                        <h2 style="line-height: 18px; font-size: 19px;">Categorías por periodo y gestión</h2>
                                        <p style="font-size: 10px;">Gestión: <span id="gestion">{{$gestion}}</span> - Moneda: Bolivianos</p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>

                <div class="ibox-content ibox-heading sec-volver" style="background-color: #ECF7FE">
                    <h3><i class="fa fa-bar-chart">&nbsp;&nbsp;</i>Categorías por periodo y gestión</h3>
                    <small style="padding-left:40px;">Gestión: <span id="gestion">{{$gestion}}</span> - Moneda: Bolivianos</small>
                </div>

                <div class="ibox-content reporte-impresion">

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive" style="margin-top: 20px;">
                                <table class="table table-hover table-striped" style="font-size: 11px;">
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
                                            <td style="text-align:right;">{{ $categorias[$i][1] > 0 ? number_format($categorias[$i][1], 2, ',', '.') : " - " }}</td>
                                            <td style="text-align:right;">{{ $categorias[$i][2] > 0 ? number_format($categorias[$i][1], 2, ',', '.') : " - " }}</td>
                                            <td style="text-align:right;">{{ $categorias[$i][3] > 0 ? number_format($categorias[$i][1], 2, ',', '.') : " - " }}</td>
                                            <td style="text-align:right;">{{ $categorias[$i][4] > 0 ? number_format($categorias[$i][1], 2, ',', '.') : " - " }}</td>
                                            <td style="text-align:right;">{{ $categorias[$i][5] > 0 ? number_format($categorias[$i][1], 2, ',', '.') : " - " }}</td>
                                            <td style="text-align:right;">{{ $categorias[$i][6] > 0 ? number_format($categorias[$i][1], 2, ',', '.') : " - " }}</td>
                                            <td style="text-align:right;">{{ $categorias[$i][7] > 0 ? number_format($categorias[$i][1], 2, ',', '.') : " - " }}</td>
                                            <td style="text-align:right;">{{ $categorias[$i][8] > 0 ? number_format($categorias[$i][1], 2, ',', '.') : " - " }}</td>
                                            <td style="text-align:right;">{{ $categorias[$i][9] > 0 ? number_format($categorias[$i][1], 2, ',', '.') : " - " }}</td>
                                            <td style="text-align:right;">{{ $categorias[$i][10] > 0 ? number_format($categorias[$i][1], 2, ',', '.') : " - " }}</td>
                                            <td style="text-align:right;">{{ $categorias[$i][11] > 0 ? number_format($categorias[$i][1], 2, ',', '.') : " - " }}</td>
                                            <td style="text-align:right;">{{ $categorias[$i][12] > 0 ? number_format($categorias[$i][1], 2, ',', '.') : " - " }}</td>
                                            <td style="text-align:right;">{{ $categorias[$i][13] > 0 ? number_format($categorias[$i][1], 2, ',', '.') : " - " }}</td>
                                        </tr>
										@else
                                        <tr>
                                            <td><strong>{{$categorias[$i][0]}}</strong></td>
                                            <td style="text-align:right;" id="ene_total" suma="{{$categorias[$i][1]}}"><strong>{{number_format($categorias[$i][1], 2, ',', '.')}}</strong></td>
                                            <td style="text-align:right;" id="feb_total" suma="{{$categorias[$i][2]}}"><strong>{{number_format($categorias[$i][2], 2, ',', '.')}}</strong></td>
                                            <td style="text-align:right;" id="mar_total" suma="{{$categorias[$i][3]}}"><strong>{{number_format($categorias[$i][3], 2, ',', '.')}}</strong></td>
                                            <td style="text-align:right;" id="abr_total" suma="{{$categorias[$i][4]}}"><strong>{{number_format($categorias[$i][4], 2, ',', '.')}}</strong></td>
                                            <td style="text-align:right;" id="may_total" suma="{{$categorias[$i][5]}}"><strong>{{number_format($categorias[$i][5], 2, ',', '.')}}</strong></td>
                                            <td style="text-align:right;" id="jun_total" suma="{{$categorias[$i][6]}}"><strong>{{number_format($categorias[$i][6], 2, ',', '.')}}</strong></td>
                                            <td style="text-align:right;" id="jul_total" suma="{{$categorias[$i][7]}}"><strong>{{number_format($categorias[$i][7], 2, ',', '.')}}</strong></td>
                                            <td style="text-align:right;" id="ago_total" suma="{{$categorias[$i][8]}}"><strong>{{number_format($categorias[$i][8], 2, ',', '.')}}</strong></td>
                                            <td style="text-align:right;" id="sep_total" suma="{{$categorias[$i][9]}}"><strong>{{number_format($categorias[$i][9], 2, ',', '.')}}</strong></td>
                                            <td style="text-align:right;" id="oct_total" suma="{{$categorias[$i][10]}}"><strong>{{number_format($categorias[$i][10], 2, ',', '.')}}</strong></td>
                                            <td style="text-align:right;" id="nov_total" suma="{{$categorias[$i][11]}}"><strong>{{number_format($categorias[$i][11], 2, ',', '.')}}</strong></td>
                                            <td style="text-align:right;" id="dic_total" suma="{{$categorias[$i][12]}}"><strong>{{number_format($categorias[$i][12], 2, ',', '.')}}</strong></td>
                                            <td style="text-align:right;" id="sum_total" suma="{{$categorias[$i][13]}}"><strong>{{number_format($categorias[$i][13], 2, ',', '.')}}</strong></td>
                                        </tr>
										@endif
                                        @endfor
                                    </tbody>
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <div class="hr-line-dashed"></div>

                    <div class="pagebreak"></div>

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
                                            <h2 style="line-height: 18px; font-size: 19px;">Categorías por periodo y gestión</h2>
                                            <p style="font-size: 10px;">Gestión: <span id="gestion">{{$gestion}}</span> - Moneda: Bolivianos</p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>

                    <div class="row" style="padding-top: 20px;">
                        <div class="col-sm-8">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>Categorías por periodo - Gestión: {{$gestion}}</h5>
                                </div>
                                <div class="ibox-content reporte-impresion">
                                    <div>
                                        <canvas id="barChart" height="140">No Soportado</canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                        </div>
                    </div>

                    <div class="row sec-volver">
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


@section('style')
    <link rel="stylesheet" href="{{ URL::asset('css/varios.css') }}" media="print"/>
    <link rel="stylesheet" href="{{ URL::asset('css/horizontal.css') }}" media="print"/>
@endsection

@section('javascript')
<script type="text/javascript" src="{{ URL::asset('js/jquery.PrintArea.js') }}"></script>
<script src="{{ URL::asset('js/Chart.min.js') }}"></script>
<script>
$(document).ready(function(){
	ene = $('#ene_total').attr('suma');
	feb = $('#feb_total').attr('suma');
	mar = $('#mar_total').attr('suma');
	abr = $('#abr_total').attr('suma');
	may = $('#may_total').attr('suma');
	jun = $('#jun_total').attr('suma');
	jul = $('#jul_total').attr('suma');
	ago = $('#ago_total').attr('suma');
	sep = $('#sep_total').attr('suma');
	oct = $('#oct_total').attr('suma');
	nov = $('#nov_total').attr('suma');
	dic = $('#dic_total').attr('suma');
	
	gestion = $('#gestion').text();

var barData = {
        labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
		datasets: [
            {
                label: "Gestión "+gestion,
                backgroundColor: "#90AABF",
                borderColor: "#90AABF",
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
    Chart.defaults.global.legend.display = false;
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
