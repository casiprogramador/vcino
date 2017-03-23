@extends('layouts.admin')

@section('admin-content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Tipos de propiedad</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('admin.home') }}">Inicio</a>
                </li>
                <li>
                    Configuración
                </li>
                <li class="active">
                    <strong>Tipos de propiedad</strong>
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
                        <h5 style="padding-top: 7px;">Lista de tipos de propiedad</h5>
                        <div class="ibox-tools" style="padding-bottom: 7px;">
                            <div class="btn-group">
                                <a href="{{ route('config.typeproperty.create') }}" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Nueva cuenta" data-original-title="Nueva cuenta" style="margin-right: 10px;"> Nueva </a>
                            </div>
                            <div class="btn-group">
                                <a href="#" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Imprimir lista de cuentas" data-original-title="Imprimir"><i class="fa fa-print"></i>&nbsp;&nbsp;Imprimir...</a>
                                <a href="#" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Exportar lista de cuentas" data-original-title="Imprimir" style="margin-right: 5px;"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;Exportar...</a>
                            </div>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <table class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th style="vertical-align:bottom">Tipo propiedad</th>
                                <th style="vertical-align:bottom">Estado</th>
                                <th style="vertical-align:bottom" width="70"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($typeproperties as $typeproperty)
                                @if($typeproperty->activa == 1)
                            <tr>
                                <td>{{ $typeproperty->tipo_propiedad }}</td>
                                <td><span>Activo</span></td>
                                
                                <td style="vertical-align:middle; text-align:right;">
                                    <div class="btn-group">
                                        <a href="{{ route('config.typeproperty.edit', $typeproperty->id) }}" class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Editar tipo de propiedad">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                    </div>
                               </td>
                            </tr>
                                @else
                            <tr>
                                <td>{{ $typeproperty->tipo_propiedad }}</td>
                                <td style="vertical-align:middle"><span class="text-muted">Inactiva</span></td>
                                <td style="vertical-align:middle; text-align:right;">
                                    <div class="btn-group">
                                        <a href="{{ route('config.typeproperty.edit', $typeproperty->id) }}" class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Editar tipo de propiedad">
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
                "columnDefs": [ { "orderable": false, "targets": 2 } ]
            });
        } );
    </script>
@endsection
