@extends('layouts.admin')

@section('admin-content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Proveedores</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="#/">Inicio</a>
                </li>
                <li>
                    Configuración
                </li>
                <li class="active">
                    <strong>Proveedores</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-9">
                @if (Session::has('message'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {!! session('message') !!}
                    </div>
                @endif
                <div class="ibox">
                    <div class="ibox-content">
                        <table class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th style="vertical-align:bottom">Razón social/ Nombre</th>
                                <th style="vertical-align:bottom">E-mail</th>
                                <th style="vertical-align:bottom">Tel. Emergencia</th>
                                <th style="vertical-align:bottom">Estado</th>
                                <th style="vertical-align:bottom"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($suppliers as $supplier)
                                @if($supplier->activa == 1)
                                    <tr>
                                        <td>{{ $supplier->razon_social }} {{ $supplier->contacto_nombre }} {{ $supplier->contacto_apellido }}</td>
                                        <td>{{ $supplier->email }}</td>
                                        <td>{{ $supplier->telefono_emergencia }}</td>
                                        <td><span>Activo</span></td>
                                        <td style="vertical-align:middle; text-align:right;">
                                            <div class="btn-group">
                                                <a href="{{ route('config.supplier.show', $supplier->id) }}" class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Ver proveedor">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{ route('config.supplier.edit', $supplier->id) }}" class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Editar proveedor">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                            </div>
                                       </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td><span class="text-muted">{{ $supplier->razon_social }} {{ $supplier->contacto_nombre }} {{ $supplier->contacto_apellido }}</span></td>
                                        <td><span class="text-muted">{{ $supplier->email }}</span></td>
                                        <td><span class="text-muted">{{ $supplier->telefono_emergencia }}</span></td>
                                        <td><span class="text-muted">Inactiva</span></td>
                                        <td style="vertical-align:middle; text-align:right;">
                                            <div class="btn-group">
                                                <a href="{{ route('config.supplier.show', $supplier->id) }}" class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Ver proveedor">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{ route('config.supplier.edit', $supplier->id) }}" class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Editar proveedor">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                            </div>
                                       </td>
                                    </tr>
                                @endif
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title text-left" style="padding-left: 20px;">
                        <a href="{{ route('config.supplier.create') }}" type="button" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="bottom" title="Nuevo Proveedor" data-original-title="Nuevo Proveedor" style="margin-right: 10px;"> Nuevo </a>
                        <button type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Imprimir lista de Proveedores..." data-original-title="Imprimir lista de Proveedores..." style="margin-right: 10px;"> <i class="fa fa-print fa-lg"></i> </button>
                        <button type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Exportar Proveedores" data-original-title="Exportar Proveedores"> <i class="fa fa-file-excel-o fa-lg"></i> </button>
                    </div>
                    <div class="ibox-content">
                        <h5>
                            Proveedores
                        </h5>
                        <p>
                            Los Proveedores son todas las empresas, prefesionales o técnicos que prestan diferentes servicios a la empresa. Los Proveedores son todas las empresas, prefesionales o técnicos que prestan diferentes servicios a la empresa.
                        </p>
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
                "columnDefs": [ { "orderable": false, "targets": 3 }, { "orderable": false, "targets": 4 } ]                
            });
        } );
    </script>
@endsection
