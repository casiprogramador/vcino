@extends('layouts.admin')

@section('admin-content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Equipamiento</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="#/">Inicio</a>
                </li>
                <li>
                    Equipamiento
                </li>
                <li class="active">
                    <strong>Lista de equipos y maquinaria</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-9">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>Fotografía <br>principal</th>
                                    <th>Equipo/ Maquinaria</th>
                                    <th>Tipo de equipo</th>
                                    <th>Con garantía</th>
                                    <th>Estado</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($equipments as $equipment)
                                    @if($equipment->activa == 1)
                                        <tr>
                                            <td><img src="{{ $equipment->fotografia_1 }}" class="img-responsive" width="100"></td>
                                            <td>{{ $equipment->equipo }}</td>
                                            <td>{{ $equipment->tipo_equipo }}</td>
                                            <td>{{ $equipment->garantia }} meses</td>
                                            <td><span class="text-success">Activo</span></td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        Opciones
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                        <li><a href="{{ route('equipment.machinery.show', $equipment->id) }}">Ver Equipo</a></li>
                                                        <li><a href="{{ route('equipment.machinery.edit', $equipment->id) }}">Editar Equipo</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td><img src="{{ $equipment->fotografia_1 }}" class="img-responsive" width="100"></td>
                                            <td><span class="text-muted">{{ $equipment->equipo }}</span></td>
                                            <td><span class="text-muted">{{ $equipment->tipo_equipo }}</span></td>
                                            <td><span class="text-muted">{{ $equipment->garantia }} meses</span></td>
                                            <td><span class="text-danger">Inactiva</span></td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        Opciones
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                        <li><a href="{{ route('equipment.machinery.show', $equipment->id) }}">Ver Equipo</a></li>
                                                        <li><a href="{{ route('equipment.machinery.edit', $equipment->id) }}">Editar Equipo</a></li>
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
                        <a href="{{ route('equipment.machinery.create') }}" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="bottom" title="Nuevo equipo" data-original-title="Nuevo equipo" style="margin-right: 10px;"> Nuevo </a>
                        <button type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Imprimir..." data-original-title="Imprimir..." style="margin-right: 10px;"> <i class="fa fa-print fa-lg"></i> </button>
                        <button type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Exportar" data-original-title="Exportar"> <i class="fa fa-file-excel-o fa-lg"></i> </button>
                    </div>
                    <div class="ibox-content">
                        <h5>
                            Equipos y maquinaria
                        </h5>
                        <p>
                            Se refieren a todo el equipamiento instalado en el lugar que cumple una función y requiere ser mantenido, ya sea preventivamente o de forma periódica. Son todos aquellos equipos necesarios que cumplen una función...
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