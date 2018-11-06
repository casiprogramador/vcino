@extends('layouts.admin')

@section('admin-content')
<div class="row wrapper border-bottom white-bg page-heading migaspan">
    <div class="col-lg-10">
        <h2>Cuentas por cobrar</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.home') }}">Inicio</a>
            </li>
            <li>
                Reportes
            </li>
            <li class="active">
                <strong>Cuotas por cobrar</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">

	<!--		POR PROPIEDAD 			-->
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5 style="padding-top: 7px;">Cuotas por cobrar</h5>

                    <div class="ibox-tools" style="padding-bottom: 7px;">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-default" id="printButton" data-toggle="tooltip" data-placement="bottom" title="Imprimir reporte" data-original-title="Imprimir reporte">
                                <i class="fa fa-print"></i>&nbsp;&nbsp;Imprimir...
                            </button>
                            <a href="{{ route('report.porpropiedad.categoriaperiodogestion.excel',$anio.'_'.$mes.'_'.$id_propiedad) }}" type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Exportar reporte a Excel" data-original-title="Exportar reporte a Excel">
                                <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Exportar...
                            </a>
                        </div>
                    </div>
                </div>

                <div class="ibox-content ibox-heading" style="background-color: #ECF7FE">
                    <h3><i class="fa fa-table">&nbsp;&nbsp;</i>Cuotas por cobrar - Por propiedad</h3>
                    <small style="padding-left:36px;">Fecha: {{nombremes($mes)}}/{{$anio}} - Moneda: Bolivianos</small>
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
                                                <h2 style="line-height: 18px; font-size: 19px;">Cuotas por cobrar - Por propiedad</h2>
                                                <p style="font-size: 10px;">Fecha: {{nombremes($mes)}}/{{$anio}} - Moneda: Bolivianos</p>
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
                        	<div class="row">
                                <table cellpadding="0" cellspacing="0" style="width: 100%;">
                                    <tr>
                                        <td style="padding-left: 15px"><h4>Propiedad:&nbsp;&nbsp;&nbsp;&nbsp;{{ strtoupper($propiedad) }} </h4></td>
                                        <td align="right" style="padding-right: 15px;"><small>Fecha reporte: {{date('d/m/Y')}}</small></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="padding-left: 15px"><h4>Propietario:&nbsp;&nbsp;&nbsp;{{ $propietario }}</h4></td>
                                    </tr>
                                </table>
    	                    </div>

                            <div class="table-responsive" style="margin-top: 20px;">
                                <table class="table table-hover table-striped texto-impresion tabla-compress">
                                    <thead>
                                        <tr bgcolor="#D6D6D6">
                                            <th>Cuota</th>
                                            <th>Gestión</th>
                                            <th>Periodo</th>
                                            <th style="text-align:right;">Importe</th>
                                        </tr>
                                    </thead>
                                    <tbody>
    									@for ($i = 0; $i < count($cuotas); $i++)
    									@if($cuotas[$i][0] !== 'Total')
                                        <tr>
                                            <td>{{$cuotas[$i][0]}}</td>
                                            <td>{{$cuotas[$i][1]}}</td>
                                            <td>{{nombremes( $cuotas[$i][2] )}}</td>
                                            <td style="text-align:right;">{{ number_format($cuotas[$i][3], 2, ',', '.') }}</td>
                                        </tr>
    									@endif
    									@endfor
                                    </tbody>
                                    <tfoot>
                                        <th colspan="3">Total</th>
                                        <th style="text-align:right;">{{ number_format($monto_total, 2, ',', '.') }}</th>
                                    </tfoot>
                                </table>
    
                                @if($monto_total == 0)
                                    <div class="jumbotron">
                                        <h2>Certificado</h2>
                                        <p style="font-size: 18px;">La oficina de Administración certifica que la propiedad {{ strtoupper($propiedad) }} no tiene deudas ni obligaciones pendientes.</p>
                                        <p>&nbsp;</p>
                                        <small><strong>{{ Auth::user()->nombre }}</strong><br><cite title="" data-original-title="">Administrador</cite></small>
                                    </div>
                                @endif

                            </div>
                        </div>
                        <div class="col-sm-1">
                        </div>

                    </div>
                    <div class="row sec-volver">
                        <div class="col-sm-12">
                            <div class="hr-line-dashed"></div>

                            <div class="form-group text-left">
                                <a href="{{ route('report.cuentascobrar') }}" class="btn btn-success" type="submit">Volver</a>
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

