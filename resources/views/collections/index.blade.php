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
                <strong>Lista de cobranzas</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5 style="padding-top: 7px;">Lista de cobranzas</h5>
                    <div class="ibox-tools" style="padding-bottom: 7px;">
                        <a href="{{ route('transaction.collection.create') }}" type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Nuevo comunicado" data-original-title="Nuevo cuota por cobrar" style="margin-right: 5px;"> Nueva cobranza </a>

                    </div>
                </div>

                <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th style="vertical-align:bottom">Fecha</th>
                                <th style="vertical-align:bottom">Nro. Documento</th>
                                <th style="vertical-align:bottom">Propiedad</th>
                                <th style="vertical-align:bottom">Contacto</th>
                                <th style="vertical-align:bottom">Concepto</th>
                                <th style="vertical-align:bottom">Cuenta</th>
                                <th style="vertical-align:bottom; text-align: right;">Importe</th>
                                <th style="vertical-align:bottom" width="120"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>10/10/2016</td>
                                <td>231</td>
                                <td>3 AB</td>
                                <td>Juan Perez Fernandez</td>
                                <td>Pago de expensas</td>
                                <td>Bco. 0122011-22-11</td>
                                <td style="text-align: right;">1.400,00</td>
                                <td style="vertical-align:middle; text-align:right;">
                                    <div class="btn-group">
                                        <a class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Ver comprobante">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Editar comprobante">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                    </div>
                                    <div class="btn-group">
                                        <a class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Imprimir...">
                                            <i class="fa fa-print"></i>
                                        </a>
                                        <a class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Enviar...">
                                            <i class="fa fa-envelope-o"></i>
                                        </a>
                                    </div>
                               </td>
                            </tr>
                            <tr>
                                <td>12/10/2016</td>
                                <td>232</td>
                                <td>15 AB</td>
                                <td>Mario Jimenez Justiniano</td>
                                <td>Pago de expensas</td>
                                <td>Bco. 0122011-22-11</td>
                                <td style="text-align: right;">900,00</td>
                                <td style="vertical-align:middle; text-align:right;">
                                    <div class="btn-group">
                                        <a class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Ver comprobante">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Editar comprobante">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                    </div>
                                    <div class="btn-group">
                                        <a class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Imprimir...">
                                            <i class="fa fa-print"></i>
                                        </a>
                                        <a class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Enviar...">
                                            <i class="fa fa-envelope-o"></i>
                                        </a>
                                    </div>
                               </td>
                            </tr>
                            <tr>
                                <td>14/10/2016</td>
                                <td>233</td>
                                <td>6 B</td>
                                <td>Raquel Pereira</td>
                                <td>Pago de expensas</td>
                                <td>Caja General</td>
                                <td style="text-align: right;">900,00</td>
                                <td style="vertical-align:middle; text-align:right;">
                                    <div class="btn-group">
                                        <a class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Ver comprobante">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Editar comprobante">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                    </div>
                                    <div class="btn-group">
                                        <a class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Imprimir...">
                                            <i class="fa fa-print"></i>
                                        </a>
                                        <a class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Enviar...">
                                            <i class="fa fa-envelope-o"></i>
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
@section('style')
    <link rel="stylesheet" href="{{ URL::asset('css/datatables.min.css') }}" />
@endsection

@section('javascript')
    <script type="text/javascript" src="{{ URL::asset('js/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.table').DataTable({
                "language": {
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                },
                "paging":   false,
                "info":     false,
                "columnDefs": [ { "orderable": false, "targets": 4 } ]
            });
        } );
    </script>
@endsection



