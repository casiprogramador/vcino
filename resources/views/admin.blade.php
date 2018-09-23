@extends('layouts.admin')

@section('admin-content')

<div class="wrapper wrapper-content">

    <!--
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-success alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <p>Texto aquí</p>
            </div>
        </div>
    </div>
    -->

    <div class="row">

        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="pull-right"></span>
                    <h5><i class="fa fa-user" aria-hidden="true">&nbsp;&nbsp;</i>Cuotas por cobrar</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-6">
                            <h2 class="no-margins">{{ $cuotas_cobrar_box['mes_cobrar'] }}</h2>
                            <div class="text-navy" style="color: #1A7CC0;"><small>{{ nombremes($mes_actual) }}</small></div>
                        </div>
                        <div class="col-md-6">
                            <h2 class="no-margins">{{ $cuotas_cobrar_box['total_cobrar'] }}</h2>
                            <div class="text-navy" style="color: #1A7CC0;"><small>Total acumulado</small></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="pull-right"></span>
                    <h5><i class="fa fa-plus-circle" aria-hidden="true">&nbsp;&nbsp;</i>Ingresos</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-6">
                            <h2 class="no-margins">{{ $ingresos_box['mes_actual_ingreso'] }}</h2>
                            <div class="text-navy" style="color: #1A7CC0;"><small>{{ nombremes($mes_actual) }}  (A la fecha)</small></div>
                        </div>
                        <div class="col-md-6">
                            <h2 class="no-margins">{{ $ingresos_box['mes_anterior_ingreso'] }}</h2>
                            <div class="text-navy" style="color: #1A7CC0;"><small>{{ nombremes($mes_anterior) }} </small></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="pull-right"></span>
                    <h5><i class="fa fa-minus-circle" aria-hidden="true">&nbsp;&nbsp;</i>Gastos</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-6">
                            <h2 class="no-margins">{{ $gastos_box['mes_actual_gastos'] }}</h2>
                            <div class="text-navy" style="color: #e88b51;"><small>{{ nombremes($mes_actual) }} (A la fecha)</small></div>
                        </div>
                        <div class="col-md-6">
                            <h2 class="no-margins">{{ $gastos_box['mes_anterior_gastos'] }}</h2>
                            <div class="text-navy" style="color: #e88b51;"><small>{{ nombremes($mes_anterior) }}</small></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Cobranza correspondiente a: {{ nombremes($mes_actual) }} <small>(Comparativo mes anterior)</small></h5>
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
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Gastos: {{nombremes(date('m'))}}</h5>
                        </div>
                        <div class="ibox-content">
                            @if (($gastos_torta_nombre <> '[]') && ($gastos_torta_importe <> '[]'))
                            <div>
                                <canvas id="doughnutChart" height="120"></canvas>
								<input  id ="nombres-gastos-torta" type="hidden" value="{{$gastos_torta_nombre}}">
								<input  id ="importes-gastos-torta" type="hidden" value="{{$gastos_torta_importe}}">
								<input  id ="colores-gastos-torta" type="hidden" value="{{$gastos_torta_color}}">
                            </div>
                            @else
                                <p>No se encontraron gastos para el mes de <b>{{ strtolower(nombremes(date('m'))) }}</b>.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                
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
                    <h5>Solicitudes & tareas</h5>
                    <div class="ibox-tools">
                        <!--
                        <span class="label label-success pull-right">2 Mensajes nuevos</span>
                        -->
                       </div>
                </div>
                <div class="ibox-content">
                    <div>
                        @if ( $tasks_count > 0 )
                        <div class="feed-activity-list">
							@foreach($tasks as $task)
                            <div class="feed-element">
                                <p class="pull-left">
                                    <a href="{{ route('taskrequest.task.show', Crypt::encrypt($task->id)) }}" >
                                    @if($task->tipo_tarea == 'mis_tareas')
                                        <img alt="Sol." src="img/system/mt.png" class="img-circle" title="Mis tareas">

                                    @elseif($task->tipo_tarea =='solicitudes_recibidas')
                                        <img alt="Sol." src="img/system/sga.png" class="img-circle" title="Solicitudes recibidas">

                                    @elseif($task->tipo_tarea =='reserva_instalaciones')
                                        <img alt="Sol." src="img/system/sri.png" class="img-circle" title="Reserva de instalaciones">

                                    @elseif($task->tipo_tarea =='reclamos')
                                        <img alt="Sol." src="img/system/re.png" class="img-circle" title="Reclamos">

                                    @elseif($task->tipo_tarea =='sugerencias')
                                        <img alt="Sol." src="img/system/su.png" class="img-circle" title="Sugerencias">

                                    @elseif($task->tipo_tarea =='notificacion_mudanza')
                                        <img alt="Sol." src="img/system/nm.png" class="img-circle" title="Notificación de mudanza">

                                    @elseif($task->tipo_tarea =='notificacion_trabajos')
                                        <img alt="Sol." src="img/system/nmc.png" class="img-circle" title="Notificación de trabajos">

                                    @endif
                                </a>
                                </p>
                                <div class="media-body">
                                    <small class="pull-right">{{ date_format(date_create($task->fecha),'d/m/Y') }}</small>
                                    
                                    <a href="{{ route('taskrequest.task.show', Crypt::encrypt($task->id)) }}" style="font-size: 14px;" >{{ $task->titulo_tarea }}</a>
                                    <br>
                                
                                    <!--
                                    @if($task->estado_solicitud == 'pendiente')
                                       <i style="color: #F7B77B;" class="fa fa-circle" aria-hidden="true"></i>
                                    @else
                                        <i style="color: #5D96CC;" class="fa fa-circle" aria-hidden="true"></i>
                                    @endif
                                    -->

                                    <small class="text-muted">
                                    @if($task->tipo_tarea == 'mis_tareas')
                                        MIS TAREAS

    								@elseif($task->tipo_tarea =='solicitudes_recibidas')
    									SOLICITUDES RECIBIDAS

    								@elseif($task->tipo_tarea =='reserva_instalaciones')
    									RESERVA DE INSTALACION

    								@elseif($task->tipo_tarea =='reclamos')
    									RECLAMOS

    								@elseif($task->tipo_tarea =='sugerencias')
    									SUGERENCIAS

    								@elseif($task->tipo_tarea =='notificacion_mudanza')
    									NOTIFICACION DE MUDANZA

    								@elseif($task->tipo_tarea =='notificacion_trabajos')
    									NOTIFICACION DE TRABAJO

    								@endif
                                    </small>

                                    <!--
                                    <div class="actions">
                                        <a href="{{ route('taskrequest.task.show', Crypt::encrypt($task->id)) }}" class="btn btn-xs btn-white">Ver solicitud</a>
                                    </div>
                                    -->
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <a href="{{ route('taskrequest.task.index')}}" class="btn btn-success btn-block m-t">
                        <i class="fa fa-list"></i>&nbsp;&nbsp;&nbsp;Ver todas</a>
                        @else
                            <p>No se encontraron solicitudes o tareas pendientes.</p>

                            <a href="{{ route('taskrequest.task.create') }}" class="btn btn-default btn-block m-t">
                            <i class="fa fa-list"></i>&nbsp;&nbsp;&nbsp;Nueva tarea</a>
                        @endif
                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Planes de mantenimiento</h5>
                </div>
                <div class="ibox-content">
                    @if ( $maintenances_count > 0 )
                    <div class="feed-activity-list">
                        @foreach($maintenances as $maintenance)
                        <div class="feed-element">
                            <p class="no-margins" style="font-size: 14px;">{{ $maintenance->equipment->equipo }}</p>
                            <small class="text-muted">FECHA ESTIMADA: {{ date_format(date_create($maintenance->fecha_estimada),'d/m/Y') }}</small>
                            <div class="stat-percent">
                                @if(diffdays($maintenance->fecha_estimada) >= 0)
                                    <span class="badge" style="font-size: 10px; font-weight: normal; font-family: Tahoma, Geneva;">{{diffdays($maintenance->fecha_estimada)}} d.</span>
                                @else
                                    <span class="badge" style="background-color: #E06F27; font-size: 10px; font-weight: normal; color: white; font-family: Tahoma, Geneva;">{{diffdays($maintenance->fecha_estimada)}} d.</span>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <a href="{{ route('equipment.maintenanceplan.index') }}" class="btn btn-success btn-block m-t"><i class="fa fa-list"></i>&nbsp;&nbsp;&nbsp;Ver todos</a>
                    @else
                        <p>No se encontraron planes de mantenimiento.</p>
                        <p>Los planes de mantenimiento permiten organizar adecuadamente la realización de mantenimiento preventivo a cada uno de los equipos con los que cuenta el condominio.</p>

                        <a href="{{ route('equipment.maintenanceplan.create') }}" class="btn btn-default btn-block m-t"><i class="fa fa-list"></i>&nbsp;&nbsp;&nbsp;Nuevo plan de mantenimiento</a>
                    @endif
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
                backgroundColor: 'rgba(144, 191 , 225, 0.6)',
                borderColor: 'rgba(144, 191 , 225, 0)',
                data: mes_cobranza_anterior
            },
            {
                label: nombre_mes_actual,
                backgroundColor: 'rgba(224, 111, 39, 0.6)',
                borderColor: "rgba(224, 111, 39, 0)",
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
    //console.log(nombres_gastos_torta.length);
	//console.log(importes_gastos_torta.length);

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
            display: true,
            position: 'right'
        },
    };

    var ctx4 = document.getElementById("doughnutChart").getContext("2d");
    new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions});

});

</script>
@endsection

