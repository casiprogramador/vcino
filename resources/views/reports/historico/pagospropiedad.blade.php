@extends('layouts.admin')

@section('admin-content')
<div class="row wrapper border-bottom white-bg page-heading">
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
                    <h3><i class="fa fa-table">&nbsp;&nbsp;</i>Histórico de transacciones - Pagos por propiedad</h3>
                    <small style="padding-left:36px;">Periodo: Marzo/2017 - Moneda: Bolivianos</small>
                </div>

                <div class="ibox-content">
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm-10">

                    	<div class="row">
	                    	<div class="col-sm-9">
	                    		<h3>Propiedad: 3 - A</h3>
	                    	</div>
	                    	<div class="col-sm-3">
	                    		<h3 class="text-right"><small>Fecha reporte: 31/03/2017</small></h3>
	                    	</div>
	                    </div>

                        <div class="table-responsive" style="margin-top: 20px;">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr bgcolor="#D6D6D6">
                                        <th style="vertical-align:bottom">Fecha</th>
                                        <th style="vertical-align:bottom">Cuota</th>
                                        <th style="vertical-align:bottom">Concepto</th>
                                        <th style="text-align:right; vertical-align:bottom">Importe</th>
                                    </tr>
                                </thead>

                                <tbody>
                                	<tr>
										<td>14/01/2017</td>
										<td>Servicios: consumo de agua potable</td>
										<td>Consumo mensual de agua potable (m3) - Periodo: Diciembre 2016</td>
										<td style="text-align:right;">423.00</td>
									</tr>
                                	<tr>
										<td>14/01/2017</td>
										<td>Mantenimiento: cuota mensual</td>
										<td>Cuota mensual de mantenimiento - Periodo: Diciembre 2016</td>
										<td style="text-align:right;">1,100.00</td>
									</tr>
                                	<tr>
										<td>03/02/2017</td>
										<td>Alquiler: áreas comunes</td>
										<td>Uso de salón de eventos - Periodo: Febrero 2017</td>
										<td style="text-align:right;">342.50</td>
									</tr>
                                	<tr>
										<td>06/02/2017</td>
										<td>Mantenimiento: cuota mensual</td>
										<td>Cuota mensual de mantenimiento - Periodo: Enero 2017</td>
										<td style="text-align:right;">1,100.00</td>
									</tr>
                                	<tr>
										<td>06/02/2017</td>
										<td>Servicios: consumo de agua potable</td>
										<td>Consumo mensual de agua potable (m3) - Periodo: Enero 2017</td>
										<td style="text-align:right;">367.00</td>
									</tr>
                                	<tr>
										<td>06/03/2017</td>
										<td>Mantenimiento: cuota mensual</td>
										<td>Cuota mensual de mantenimiento - Periodo: Febrero 2017</td>
										<td style="text-align:right;">1,100.00</td>
									</tr>
                                	<tr>
										<td>06/03/2017</td>
										<td>Servicios: consumo de agua potable</td>
										<td>Consumo mensual de agua potable (m3) - Periodo: Febrero 2017</td>
										<td style="text-align:right;">358.00</td>
									</tr>
                                <tfoot>
									<th colspan="3">Total</th>
									<th style="text-align:right;">4.790,50</th>
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
    <!--            FIN PAGOS POR PROPIEDAD             -->


</div>





@endsection
@section('javascript')
<script>
	$('.date-picker').datetimepicker({
		format: 'DD/MM/YYYY'
	});
</script>
@endsection

