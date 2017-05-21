@extends('layouts.admin')

@section('admin-content')
<div class="row wrapper border-bottom white-bg page-heading">
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
                <strong>Cuentas por cobrar</strong>
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
                    <h5 style="padding-top: 7px;">Cuentas por cobrar</h5>

                    <div class="ibox-tools" style="padding-bottom: 7px;">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Imprimir reporte" data-original-title="Imprimir reporte">
                                <i class="fa fa-print"></i>&nbsp;&nbsp;Imprimir...
                            </button>
                            <button type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Exportar reporte a Excel" data-original-title="Exportar reporte a Excel">
                                <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Exportar...
                            </button>
                        </div>
                    </div>
                </div>

                <div class="ibox-content ibox-heading" style="background-color: #ECF7FE">
                    <h3><i class="fa fa-table">&nbsp;&nbsp;</i>Cuentas por cobrar - Por propiedad</h3>
                    <small style="padding-left:36px;">Fecha: 11/04/2017 - Moneda: Bolivianos</small>
                </div>

                <div class="ibox-content">
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm-10">
                    	<div class="row">
	                    	<div class="col-sm-8">
	                    		<h3>Propiedad: 8 - A</h3>
	                    	</div>
	                    	<div class="col-sm-4">
	                    		<h3 class="text-right"><small>Fecha reporte: 31/03/2017</small></h3>
	                    	</div>
	                    </div>

                        <div class="table-responsive" style="margin-top: 20px;">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr bgcolor="#D6D6D6">
                                        <th>Cuota</th>
                                        <th>Gestión</th>
                                        <th>Periodo</th>
                                        <th style="text-align:right;">Importe</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>Consumo mensual de agua potable (m3)</td>
                                        <td>2017</td>
                                        <td>Enero</td>
                                        <td style="text-align:right;">165.00</td>
                                    </tr>
                                    <tr>
                                        <td>Cuota mensual de mantenimiento</td>
                                        <td>2017</td>
                                        <td>Enero</td>
                                        <td style="text-align:right;">900.00</td>
                                    </tr>
                                    <tr>
                                        <td>Consumo mensual de agua potable (m3)</td>
                                        <td>2017</td>
                                        <td>Febrero</td>
                                        <td style="text-align:right;">159.00</td>
                                    </tr>
                                    <tr>
                                        <td>Cuota mensual de mantenimiento</td>
                                        <td>2017</td>
                                        <td>Febrero</td>
                                        <td style="text-align:right;">900.00</td>
                                    </tr>
                                    <tr>
                                        <td>Consumo mensual de agua potable (m3)</td>
                                        <td>2017</td>
                                        <td>Marzo</td>
                                        <td style="text-align:right;">147.00</td>
                                    </tr>
                                    <tr>
                                        <td>Cuota mensual de mantenimiento</td>
                                        <td>2017</td>
                                        <td>Marzo</td>
                                        <td style="text-align:right;">972.00</td>
                                    </tr>
                                <tfoot>
                                    <th colspan="3">Total</th>
                                    <th style="text-align:right;">3.243,00</th>
                                </tfoot>
                            </table>
                        </div>

                    </div>
                    <div class="col-sm-1">
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="hr-line-dashed"></div>

                            <div class="form-group text-left">
                                <button class="btn btn-success" type="submit">Volver</button>
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
<script>
	$('.date-picker').datetimepicker({
		format: 'DD/MM/YYYY'
	});
</script>
@endsection

