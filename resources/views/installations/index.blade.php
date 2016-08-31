@extends('layouts.admin')

@section('admin-content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Instalaciones comunes</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('admin.home') }}">Inicio</a>
                </li>
                <li class="active">
                    <strong><a href="{{ route('config.installation.index') }}">Instalaciones</a></strong>
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
                                    <th>Fotografía <br>principal</th>
                                    <th>Instalación</th>
                                    <th>Costo</th>
                                    <th>Requiere <br>reserva</th>
                                    <th>Estado</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($installations as $installation)
                                    @if($installation->activa == 1)
                                        <tr>
                                            <td><img src="{{ $installation->fotografia_principal }}" class="img-responsive" width="100"></td>
                                            <td>{{ $installation->instalacion }}</td>
                                            <td>{{ $installation->costo }}</td>
                                            <td>{{ ($installation->requiere_reserva == 1) ? 'SI' : 'NO' }}</td>
                                            <td><span class="text-success">Activo</span></td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        Opciones
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                        <li><a href="{{ route('config.installation.show', $installation->id) }}">Ver Instalacion</a></li>
                                                        <li><a href="{{ route('config.installation.edit', $installation->id) }}">Editar Instalacion</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td><img src="{{ $installation->fotografia_principal }}" class="img-responsive" width="100"></td>
                                            <td style="vertical-align:middle"><span class="text-muted">{{ $installation->instalacion }}</span></td>
                                            <td style="vertical-align:middle"><span class="text-muted">{{ $installation->costo }}</span></td>
                                            <td style="vertical-align:middle"><span class="text-muted">{{ ($installation->requiere_reserva == 1) ? 'SI' : 'NO' }}</span></td>
                                            <td style="vertical-align:middle"><span class="text-danger">Inactiva</span></td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        Opciones
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                        <li><a href="{{ route('config.installation.show', $installation->id) }}">Ver Instalacion</a></li>
                                                        <li><a href="{{ route('config.installation.edit', $installation->id) }}">Editar Instalacion</a></li>
                                                    </ul>
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
            </div>

            <div class="col-md-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title text-left" style="padding-left: 20px;">
                        <a href="{{ route('config.installation.create') }}" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="bottom" title="Nueva Instalacion comun" data-original-title="Nueva instalacion comun" style="margin-right: 10px;"> Nueva </a>
                        <button type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Imprimir..." data-original-title="Imprimir..." style="margin-right: 10px;"> <i class="fa fa-print fa-lg"></i> </button>
                        <button type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Exportar" data-original-title="Exportar"> <i class="fa fa-file-excel-o fa-lg"></i> </button>
                    </div>
                    <div class="ibox-content">
                        <h5>
                            Instalaciones comunes
                        </h5>
                        <p>
                            Las instalaciones comunes son todas aquellas áreas con la que se cuenta.... Las instalaciones comunes son todas aquellas áreas con la que se cuenta.... Las instalaciones comunes son todas aquellas áreas con la que se cuenta.... Las instalaciones comunes son todas aquellas áreas con la que se cuenta.... Las instalaciones comunes son todas aquellas áreas con la que se cuenta.
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
                }
            });
        } );
    </script>
@endsection