@extends('layouts.admin')

@section('admin-content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Categorías</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('admin.home') }}">Inicio</a>
                </li>
                <li class="active">
                    <strong><a href="{{ route('config.category.index') }}">Categorías</a></strong>
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
                                <th style="vertical-align:bottom;"></th>
                                <th style="vertical-align:bottom;">Categoría</th>
                                <th style="vertical-align:bottom;">Tipo</th>
                                <th style="vertical-align:bottom;">Clase</th>
                                <th style="vertical-align:bottom;">Estado</th>
                                <th style="vertical-align:bottom" width="70"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($categories as $category)
                                @if($category->activa == 1)
                                    <tr>
                                        <td style="vertical-align:middle"><img src="{{ $category->icono }}" width="30"></td>
                                        <td style="vertical-align:middle">{{ $category->nombre }}</td>
                                        <td style="vertical-align:middle">{{ $category->tipo_categoria }}</td>
                                        <td style="vertical-align:middle">{{ $category->clase }}</td>
                                        <td style="vertical-align:middle"><span>Activa</span></td>
                                        <td style="vertical-align:middle; text-align:right;">
                                            <div class="btn-group">
                                                <a href="{{ route('config.category.show', $category->id) }}" class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Ver categoría">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{ route('config.category.edit', $category->id) }}" class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Editar categoría">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                            </div>
                                       </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td style="vertical-align:middle"><img src="{{ $category->icono }}" width="28"></td>
                                        <td style="vertical-align:middle"><span class="text-muted">{{ $category->nombre }}</span></td>
                                        <td style="vertical-align:middle"><span class="text-muted">Egreso</span></td>
                                        <td style="vertical-align:middle"><span class="text-muted">Ordinaria</span></td>
                                        <td style="vertical-align:middle"><span class="text-muted">Inactiva</span></td>
                                        <td style="vertical-align:middle; text-align:right;">
                                            <div class="btn-group">
                                                <a href="{{ route('config.category.show', $category->id) }}" class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Ver categoría">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{ route('config.category.edit', $category->id) }}" class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Editar categoría">
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
                        <a href="{{ route('config.category.create') }}" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="bottom" title="Nueva Categoria" data-original-title="Nueva Categoria" style="margin-right: 10px;"> Nueva </a>
                        <button type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Imprimir lista de Cuentas..." data-original-title="Imprimir lista de Cuentas..." style="margin-right: 10px;"> <i class="fa fa-print fa-lg"></i> </button>
                        <button type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Exportar Cuentas" data-original-title="Exportar Cuentas"> <i class="fa fa-file-excel-o fa-lg"></i> </button>
                    </div>
                    <div class="ibox-content">
                        <h5>
                            Categorías
                        </h5>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitat.
                        </p>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitat.
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