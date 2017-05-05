@extends('layouts.admin')

@section('admin-content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Disponibilidad</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.home') }}">Inicio</a>
            </li>
            <li>
                Reportes
            </li>
            <li class="active">
                <strong>Disponibilidad</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5 style="padding-top: 7px;">Disponibilidad</h5>

                    <div class="ibox-tools" style="padding-bottom: 7px;">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-default" id="printButton" data-toggle="tooltip" data-placement="bottom" title="Imprimir reporte" data-original-title="Imprimir reporte">
                                <i class="fa fa-print"></i>&nbsp;&nbsp;Imprimir...
                            </button>
                            <a href="{{ route('report.disponibilidad.pdf', date('Y-m-d', strtotime(str_replace('/','-',$fecha)))) }}" type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Exportar reporte a Excel" data-original-title="Exportar reporte a Excel">
                                <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Exportar...
                            </a>
                            <!--
                            <button type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Enviar reporte por correo electrónico" data-original-title="Enviar reporte por correo electrónico">
                                <i class="fa fa-envelope-o"></i>&nbsp;&nbsp;Enviar...
                            </button>
                            -->
                        </div>
                    </div>
                </div>
				
                <div class="ibox-content ibox-heading" style="background-color: #ECF7FE">
                    <h3><i class="fa fa-table">&nbsp;&nbsp;</i>Disponibilidad por cuenta</h3>
                    <small style="padding-left:36px;">Fecha: {{$fecha}} - Moneda: Bolivianos</small>
                </div>
				<div id="printableArea">
                <div class="ibox-content">
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm-10">
                        <div class="table-responsive" style="margin-top: 20px;">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr bgcolor="#D6D6D6">
                                        <th>Cuenta</th>
                                        <th style="text-align:right;">Importe</th>
                                    </tr>
                                </thead>
                                <tbody>
									@for ($i = 0; $i < count($cuentas); $i++)
                                    <tr>
                                        <td>{{$cuentas[$i]['cuenta']}}</td>
                                        <td style="text-align:right;">{{money_format('%i', $cuentas[$i]['ingreso']-$cuentas[$i]['egreso']+$cuentas[$i]['ingreso_trans']-$cuentas[$i]['egreso_trans'])}}</td>
                                    </tr>
									@endfor
                                </tbody>
                                <tfoot>
                                    <th>Total</th>
                                    <th style="text-align:right;">{{money_format('%i', $suma_total)}}</th>
                                </tfoot>
                            </table>
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
                                <a href="{{ route('report.disponibilidad') }}" class="btn btn-success" type="submit">Volver</a>
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

