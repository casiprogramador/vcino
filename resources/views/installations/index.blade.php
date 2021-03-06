@extends('layouts.admin')

@section('admin-content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Instalaciones comunes</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('admin.home') }}">Inicio</a>
                </li>
                <li>
                    Configuración
                </li>
                <li class="active">
                    <strong>Instalaciones comunes</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-12">
                @if (Session::has('message'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {!! session('message') !!}
                    </div>
                @endif
                <div class="ibox">
					<div class="ibox-title">
                        <h5 style="padding-top: 7px;">Instalaciones comunes</h5>
                        <div class="ibox-tools" style="padding-bottom: 7px;">
                            <div class="btn-group">
                                <a href="{{ route('config.installation.create') }}" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Nueva instalación común" data-original-title="Nueva instalación común" style="margin-right: 5px;"> Nueva </a>
                            </div>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                <tr>
                                    <th style="vertical-align:bottom">Foto<br>principal</th>
                                    <th style="vertical-align:bottom">Instalación</th>
                                    <th style="vertical-align:bottom" class="text-right">Costo</th>
                                    <th style="vertical-align:bottom">Requiere <br>reserva</th>
                                    <th style="vertical-align:bottom">Estado</th>
                                    <th style="vertical-align:bottom"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($installations as $installation)
                                    @if($installation->activa == 1)
                                        <tr>
                                            <td><img src="{{ $installation->fotografia_principal }}" class="img-responsive" width="80"></td>
                                            <td>{{ $installation->instalacion }}</td>
                                            <td class="text-right">{{ number_format($installation->costo, 2, ',', '.') }}</td>
                                            <td>{{ ($installation->requiere_reserva == 1) ? 'SI' : 'NO' }}</td>
                                            <td><span>Activa</span></td>
                                            <td style="vertical-align:middle; text-align:right;">
                                                <div class="btn-group">
                                                    <a href="{{ route('config.installation.show', $installation->id) }}" class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Ver instalación común">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('config.installation.edit', $installation->id) }}" class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Editar instalación común">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td><img src="{{ $installation->fotografia_principal }}" class="img-responsive" width="80"></td>
                                            <td style="vertical-align:middle"><span class="text-muted">{{ $installation->instalacion }}</span></td>
                                            <td style="vertical-align:middle" class="text-right"><span class="text-muted">{{ number_format($installation->costo, 2, ',', '.') }}</span></td>
                                            <td style="vertical-align:middle"><span class="text-muted">{{ ($installation->requiere_reserva == 1) ? 'SI' : 'NO' }}</span></td>
                                            <td style="vertical-align:middle"><span class="text-muted">Inactiva</span></td>
                                            <td style="vertical-align:middle; text-align:right;">
                                                <div class="btn-group">
                                                    <a href="{{ route('config.installation.show', $installation->id) }}" class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Ver instalación común">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('config.installation.edit', $installation->id) }}" class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Editar instalación común">
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
                    "sZeroRecords":    "No se encontraron resultados.",
                    "sEmptyTable":     "No se encontraron instalaciones comunes.",
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
