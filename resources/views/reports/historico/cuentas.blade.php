@extends('layouts.admin')

@section('admin-content')
<div class="row wrapper border-bottom white-bg page-heading migaspan">
    <div class="col-lg-10">
        <h2>Histórico de transacciones</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.home') }}">Inicio</a>
            </li>
            <li>
                Reportes
            </li>
            <li class="active">
                <strong>Histórico de transacciones</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">


    <!--	**********************	-->
    <!--			CUENTAS 		-->
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5 style="padding-top: 7px;">Histórico de transacciones</h5>

                    <div class="ibox-tools" style="padding-bottom: 7px;">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-default" id="printButton" data-toggle="tooltip" data-placement="bottom" title="Imprimir reporte" data-original-title="Imprimir reporte">
                                <i class="fa fa-print"></i>&nbsp;&nbsp;Imprimir...
                            </button>
                            <a href="{{ route('report.historicotransacciones.cuentas.excel', $mes.'_'.$anio.'_'.$cuenta->id.'_'.$fecha_ini.'_'.$fecha_fin) }}" type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Exportar reporte a Excel" data-original-title="Exportar reporte a Excel">
                                <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Exportar...
                            </a>
                        </div>
                    </div>
                </div>

                <div class="ibox-content ibox-heading" style="background-color: #ECF7FE">
                    <h3><i class="fa fa-table">&nbsp;&nbsp;</i>Histórico de transacciones - Cuentas</h3>
                    @if($mes != 0)
                    <small style="padding-left:36px;">Periodo: {{nombremes($mes)}}/{{$anio}} - Moneda: Bolivianos</small>
                    @elseif($anio != 0)
                    <small style="padding-left:36px;">Gestión: {{$anio}} - Moneda: Bolivianos</small>
                    @else
                    <small style="padding-left:36px;">Desde: {{ date("d/m/Y", strtotime($fecha_ini)) }} al {{ date("d/m/Y", strtotime($fecha_fin)) }} - Moneda: Bolivianos</small>
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
                                                <h2 style="line-height: 18px; font-size: 19px;">Histórico de transacciones - Cuentas</h2>
                                                @if($mes != 0)
                                                <p style="font-size: 10px;">Periodo: {{nombremes($mes)}}/{{$anio}} - Moneda: Bolivianos</p>
                                                @elseif($anio != 0)
                                                <p style="font-size: 10px;">Gestión: {{$anio}} - Moneda: Bolivianos</p>
                                                @else
                                                <p style="font-size: 10px;">Desde: {{ date("d/m/Y", strtotime($fecha_ini)) }} al {{ date("d/m/Y", strtotime($fecha_fin)) }} - Moneda: Bolivianos</p>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            </div>
                        </div>

                        <div class="col-sm-12">

                        	<div class="row">
    	                    	<div class="col-sm-12">
    	                    		<h3>Cuenta: {{$cuenta->nombre}}</h3>
    	                    	</div>
    	                    </div>

                            <div class="table-responsive" style="margin-top: 20px;">
                                <table class="table table-hover table-striped texto-impresion tabla-compress">
                                    <thead>
                                        <tr bgcolor="#D6D6D6">
                                            <th style="vertical-align:bottom">Fecha</th>
                                            <th style="vertical-align:bottom">Documento</th>
                                            <th style="vertical-align:bottom">Concepto</th>
                                            <th style="vertical-align:bottom">Forma de pago</th>
                                            <th style="text-align:right; vertical-align:bottom">Ingreso</th>
                                            <th style="text-align:right; vertical-align:bottom">Egreso</th>
                                        </tr>
                                    </thead>

                                    <tbody>
    									@for ($i = 0; $i < count($transactions); $i++)
    									<tr>
    										<td>{{$transactions[$i][0]}}</td>
    										<td>{{$transactions[$i][1]}}</td>
    										<td>{{$transactions[$i][2]}}</td>
    										<td>{{ucfirst($transactions[$i][3])}} {{$transactions[$i][4]}}</td>
    										<td style="text-align:right;">{{ number_format($transactions[$i][5], 2, ',', '.') }}</td>
    										<td style="text-align:right;">{{ number_format($transactions[$i][6], 2, ',', '.') }}</td>
    									</tr>
    									@endfor
                                    </tbody>
    									
                                    <tfoot>
    									<th colspan="4">Totales</th>
    									<th style="text-align:right;">{{ number_format($ingreso_total, 2, ',', '.') }}</th>
    									<th style="text-align:right;">{{ number_format($egreso_total, 2, ',', '.') }}</th>
                                    </tfoot>
                                </table>
                            </div>

                        </div>
                        </div>

                    <div class="row sec-volver">
                        <div class="col-sm-12">
                            <div class="hr-line-dashed"></div>

                            <div class="form-group text-left">
                               <a href="{{ route('report.historicotransacciones') }}" class="btn btn-success" type="submit">Volver</a>
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

