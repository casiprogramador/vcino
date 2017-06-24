@extends('layouts.admin')

@section('admin-content')

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Cobranzas: {{nombremes($mes_actual)}} <small>(Comparativo mes anterior)</small></h5>
                </div>
                <div class="ibox-content">
                    <div>
                        <canvas id="barChart" height="60"></canvas>
						<input  id ="cobranzas-mes-actual" type="hidden" value="{{$cobranzas_mes_actual}}"> 
						<input  id ="cobranzas-mes-anterior" type="hidden" value="{{$cobranza_mes_anterior}}">
						<input  id ="nombre-mes-actual" type="hidden" value="{{nombremes($mes_actual)}}"> 
						<input  id ="nombre-mes-anterior" type="hidden" value="{{nombremes($mes_anterior)}}"> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="row">
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Gastos: {{nombremes($mes_actual)}}</h5>
                        </div>
                        <div class="ibox-content">
                            <div>
                                <canvas id="doughnutChart" height="250"></canvas>
								<input  id ="nombres-gastos-torta" type="hidden" value="{{$gastos_torta_nombre}}"> 
								<input  id ="importes-gastos-torta" type="hidden" value="{{$gastos_torta_importe}}">
								<input  id ="colores-gastos-torta" type="hidden" value="{{$gastos_torta_color}}"> 
	
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Ingresos: {{nombremes($mes_actual)}} </h5>
                        </div>
                        <div class="ibox-content">
                            <p><br></p>
                            <ul class="stat-list">
                                <li>
                                    <h2 class="no-margins">{{$importe_pagado_actual}}</h2>
                                    <small>Total cobranzas mes actual</small>
                                    <div class="stat-percent">{{number_format ($importe_pagado_actual/$importe_pagado_total*100,2)}}%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: {{$importe_pagado_actual/$importe_pagado_total}}%;" class="progress-bar"></div>
                                    </div>
                                </li>
                                <li>
                                    <h2 class="no-margins ">{{$importe_pagado_anterior}}</h2>
                                    <small>Total cobranzas mes anterior</small>
                                    <div class="stat-percent">{{number_format ( $importe_pagado_anterior/$importe_pagado_total_anterior*100,2)}}%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: {{number_format ( $importe_pagado_anterior/$importe_pagado_total_anterior*100,0)}}%;" class="progress-bar progress-bar-2"></div>
                                    </div>
                                </li>
                                <li>
                                    <h2 class="no-margins ">{{number_format ($importe_pagado_promedio,2)}}</h2>
                                    <small>Promedio cobranzas mensuales</small>
                                    <div class="stat-percent">{{number_format ( ($importe_pagado_promedio/$importe_pagado_promedio_total*100),2)}}%</div>
									
                                    <div class="progress progress-mini">
                                        <div style="width: {{number_format ( ($importe_pagado_promedio/$importe_pagado_promedio_total*100),0)}}%;" class="progress-bar progress-bar-2"></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Ejecución Presupuestaria: Noviembre</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="vertical-align:bottom">Categoría</th>
                                            <th style="vertical-align:bottom" class="text-right">Presupuestado</th>
                                            <th style="vertical-align:bottom" class="text-right">Ejecutado</th>
                                            <th style="vertical-align:bottom" class="text-right">Diferencia</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Administración</td>
                                            <td class="text-right">6.500,00</td>
                                            <td class="text-right">6.500,00</td>
                                            <td class="text-right">0,00</td>
                                        </tr>
                                        <tr>
                                            <td>Mantenimiento jardín y áreas verdes</td>
                                            <td class="text-right">12.350,00</td>
                                            <td class="text-right">12.350,00</td>
                                            <td class="text-right">0,00</td>
                                        </tr>
                                        <tr>
                                            <td>Mantenimieto maquinaria y herramienta</td>
                                            <td class="text-right">0,00</td>
                                            <td class="text-right">150,00</td>
                                            <td class="text-right text-danger">-150,00</td>
                                        </tr>
                                        <tr>
                                            <td>Mantenimiento piscina</td>
                                            <td class="text-right">2.650,00</td>
                                            <td class="text-right">0,00</td>
                                            <td class="text-right">2.650,00</td>
                                        </tr>
                                        <tr>
                                            <td>Servicio acceso Internet</td>
                                            <td class="text-right">205,00</td>
                                            <td class="text-right">205,00</td>
                                            <td class="text-right">0,00</td>
                                        </tr>
                                        <tr>
                                            <td>Servivio de energía eléctrica</td>
                                            <td class="text-right">2.000,00</td>
                                            <td class="text-right">1.650,00</td>
                                            <td class="text-right">350,00</td>
                                        </tr>
                                        <tr>
                                            <td>Servicio de vigilancia y seguridad</td>
                                            <td class="text-right">8.000,00</td>
                                            <td class="text-right">8.000,00</td>
                                            <td class="text-right">0,00</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Últimas transacciones</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="vertical-align:bottom">Fecha</th>
                                            <th style="vertical-align:bottom">Nro. Documento</th>
                                            <th style="vertical-align:bottom">Tipo</th>
                                            <th style="vertical-align:bottom">Beneficiario</th>
                                            <th style="vertical-align:bottom">Concepto</th>
                                            <th style="vertical-align:bottom" class="text-right">Importe</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										@for ($i = 0; $i < count($transacciones); $i++)
                                        <tr>
                                            <td>{{$transacciones[$i][0]}}</td>
                                            <td>{{$transacciones[$i][1]}}</td>
                                            <td>{{$transacciones[$i][2]}}</td>
                                            <td>{{$transacciones[$i][3]}}</td>
                                            <td>{{$transacciones[$i][4]}}</td>
                                            <td class="text-right">{{$transacciones[$i][5]}}</td>
                                        </tr>
										@endfor
                                    </tbody>
                                </table>
                            </div>
                            <a href="{{ route('transaction.transfer.index') }}" class="btn btn-default btn-block m-t"><i class="fa fa-list"></i>&nbsp;&nbsp;&nbsp;Ver todas las transacciones</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Solicitudes recibidas</h5>
                    <div class="ibox-tools">
                        <span class="label label-success pull-right">2 Mensajes nuevos</span>
                       </div>
                </div>
                <div class="ibox-content">
                    <div>
                        <div class="feed-activity-list">
                            <div class="feed-element">
                                <p class="pull-left">
                                    <img alt="image" src="img/system/solicitudes1.png" class="img-circle">
                                </p>
                                <div class="media-body ">
                                    <small class="pull-right">Hoy</small>
                                    <strong>Mis tareas</strong><br>
                                    Asunto de la tarea propia<br>
                                    <small class="text-muted"></small>
                                    <div class="actions">
                                        <a class="btn btn-xs btn-white">Ver solicitud</a>
                                    </div>

                                </div>
                            </div>
                            <div class="feed-element">
                                <p class="pull-left">
                                    <img alt="image" src="img/system/solicitudes1.png" class="img-circle">
                                </p>
                                <div class="media-body ">
                                    <small class="pull-right">Hoy</small>
                                    <strong>Reserva de instalaciones comunes</strong><br>
                                    Asunto de la solicitud<br>
                                    <small class="text-muted">Propiedad: Cupesi 15</small>
                                    <div class="actions">
                                        <a class="btn btn-xs btn-white">Ver solicitud</a>
                                    </div>

                                </div>
                            </div>
                            <div class="feed-element">
                                <p class="pull-left">
                                    <img alt="image" src="img/system/solicitudes1.png" class="img-circle">
                                </p>
                                <div class="media-body ">
                                    <small class="pull-right">Ayer <i class="fa fa-exclamation-circle text-danger fa-lg"></i></small>
                                    <strong>Solicitudes Administrador</strong><br>
                                    Asunto de la solicitud al administrador<br>
                                    <small class="text-muted">Propiedad: 19 PH</small>
                                    <div class="actions">
                                        <a class="btn btn-xs btn-white">Ver solicitud</a>
                                    </div>

                                </div>
                            </div>
                            <div class="feed-element">
                                <p class="pull-left">
                                    <img alt="image" src="img/system/solicitudes1.png" class="img-circle">
                                </p>
                                <div class="media-body ">
                                    <small class="pull-right">2 días <i class="fa fa-exclamation-circle text-danger fa-lg"></i></small>
                                    <strong>Reclamo</strong><br>
                                    Asunto de la solicitud<br>
                                    <small class="text-muted">Propiedad: 3 AB</small>
                                    <div class="actions">
                                        <a class="btn btn-xs btn-white">Ver solicitud</a>
                                    </div>

                                </div>
                            </div>
                            <div class="feed-element">
                                <p class="pull-left">
                                    <img alt="image" src="img/system/solicitudes1.png" class="img-circle">
                                </p>
                                <div class="media-body ">
                                    <small class="pull-right">5 días</small>
                                    <strong>Sugerencia</strong><br>
                                    Asunto del reclamo recibido<br>
                                    <small class="text-muted">Propiedad: 3 AB</small>
                                    <div class="actions">
                                        <a class="btn btn-xs btn-white">Ver solicitud</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <button class="btn btn-success btn-block m-t"><i class="fa fa-list"></i>&nbsp;&nbsp;&nbsp;Ver todas</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@section('style')
    <link rel="stylesheet" href="{{ URL::asset('css/datatables.min.css') }}" />
@endsection

@section('javascript')
<script type="text/javascript" src="{{ URL::asset('js/Chart.min.js') }}"></script>
<script>
$(function () {

    // Cobranzas
	//cobranzas-mes-actual
	nombre_mes_actual = $('#nombre-mes-actual').val();
	nombre_mes_anterior = $('#nombre-mes-anterior').val();
	mes_cobranza_actual = $('#cobranzas-mes-actual').val();
	mes_cobranza_actual = JSON.parse(mes_cobranza_actual);
	mes_cobranza_anterior = $('#cobranzas-mes-anterior').val();
	mes_cobranza_anterior = JSON.parse(mes_cobranza_anterior);
	//console.log(mes_cobranza_anterior);
    var barData = {
        labels: ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31"],
        datasets: [
            {
                label: nombre_mes_anterior,
                backgroundColor: 'rgba(74, 181 , 255, 0.5)',
                borderColor: 'rgba(74, 181 , 255, 0)',
                data: mes_cobranza_anterior
            },
            {
                label: nombre_mes_actual,
                backgroundColor: 'rgba(63, 73, 94, 0.4)',
                borderColor: "rgba(63, 73, 94, 0)",
                data: mes_cobranza_actual
            }
        ]
    };

    var barOptions = {
        responsive: true,
        legend: {
            display: true,
            position: 'bottom'
        },
        tooltips: {
            backgroundColor: 'rgba(0,0,0,0.5)'
        },
        scales: {
            xAxes: [{
                gridLines: {
                    display: false
                }
            }]
        }
    };

    var ctx2 = document.getElementById("barChart").getContext("2d");
    new Chart(ctx2, {type: 'bar', data: barData, options:barOptions});


    // Gastos mensuales 
	nombres_gastos_torta = JSON.parse($('#nombres-gastos-torta').val());
	importes_gastos_torta = JSON.parse($('#importes-gastos-torta').val());
	colores_gastos_torta = JSON.parse($('#colores-gastos-torta').val());
	//console.log(nombres_gastos_torta);
    var doughnutData = {
        labels: nombres_gastos_torta,
        datasets: [{
            data: importes_gastos_torta,
            //backgroundColor: ["#B8BBC2","#8C8E92","#3C507E","#D8DAE1","#DADCE1"]
            //backgroundColor: ["#ACDBFE","#B1B16F","#6691B1","#FEC7C6","#CACB75"]
            //backgroundColor: ["#3287C8","#C88C32","#134E7B","#59B7FF","#7B4D06"]
            //backgroundColor: ["#ACDBFE","#FEDDAC","#6691B1","#C6E7FF","#B18C55"]
            //backgroundColor: ["#ACDBFE","#ACDBFE","#81A4BE","#566D7E","#2A363F"]
            backgroundColor: colores_gastos_torta

        }]
    } ;


    var doughnutOptions = {
        responsive: true,
        legend: {
            display: false,
            position: 'bottom'
        },
    };


    var ctx4 = document.getElementById("doughnutChart").getContext("2d");
    new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions});

});

</script>
@endsection

