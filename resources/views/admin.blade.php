@extends('layouts.admin')

@section('admin-content')

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Cobranzas: Noviembre <small>(Comparativo mes anterior)</small></h5>
                </div>
                <div class="ibox-content">
                    <div>
                        <canvas id="barChart" height="60"></canvas>
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
                            <h5>Gastos: Noviembre</h5>
                        </div>
                        <div class="ibox-content">
                            <div>
                                <canvas id="doughnutChart" height="250"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Ingresos: Noviembre</h5>
                        </div>
                        <div class="ibox-content">
                            <p><br></p>
                            <ul class="stat-list">
                                <li>
                                    <h2 class="no-margins">14.450</h2>
                                    <small>Total cobranzas mes actual</small>
                                    <div class="stat-percent">48%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: 48%;" class="progress-bar"></div>
                                    </div>
                                </li>
                                <li>
                                    <h2 class="no-margins ">21.550</h2>
                                    <small>Total cobranzas mes anterior</small>
                                    <div class="stat-percent">89%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: 89%;" class="progress-bar progress-bar-2"></div>
                                    </div>
                                </li>
                                <li>
                                    <h2 class="no-margins ">20.780</h2>
                                    <small>Promedio cobranzas mensuales</small>
                                    <div class="stat-percent">85%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: 85%;" class="progress-bar progress-bar-2"></div>
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
                                        <tr>
                                            <td>20/10/2016</td>
                                            <td>321</td>
                                            <td>Ingreso</td>
                                            <td>Caoba 13</td>
                                            <td>Pago de expensas</td>
                                            <td class="text-right">700,00</td>
                                        </tr>
                                        <tr>
                                            <td>19/10/2016</td>
                                            <td>124</td>
                                            <td>Egreso</td>
                                            <td>Caoba 13</td>
                                            <td>Pago de expensas</td>
                                            <td class="text-right">700,00</td>
                                        </tr>
                                        <tr>
                                            <td>18/10/2016</td>
                                            <td>320</td>
                                            <td>Ingreso</td>
                                            <td>MZ 8 LT 12</td>
                                            <td>Pago de expensas</td>
                                            <td class="text-right">651,00</td>
                                        </tr>
                                        <tr>
                                            <td>20/10/2016</td>
                                            <td>123</td>
                                            <td>Egreso</td>
                                            <td>OTAN SECURITY</td>
                                            <td>Pago servicios mes de septiembre</td>
                                            <td class="text-right">8.000,00</td>
                                        </tr>
                                        <tr>
                                            <td>20/10/2016</td>
                                            <td>12</td>
                                            <td>Traspaso</td>
                                            <td></td>
                                            <td>Traspaso de fondos a caja chica en Bs.</td>
                                            <td class="text-right">3.000,00</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <button class="btn btn-default btn-block m-t"><i class="fa fa-list"></i>&nbsp;&nbsp;&nbsp;Ver todas las transacciones</button>
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
    var barData = {
        labels: ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31"],
        datasets: [
            {
                label: "Octubre",
                backgroundColor: 'rgba(74, 181 , 255, 0.5)',
                borderColor: 'rgba(74, 181 , 255, 0)',
                data: [65, 59, 80, 81, 56, 55, 40, 59, 80, 81, 56, 55, 40, 59, 40, 19, 86, 27, 75, 80, 81, 56, 55, 40, 59, 80, 81, 56, 55, 21, 22]
            },
            {
                label: "Noviembre",
                backgroundColor: 'rgba(63, 73, 94, 0.4)',
                borderColor: "rgba(63, 73, 94, 0)",
                data: [31, 35, 33, 19, 86, 86, 27, 88, 59, 80, 81, 56, 55, 40]
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
    var doughnutData = {
        labels: ["Administración","Mantenimiento ascensor","Mantenimiento general", "Mantenimiento piscina", "Materiales e insumos varios", "Servicio de agua potable y alcantarillado común", "Servicio de energia eléctrica", "Servicio de limpieza", "Servicio de mantenimiento jardín y áreas verdes", "Servicio de TV Cable", "Servicio de vigilancia y seguridad", "Obras y reparaciones" ],
        datasets: [{
            data: [3500,1600,1300,700,920,310.43,1809.50,3600,950,198,8000,1312.53],
            //backgroundColor: ["#B8BBC2","#8C8E92","#3C507E","#D8DAE1","#DADCE1"]
            //backgroundColor: ["#ACDBFE","#B1B16F","#6691B1","#FEC7C6","#CACB75"]
            //backgroundColor: ["#3287C8","#C88C32","#134E7B","#59B7FF","#7B4D06"]
            //backgroundColor: ["#ACDBFE","#FEDDAC","#6691B1","#C6E7FF","#B18C55"]
            //backgroundColor: ["#ACDBFE","#ACDBFE","#81A4BE","#566D7E","#2A363F"]
            backgroundColor: ["#ACDAFE", "#90AABF", "#3876A5", "#C1E4FF", "#D1EBFF", "#FFE9A7", "#BFB38E", "#A68A36", "#FFEEBD", "#FFF3CF", "#FFC0A7", "#BF9C8E", "#A65636", "#FFD0BD", "#FFDCCF"]

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

