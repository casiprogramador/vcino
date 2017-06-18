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

</div>





@endsection
@section('javascript')
<script>
	$('.date-picker').datetimepicker({
		format: 'DD/MM/YYYY'
	});
</script>
@endsection


