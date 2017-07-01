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

    <!--	*******************************		-->
    <!--		  PAGOS POR PROPIEDAD			-->
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
                           <a href="{{ route('report.historicotransacciones.propiedades.excel', $mes.'_'.$anio.'_'.$propiedad->id) }}" type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Exportar reporte a Excel" data-original-title="Exportar reporte a Excel">
                                <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Exportar...
                            </a>
                        </div>
                    </div>
                </div>

                <div class="ibox-content ibox-heading" style="background-color: #ECF7FE">
                    <h3><i class="fa fa-table">&nbsp;&nbsp;</i>Histórico de transacciones - Pagos por propiedad</h3>
                     @if($mes != 0)
                    <small style="padding-left:36px;">Periodo: {{nombremes($mes)}}/{{$anio}} - Moneda: Bolivianos</small>
                    @else
                    <small style="padding-left:36px;">Gestión: {{$anio}} - Moneda: Bolivianos</small>
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
                                                <h2 style="line-height: 18px; font-size: 19px;">Histórico de transacciones - Pagos propiedad</h2>
                                                @if($mes != 0)
                                                <p style="font-size: 10px;">Periodo: {{nombremes($mes)}}/{{$anio}} - Moneda: Bolivianos</p>
                                                @else
                                                <p style="font-size: 10px;">Gestión: {{$anio}} - Moneda: Bolivianos</p>
                                                @endif
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
    	                    	<div class="col-sm-12">
    	                    		<h3>Propiedad: {{ $propiedad->nro }}</h3>
    	                    	</div>
    	                    </div>

                            <div class="table-responsive" style="margin-top: 20px;">
                                <table class="table table-hover table-striped texto-impresion tabla-compress">
                                    <thead>
                                        <tr bgcolor="#D6D6D6">
                                            <th style="vertical-align:bottom">Fecha</th>
                                            <th style="vertical-align:bottom">Cuota</th>
                                            <th style="vertical-align:bottom">Concepto</th>
                                            <th style="text-align:right; vertical-align:bottom">Importe</th>
                                        </tr>
                                    </thead>

                                    <tbody>
    									
    									@for ($i = 0; $i < count($datos); $i++)
                                    	<tr>
    										<td>{{$datos[$i][0]}}</td>
    										<td>{{$datos[$i][1]}}</td>
    										<td>{{$datos[$i][2]}}</td>
    										<td style="text-align:right;">{{number_format($datos[$i][3], 2, '.', '.')}}</td>
    									</tr>
    									@endfor
                                    </tbody>
                                    <tfoot>
    									<th colspan="3">Total</th>
    									<th style="text-align:right;">{{number_format($monto, 2, '.', '.')}}</th>
                                    </tfoot>
                                </table>
                            </div>

                        </div>
                        <div class="col-sm-1">
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
    <!--            FIN PAGOS POR PROPIEDAD             -->


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

