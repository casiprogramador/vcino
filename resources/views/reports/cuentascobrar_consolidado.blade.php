@extends('layouts.admin')

@section('admin-content')
<div class="row wrapper border-bottom white-bg page-heading migaspan">
    <div class="col-lg-10">
        <h2>Cuotas por cobrar</h2>
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

    <!--		CONSOLIDADO 			-->
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5 style="padding-top: 7px;">Cuentas por cobrar</h5>

                    <div class="ibox-tools" style="padding-bottom: 7px;">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-default" id="printButton" data-toggle="tooltip" data-placement="bottom" title="Imprimir reporte" data-original-title="Imprimir reporte">
                                <i class="fa fa-print"></i>&nbsp;&nbsp;Imprimir...
                            </button>
                            <a href="{{ route('report.consolidado.categoriaperiodogestion.excel',$anio.'_'.$mes) }}" type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Exportar reporte a Excel" data-original-title="Exportar reporte a Excel">
                                <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Exportar...
                            </a>
                        </div>
                    </div>
                </div>

                <div class="ibox-content ibox-heading" style="background-color: #ECF7FE">
                    <h3><i class="fa fa-table">&nbsp;&nbsp;</i>Cuotas por cobrar - Consolidado</h3>
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
                                                <h2 style="line-height: 18px; font-size: 19px;">Cuotas por cobrar - Consolidado</h2>
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
                                        <td align="right" style="padding-right: 15px;"><small>Fecha reporte: {{date('d/m/Y')}}</small></td>
                                    </tr>
                                </table>
                            </div>

                            <div class="table-responsive" style="margin-top: 20px;">
                                <table id="table-orden" class="table table-hover table-striped texto-impresion tabla-compress">
                                    <thead>
                                        <tr bgcolor="#D6D6D6">
                                            <th>Propiedad</th>
                                            <th>Propietario</th>
                                            <th>Tipo propiedad</th>
                                            <th style="text-align:right;">Importe</th>
                                        </tr>
                                    </thead>

                                    <tbody>
    									@for ($i = 0; $i < count($cuotas); $i++)
                                        <tr>
                                            <td data-order="{{ $cuotas[$i][4] }}">{{$cuotas[$i][0]}}</td>
                                            <td>{{$cuotas[$i][1]}}</td>
                                            <td data-order="{{ $cuotas[$i][2] }}" >{{$cuotas[$i][2]}}</td>
                                            <td data-order="{{ $cuotas[$i][3] }}" style="text-align:right;">{{ $cuotas[$i][3] > 0 ? number_format($cuotas[$i][3], 2, ',', '.') : " - " }}</td>
                                        </tr>
    									@endfor

                                    </tbody>
                                    <tfoot>
                                        <th colspan="3">Total</th>
                                        <th style="text-align:right;">{{ number_format($monto_total, 2, ',', '.') }}</th>
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
    <link rel="stylesheet" href="{{ URL::asset('css/datatables.min.css') }}" />
@endsection

@section('javascript')
<script type="text/javascript" src="{{ URL::asset('js/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/jquery.PrintArea.js') }}"></script>
<script>
    $(document).ready(function () {

        $("#printButton").click(function () {
            var mode = 'iframe'; //popup
            var close = mode == "popup";
            var options = {mode: mode, popClose: close};
            $("#printableArea").printArea(options);
        });

        $('#table-orden').DataTable({
            "paging": false,
            "bFilter": false,
            "searching": false,
            "info": false,
            "dom": 't',
            "columnDefs": [ { "orderable": false, "targets": 1 } ]
        });

    });
</script>
@endsection

