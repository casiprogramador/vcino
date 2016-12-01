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
                <strong>Cuotas por cobrar</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5 style="padding-top: 7px;">Lista de cuotas por cobrar</h5>
                    <div class="ibox-tools" style="padding-bottom: 7px;">
                        <a href="{{ route('transaction.accountsreceivable.create') }}" type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Nuevo comunicado" data-original-title="Nuevo cuota por cobrar" style="margin-right: 5px;"> Nueva cuota </a>

                    </div>
                </div>

                <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-2 m-b-xs">
                        <select class="input-sm form-control input-s-sm inline">
                            <option value="0">Estado: Todas</option>
                            <option value="0">Canceladas</option>
                            <option value="0">Pendientes</option>
                        </select>
                    </div>
                    <div class="col-sm-2 m-b-xs">
                        <select class="input-sm form-control input-s-sm inline">
                            <option value="0">Gestión: Todas</option>
                            <option value="0">2016</option>
                            <option value="0">2015</option>
                            <option value="0">2014</option>
                        </select>
                    </div>
                    <div class="col-sm-2 m-b-xs">
                        <select class="input-sm form-control input-s-sm inline">
                            <option value="0">Periodo: Todos</option>
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
                    <div class="col-sm-3 m-b-xs">
                        <select class="input-sm form-control input-s-sm inline">
                            <option value="0">Propiedad: Todas</option>
                            <option value="0">Propiedad número 1</option>
                            <option value="0">Propiedad número 2</option>
                            <option value="0">Propiedad número 3</option>
                            <option value="0">Propiedad número n</option>
                        </select>
                    </div>
                    <div class="col-sm-3 m-b-xs">
                        <select class="input-sm form-control input-s-sm inline">
                            <option value="0">Cuota: Todas</option>
                            <option value="0">Expensas: Dobles</option>
                            <option value="0">Expensas: Simples</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 m-b-xs">
                        <hr>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th style="vertical-align:bottom">Propiedad</th>
                                <th style="vertical-align:bottom">Gestión</th>
                                <th style="vertical-align:bottom">Periodo</th>
                                <th style="vertical-align:bottom">Cuota</th>
                                <th style="vertical-align:bottom">Vencimiento</th>
                                <th style="vertical-align:bottom" class="text-right">Importe</th>
                                <th style="vertical-align:bottom">Cancelada</th>
                                <th style="vertical-align:bottom" width="100"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>3 AB</td>
                                <td>2016</td>
                                <td>10</td>
                                <td>Expensas: Dobles</td>
                                <td>15/11/2016</td>
                                <td class="text-right">1.100,00</td>
                                <td>
                                    <i class="fa fa-lg fa-check-square text-primary"></i>
                                </td>
                                <td style="vertical-align:middle; text-align:right;">
                                    <div class="btn-group">
                                        <a class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Ver">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Copiar...">
                                            <i class="fa fa-files-o"></i>
                                        </a>
                                        <a class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Editar">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                    </div>
                               </td>
                            </tr>
                            <tr>
                                <td>4 B</td>
                                <td>2016</td>
                                <td>10</td>
                                <td>Expensas: Simples</td>
                                <td>15/11/2016</td>
                                <td class="text-right">900,00</td>
                                <td>
                                    <i class="fa fa-lg fa-square-o text-muted"></i>
                                </td>
                                <td style="vertical-align:middle; text-align:right;">
                                    <div class="btn-group">
                                        <a class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Ver">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Copiar...">
                                            <i class="fa fa-files-o"></i>
                                        </a>
                                        <a class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Editar">
                                            <i class="fa fa-pencil"></i>
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
                "order": [[ 1, "asc" ]],
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
                "columnDefs": [ { "orderable": false, "targets": 0 }, { "orderable": false, "targets": 4 }, { "orderable": false, "targets": 5 } ]
            });
        } );
    </script>
@endsection


