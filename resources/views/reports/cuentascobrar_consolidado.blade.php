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

    <!--		CONSOLIDADO 			-->
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
                    <h3><i class="fa fa-table">&nbsp;&nbsp;</i>Cuentas por cobrar - Consolidado</h3>
                    <small style="padding-left:36px;">Fecha: 11/04/2017 - Moneda: Bolivianos</small>
                </div>

                <div class="ibox-content">
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm-10">
                        <div class="table-responsive" style="margin-top: 20px;">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr bgcolor="#D6D6D6">
                                        <th>Propiedad</th>
                                        <th>Propietario</th>
                                        <th style="text-align:right;">Importe</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>8 - A</td>
                                        <td>Arnaldo Suarez Figueroa</td>
                                        <td style="text-align:right;">3.455,00</td>
                                    </tr>
                                    <tr>
                                        <td>5 - A</td>
                                        <td>Sonia Torres Sanchez</td>
                                        <td style="text-align:right;">3.009,00</td>
                                    </tr>
                                    <tr>
                                        <td>4 - A</td>
                                        <td>Maria Teresa Chavez</td>
                                        <td style="text-align:right;">1.097,00</td>
                                    </tr>
                                    <tr>
                                        <td>5 - B</td>
                                        <td>David Antequera</td>
                                        <td style="text-align:right;">900,00</td>
                                    </tr>

                                </tbody>
                                <tfoot>
                                    <th colspan="2">Total</th>
                                    <th style="text-align:right;">8.461,00</th>
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

