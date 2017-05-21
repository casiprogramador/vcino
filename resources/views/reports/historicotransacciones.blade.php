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

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Histórico de transacciones</h5>
                </div>

                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-6">
                            <form role="form" class="form-horizontal">
                                <div class="form-group" style="padding-top: 10px;">
                                    <label class="col-sm-4 control-label">Tipo</label>
                                    <div class="col-sm-5">
                                        <select class="form-control input-sm" name="historial">
                                            <option value="cuenta">Cuentas</option>
                                            <option value="categoria">Categorías</option>
                                            <option value="proveedor">Proveedores</option>
                                            <option value="pagos">Pagos por propiedad</option>
                                            <option value="ingresos">Ingresos</option>
                                            <option value="egresos">Egresos</option>
                                            <option value="traspaso">Traspasos</option>
                                            <option value="todas">Todas las transacciones</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Periodo</label>
                                    <div class="col-sm-5">
                                        <select class="form-control input-sm" name="periodo">
                                            <optgroup>
                                                <option value="actual">Mes actual</option>
                                                <option value="anterior">Mes anterior</option>
                                                <option value="gestionactual">Gestión actual</option>
                                                <option value="gestionanterior">Gestión anterior</option>
                                            </optgroup>
                                            <optgroup>
                                                <option value="entrefechas">Entre fechas</option>
                                                <option value="mesgestion">Por mes y gestión</option>
                                                <option value="porgestion">Por gestión</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Mes</label>
                                    <div class="col-sm-4">
                                        <select class="form-control input-sm" name="pormes">
                                            <option value="1">Enero</option>
                                            <option value="2">Febrero</option>
                                            <option value="3">Marzo</option>
                                            <option value="4">Abril</option>
                                            <option value="5">Mayo</option>
                                            <option value="6">Junio</option>
                                            <option value="7">Julio</option>
                                            <option value="8">Agosto</option>
                                            <option value="9">Septiembre</option>
                                            <option value="10">Octubre</option>
                                            <option value="11">Noviembre</option>
                                            <option value="12">Diciembre</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Gestión</label>
                                    <div class="col-sm-4">

                                        <!--    Las gestiones debe traer de la base de datos    -->

                                        <select class="form-control input-sm" name="porgestion">
                                            <option>2016</option>
                                            <option>2017</option>
                                            <option>2018</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group" style="padding-top: 10px;">
                                    <label class="col-sm-4 control-label">Cuentas</label>
                                    <div class="col-sm-5">
                                        <select class="form-control input-sm" name="cuentas">
                                            <option value="">Cuenta 1</option>
                                            <option value="">Cuenta 2</option>
                                            <option value="">Cuenta 3</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group" style="padding-top: 10px;">
                                    <label class="col-sm-4 control-label">Categorías</label>
                                    <div class="col-sm-5">
                                        <select class="form-control input-sm" name="categoria">
                                            <option value="">Categoría 1</option>
                                            <option value="">Categoría 2</option>
                                            <option value="">Categoría 3</option>
                                            <option value="">Categoría 4</option>
                                            <option value="">Categoría 5</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group" style="padding-top: 10px;">
                                    <label class="col-sm-4 control-label">Proveedor</label>
                                    <div class="col-sm-5">
                                        <select class="form-control input-sm" name="proveedor">
                                            <option value="">Proveedor 1</option>
                                            <option value="">Proveedor 2</option>
                                            <option value="">Proveedor 3</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group" style="padding-top: 10px;">
                                    <label class="col-sm-4 control-label">Propiedad</label>
                                    <div class="col-sm-5">
                                        <select class="form-control input-sm" name="propiedad">
                                            <option value="">3 AB</option>
                                            <option value="">4 A</option>
                                            <option value="">4 B</option>
                                            <option value="">5 A</option>
                                            <option value="">5 B</option>
                                            <option value="">6 A</option>
                                            <option value="">6 B</option>
                                            <option value="">Penthouse</option>
                                        </select>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="col-sm-6"><h4 class="text-muted">Histórico de transacciones</h4>
                            <p class="text-muted">Este reporte...</p>
                        </div>
                    </div>

                    <div class="row">
                    <div class="col-sm-12">
                        <div class="hr-line-dashed"></div>

                        <div class="form-group text-right">
                            <button class="btn btn-success" type="submit">Siguiente</button>
                        </div>
                    </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <!--	**********************	-->
    <!--			CUENTAS 		-->
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
                    <h3><i class="fa fa-table">&nbsp;&nbsp;</i>Histórico de transacciones - Cuentas</h3>
                    <small style="padding-left:36px;">Periodo: Marzo/2017 - Moneda: Bolivianos</small>
                </div>

                <div class="ibox-content">
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm-10">

                    	<div class="row">
	                    	<div class="col-sm-8">
	                    		<h3>Cuenta: C.C. BISA BS - 018090019</h3>
	                    	</div>
	                    	<div class="col-sm-4">
	                    		<h3 class="text-right"><small>Fecha reporte: 31/03/2017</small></h3>
	                    	</div>
	                    </div>

                        <div class="table-responsive" style="margin-top: 20px;">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr bgcolor="#D6D6D6">
                                        <th style="vertical-align:bottom">Fecha</th>
                                        <th style="vertical-align:bottom">Documento</th>
                                        <th style="vertical-align:bottom">Concepto</th>
                                        <th style="vertical-align:bottom">Forma de pago</th>
                                        <th style="vertical-align:bottom">No. Forma pago</th>
                                        <th style="text-align:right; vertical-align:bottom">Ingreso</th>
                                        <th style="text-align:right; vertical-align:bottom">Egreso</th>
                                    </tr>
                                </thead>

                                <tbody>
									<tr>
										<td>10/03/2017</td>
										<td>I-00002</td>
										<td>Pago de expensas mes de febrero</td>
										<td>Depósito</td>
										<td></td>
										<td style="text-align:right;">970.00</td>
										<td style="text-align:right;"></td>
									</tr>
									<tr>
										<td>15/03/2017</td>
										<td>I-00003</td>
										<td>Pago de expensas mes de febrero</td>
										<td>Depósito</td>
										<td></td>
										<td style="text-align:right;">970.00</td>
										<td style="text-align:right;"></td>
									</tr>
									<tr>
										<td>20/03/2017</td>
										<td>E-00001</td>
										<td>Pago a proveedor</td>
										<td>Cheque</td>
										<td>122</td>
										<td style="text-align:right;"></td>
										<td style="text-align:right;">200,00</td>
									</tr>
                                <tfoot>
									<th colspan="5">Totales</th>
									<th style="text-align:right;">970,00</th>
									<th style="text-align:right;">0,00</th>
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


    <!--	**********************	-->
    <!--		  CATEGORIAS		-->
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
                    <h3><i class="fa fa-table">&nbsp;&nbsp;</i>Histórico de transacciones - Categorías</h3>
                    <small style="padding-left:36px;">Periodo: Marzo/2017 - Moneda: Bolivianos</small>
                </div>

                <div class="ibox-content">
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm-10">

                    	<div class="row">
	                    	<div class="col-sm-9">
	                    		<h3>Categoría: Servicio de agua potable y alcantarillado consumo propiedades</h3>
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
                                        <th style="vertical-align:bottom">Documento</th>
                                        <th style="vertical-align:bottom">Proveedor</th>
                                        <th style="vertical-align:bottom">Concepto</th>
                                        <th style="vertical-align:bottom">Cuenta</th>
                                        <th style="vertical-align:bottom">Forma de pago</th>
                                        <th style="text-align:right; vertical-align:bottom">Importe</th>
                                    </tr>
                                </thead>

                                <tbody>
									<tr>
										<td>10/02/2017</td>
										<td>E-00002</td>
										<td>SAGUAPAC</td>
										<td>Pago servicio mes de enero</td>
										<td>Caja general</td>
										<td>Efectivo</td>
										<td style="text-align:right;">450.00</td>
									</tr>
									<tr>
										<td>09/03/2017</td>
										<td>E-00011</td>
										<td>SAGUAPAC</td>
										<td>Pago servicio mes de febrero 2017</td>
										<td>Banco BCP No. 192918291-001</td>
										<td>Cheque No. 123</td>
										<td style="text-align:right;">521.00</td>
									</tr>
                                <tfoot>
									<th colspan="6">Total</th>
									<th style="text-align:right;">971,00</th>
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


    <!--	**********************	-->
    <!--		  PROVEEDOR		-->
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
                    <h3><i class="fa fa-table">&nbsp;&nbsp;</i>Histórico de transacciones - Proveedor</h3>
                    <small style="padding-left:36px;">Periodo: Marzo/2017 - Moneda: Bolivianos</small>
                </div>

                <div class="ibox-content">
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm-10">

                    	<div class="row">
	                    	<div class="col-sm-9">
	                    		<h3>Proveedor: OTAN Seguridad</h3>
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
                                        <th style="vertical-align:bottom">Documento</th>
                                        <th style="vertical-align:bottom">Categoría</th>
                                        <th style="vertical-align:bottom">Concepto</th>
                                        <th style="vertical-align:bottom">Cuenta</th>
                                        <th style="vertical-align:bottom">Forma de pago</th>
                                        <th style="text-align:right; vertical-align:bottom">Importe</th>
                                    </tr>
                                </thead>

                                <tbody>
									<tr>
										<td>10/02/2017</td>
										<td>E-00003</td>
										<td>Seguridad y vigilancia</td>
										<td>Pago servicio mes de enero</td>
										<td>Caja general</td>
										<td>Efectivo</td>
										<td style="text-align:right;">6.000.00</td>
									</tr>
									<tr>
										<td>09/03/2017</td>
										<td>E-00014</td>
										<td>Seguridad y vigilancia</td>
										<td>Pago servicio mes de febrero 2017</td>
										<td>Banco BCP No. 192918291-001</td>
										<td>Cheque No. 125</td>
										<td style="text-align:right;">6.000.00</td>
									</tr>
                                <tfoot>
									<th colspan="6">Total</th>
									<th style="text-align:right;">12.000,00</th>
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


    <!--            *******************************     -->
    <!--                        INGRESOS                -->
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
                    <h3><i class="fa fa-table">&nbsp;&nbsp;</i>Histórico de transacciones - Ingresos</h3>
                    <small style="padding-left:36px;">Periodo: Marzo/2017 - Moneda: Bolivianos</small>
                </div>

                <div class="ibox-content">
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm-10">

                        <div class="table-responsive" style="margin-top: 20px;">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr bgcolor="#D6D6D6">
                                        <th style="vertical-align:bottom">Fecha</th>
                                        <th style="vertical-align:bottom">Documento</th>
                                        <th style="vertical-align:bottom">Beneficiario</th>
                                        <th style="vertical-align:bottom">Concepto</th>
                                        <th style="vertical-align:bottom">Cuenta</th>
                                        <th style="text-align:right; vertical-align:bottom">Importe</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>11/03/2017</td>
                                        <td>I-000008</td>
                                        <td>Caoba 01 - Carlos Marcos</td>
                                        <td>Pago de expensas enero 2017</td>
                                        <td>BCP CC en Bolivianos</td>
                                        <td style="text-align:right;">500.00</td>
                                    </tr>
                                    <tr>
                                        <td>15/03/2017</td>
                                        <td>I-000009</td>
                                        <td>Caoba 02 - Mario Fernandez</td>
                                        <td>Pago de expensas enero 2017</td>
                                        <td>BCP CC en Bolivianos</td>
                                        <td style="text-align:right;">500.00</td>
                                    </tr>
                                    <tr>
                                        <td>16/03/2017</td>
                                        <td>I-000010</td>
                                        <td>101 - Fernanda Ramos</td>
                                        <td>Pago de expensas marzo 2017</td>
                                        <td>BCP CC en Bolivianos</td>
                                        <td style="text-align:right;">350.00</td>
                                    </tr>
                                <tfoot>
                                    <th colspan="5">Total</th>
                                    <th style="text-align:right;">1.350,00</th>
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
    <!--            FIN INGRESOS         -->


    <!--            *******************************     -->
    <!--                        EGRESOS                -->
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
                    <h3><i class="fa fa-table">&nbsp;&nbsp;</i>Histórico de transacciones - Egresos</h3>
                    <small style="padding-left:36px;">Periodo: Marzo/2017 - Moneda: Bolivianos</small>
                </div>

                <div class="ibox-content">
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm-10">

                        <div class="table-responsive" style="margin-top: 20px;">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr bgcolor="#D6D6D6">
                                        <th style="vertical-align:bottom">Fecha</th>
                                        <th style="vertical-align:bottom">Documento</th>
                                        <th style="vertical-align:bottom">Proveedor</th>
                                        <th style="vertical-align:bottom">Categoría</th>
                                        <th style="vertical-align:bottom">Concepto</th>
                                        <th style="vertical-align:bottom">Cuenta</th>
                                        <th style="text-align:right; vertical-align:bottom">Importe</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>11/03/2017</td>
                                        <td>E-000008</td>
                                        <td>OTIS</td>
                                        <td>Mantenimiento ascensores</td>
                                        <td>Pago servicio febrero 2017</td>
                                        <td>BCP CC en Bolivianos</td>
                                        <td style="text-align:right;">1.750.00</td>
                                    </tr>
                                    <tr>
                                        <td>15/03/2017</td>
                                        <td>E-000009</td>
                                        <td>Aguilas Security S.R.L.</td>
                                        <td>Seguridad y vigilancia</td>
                                        <td>Servicio mes de febrero 2017</td>
                                        <td>BCP CC en Bolivianos</td>
                                        <td style="text-align:right;">12.500.00</td>
                                    </tr>
                                <tfoot>
                                    <th colspan="6">Total</th>
                                    <th style="text-align:right;">14.250,00</th>
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
    <!--            FIN EGRESOS                             -->


    <!--            *******************************         -->
    <!--                        TRASPASOS                   -->
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
                    <h3><i class="fa fa-table">&nbsp;&nbsp;</i>Histórico de transacciones - Traspasos</h3>
                    <small style="padding-left:36px;">Periodo: Marzo/2017 - Moneda: Bolivianos</small>
                </div>

                <div class="ibox-content">
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm-10">

                        <div class="table-responsive" style="margin-top: 20px;">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr bgcolor="#D6D6D6">
                                        <th style="vertical-align:bottom">Fecha</th>
                                        <th style="vertical-align:bottom">Documento</th>
                                        <th style="vertical-align:bottom">Concepto</th>
                                        <th style="vertical-align:bottom">Cuenta origen</th>
                                        <th style="vertical-align:bottom">Cuenta destino</th>
                                        <th style="vertical-align:bottom">Forma de pago</th>
                                        <th style="text-align:right; vertical-align:bottom">Importe</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>11/03/2017</td>
                                        <td>T-000008</td>
                                        <td>Taspaso de fondos para caja chica</td>
                                        <td>BCP CC en Bolivianos</td>
                                        <td>Caja Chica</td>
                                        <td>Cheque</td>
                                        <td style="text-align:right;">450.00</td>
                                    </tr>
                                <tfoot>
                                    <th colspan="6">Total</th>
                                    <th style="text-align:right;">450,00</th>
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
    <!--            FIN TRASPASOS                               -->


    <!--            *******************************             -->
    <!--                 TODAS LAS TRANSACCIONES                -->
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
                    <h3><i class="fa fa-table">&nbsp;&nbsp;</i>Histórico de transacciones - Todas las transacciones</h3>
                    <small style="padding-left:36px;">Periodo: Marzo/2017 - Moneda: Bolivianos</small>
                </div>

                <div class="ibox-content">
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm-10">

                        <div class="table-responsive" style="margin-top: 20px;">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr bgcolor="#D6D6D6">
                                        <th style="vertical-align:bottom">Fecha</th>
                                        <th style="vertical-align:bottom">Documento</th>
                                        <th style="vertical-align:bottom">Beneficiario</th>
                                        <th style="vertical-align:bottom">Categoría</th>
                                        <th style="vertical-align:bottom">Concepto</th>
                                        <th style="vertical-align:bottom">Cuenta</th>
                                        <th style="text-align:right; vertical-align:bottom">Crédito</th>
                                        <th style="text-align:right; vertical-align:bottom">Débito</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>11/03/2017</td>
                                        <td>I-000008</td>
                                        <td>Caoba 01 - Carlos Marcos</td>
                                        <td>Expensas mensuales</td>
                                        <td>Pago de expensas enero 2017</td>
                                        <td>BCP CC en Bolivianos</td>
                                        <td style="text-align:right;">500.00</td>
                                        <td style="text-align:right;"></td>
                                    </tr>
                                    <tr>
                                        <td>12/03/2017</td>
                                        <td>E-000008</td>
                                        <td>OTIS</td>
                                        <td>Mantenimiento ascensores</td>
                                        <td>Pago servicio febrero 2017</td>
                                        <td>BCP CC en Bolivianos</td>
                                        <td style="text-align:right;"></td>
                                        <td style="text-align:right;">1.750.00</td>
                                    </tr>
                                    <tr>
                                        <td>13/03/2017</td>
                                        <td>T-000008</td>
                                        <td></td>
                                        <td></td>
                                        <td>Taspaso de fondos para caja chica</td>
                                        <td>BCP CC en Bolivianos - Caja chica</td>
                                        <td style="text-align:right;">450.00</td>
                                        <td style="text-align:right;">450.00</td>
                                    </tr>
                                <tfoot>
                                    <th colspan="6">Totales</th>
                                    <th style="text-align:right;">950,00</th>
                                    <th style="text-align:right;">1.200,00</th>
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
    <!--            FIN TODAS LAS TRANSACCIONES         -->


</div>





@endsection
@section('javascript')
<script>
	$('.date-picker').datetimepicker({
		format: 'DD/MM/YYYY'
	});
</script>
@endsection
