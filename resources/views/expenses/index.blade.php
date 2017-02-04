@extends('layouts.admin')

@section('admin-content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Transacciones</h2>
        <ol class="breadcrumb">
            <li>
                <a href="#/">Inicio</a>
            </li>
            <li>
                Transacciones
            </li>
            <li class="active">
                <strong>Lista de gastos</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5 style="padding-top: 7px;">Lista de gastos</h5>
                    <div class="ibox-tools" style="padding-bottom: 7px;">
                        <button type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Nuevo comunicado" data-original-title="Nuevo cuota por cobrar" style="margin-right: 5px;"> Nuevo gasto </button>

                    </div>
                </div>

                <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th style="vertical-align:bottom">Fecha</th>
                                <th style="vertical-align:bottom">Nro.<br/>Documento</th>
                                <th style="vertical-align:bottom">Proveedor</th>
                                <th style="vertical-align:bottom">Categoría</th>
                                <th style="vertical-align:bottom">Concepto</th>
                                <th style="vertical-align:bottom">Cuenta</th>
                                <th style="vertical-align:bottom">Forma<br/> de pago</th>
                                <th style="vertical-align:bottom">Ref. pago</th>
                                <th style="vertical-align:bottom; text-align: right;">Importe</th>
                                <th style="vertical-align:bottom" width="120"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>10/10/2016</td>
                                <td>433</td>
                                <td>Cia. General Industrial</td>
                                <td>Mantenimiento Ascensor</td>
                                <td>Pago mantenimiento jul/2016</td>
                                <td>Bco. 0122011-22-11</td>
                                <td>Cheque</td>
                                <td>122</td>
                                <td style="text-align: right;">1.600,00</td>
                                <td style="vertical-align:middle; text-align:right;">
                                    <div class="btn-group">
                                        <a class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Ver comprobante">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Copiar gasto">
                                            <i class="fa fa-files-o"></i>
                                        </a>
                                        <a class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Editar comprobante">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                    </div>
                                    <div class="btn-group">
                                        <a class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Imprimir...">
                                            <i class="fa fa-print"></i>
                                        </a>
                                    </div>
                               </td>
                            </tr>
                            <tr>
                                <td>12/10/2016</td>
                                <td>434</td>
                                <td>OTAN Secuiry</td>
                                <td>Vigilancia y Seguridad</td>
                                <td>Pago septiembre de 2016</td>
                                <td>Bco. 0122011-22-11</td>
                                <td>Cheque</td>
                                <td>132</td>
                                <td style="text-align: right;">8.000,00</td>
                                <td style="vertical-align:middle; text-align:right;">
                                    <div class="btn-group">
                                        <a class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Ver comprobante">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Copiar gasto">
                                            <i class="fa fa-files-o"></i>
                                        </a>
                                        <a class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Editar comprobante">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                    </div>
                                    <div class="btn-group">
                                        <a class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Imprimir...">
                                            <i class="fa fa-print"></i>
                                        </a>
                                    </div>
                               </td>
                            </tr>
                            <tr>
                                <td>21/10/2016</td>
                                <td>454</td>
                                <td>La Eficaz</td>
                                <td>Limpieza y productos</td>
                                <td>Pago servicio mensual</td>
                                <td>Caja General</td>
                                <td>Efectivo</td>
                                <td></td>
                                <td style="text-align: right;">3.400,00</td>
                                <td style="vertical-align:middle; text-align:right;">
                                    <div class="btn-group">
                                        <a class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Ver comprobante">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Copiar gasto">
                                            <i class="fa fa-files-o"></i>
                                        </a>
                                        <a class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Editar comprobante">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                    </div>
                                    <div class="btn-group">
                                        <a class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Imprimir...">
                                            <i class="fa fa-print"></i>
                                        </a>
                                    </div>
                               </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>

    </div>

</div>



@endsection



