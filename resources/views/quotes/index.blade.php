@extends('layouts.admin')

@section('admin-content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Cuotas</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('admin.home') }}">Inicio</a>
                </li>
                <li>
                    Configuración
                </li>
                <li class="active">
                    <strong>Cuotas</strong>
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
                        <h5 style="padding-top: 7px;">Cuotas</h5>
                        <div class="ibox-tools" style="padding-bottom: 7px;">
                            <div class="btn-group">
                                <a href="{{ route('config.quota.create') }}" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Nueva cuota" data-original-title="Nueva cuota" style="margin-right: 5px;"> Nueva </a>
                            </div>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <table class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th style="vertical-align:bottom">Cuota</th>
                                <th style="vertical-align:bottom">Categoría</th>
                                <th style="vertical-align:bottom">Tipo propiedad</th>
                                <th style="vertical-align:bottom" class="text-right">Importe</th>
                                <th style="vertical-align:bottom" width="70">Estado</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($quotes as $quota)
                                @if($quota->activa == 1)
                            <tr>
                                <td>{{ $quota->cuota }}</td>
                                <td>{{ $quota->category->nombre }}</td>
                                <td>{{ $quota->typeProperty->tipo_propiedad }}</td>
                                <td style="padding-right: 30px;" class="text-right">{{ number_format($quota->importe, 2, ',', '.') }}</td>
                                <td><span>Activa</span></td>
                                
                                <td style="vertical-align:middle; text-align:right;">
                                    <div class="btn-group">
                                        <a href="{{ route('config.quota.show', $quota->id) }}" class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Ver cuota">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('config.quota.edit', $quota->id) }}" class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Editar cuota">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                                @else
                                    <tr>
                                        <td ><span class="text-muted">{{ $quota->cuota }}</span></td>
                                        <td ><span class="text-muted">{{ $quota->category->nombre }}</span></td>
                                        <td ><span class="text-muted">{{ $quota->typeProperty->tipo_propiedad }}</span></td>
                                        <td style="padding-right: 30px;" class="text-right text-muted">{{ number_format($quota->importe, 2, ',', '.') }}</td>
                                        <td><span class="text-muted">Inactiva</span></td>
                                        <td style="vertical-align:middle; text-align:right;">
                                            <div class="btn-group">
                                                <a href="{{ route('config.quota.show', $quota->id) }}" class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Ver cuota">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{ route('config.quota.edit', $quota->id) }}" class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Editar cuota">
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
                    "sZeroRecords":    "No se encontraron resultados.",
                    "sEmptyTable":     "No se encontraron cuotas.",
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
                "columnDefs": [ { "orderable": false, "targets": 4 }, { "orderable": false, "targets": 5 } ]
            });
        } );
    </script>
@endsection
