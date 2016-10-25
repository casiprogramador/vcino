@extends('layouts.admin')

@section('admin-content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Teléfonos y sitios</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('admin.home') }}">Inicio</a>
                </li>
                <li class="active">
                    <strong><a href="{{ route('config.phonesite.index') }}">Teléfonos y sitios útiles</a></strong>
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
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>Razón social / Nombre</th>
                                    <th>Categoría</th>
                                    <th>Teléfono</th>
                                    <th><i class="fa fa-phone" style="color: red;"></i> Emergencia</th>
                                    <th>Sitio web</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($phonesites as $phonesite)

                                        <tr>
                                            <td>{{$phonesite->razon_social}}</td>
                                            <td>{{$phonesite->categoria}}</td>
                                            <td>{{$phonesite->telefono}}</td>
                                            <td>{{$phonesite->telefono_emergencia}}</td>
                                            <td><a href="{{$phonesite->sitio_web}}" target="_blank">{{$phonesite->sitio_web}}</a></td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        Opciones
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                        <li><a href="{{ route('config.phonesite.show', $phonesite->id) }}">Ver</a></li>
                                                        <li><a href="{{ route('config.phonesite.edit', $phonesite->id) }}">Editar</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>

                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title text-left" style="padding-left: 20px;">
                        <a href="{{route('config.phonesite.create') }}" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="bottom" title="Nuevo Proveedor" data-original-title="Nuevo" style="margin-right: 10px;"> Nuevo </a>
                        <button type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Imprimir..." data-original-title="Imprimir..." style="margin-right: 10px;"> <i class="fa fa-print fa-lg"></i> </button>
                        <button type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Exportar" data-original-title="Exportar"> <i class="fa fa-file-excel-o fa-lg"></i> </button>
                    </div>
                    <div class="ibox-content">
                        <h5>
                            Teléfonos útiles
                        </h5>
                        <p>
                            Lista de teléfonos útiles de emergencia y de interés. Clasificados por categoría para una mejor organización. Este listado estará disponible y actualizado para todos los usuarios.
                        </p>
                        <p>
                            Nota.- Algunos teléfonos o sitios web son sugeridos por la empresa. Los mismos pueden ser eliminados o cambiados por el administrador.
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
				"columnDefs": [ { "orderable": false, "targets": 4 }]
            });
        } );
    </script>
@endsection