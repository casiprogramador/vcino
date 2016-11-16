@extends('layouts.admin')

@section('admin-content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Teléfonos y sitios útiles</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('admin.home') }}">Inicio</a>
                </li>
                <li class="active">
                    Comunicación & Información
                </li>
                <li class="active">
                    <strong>Teléfonos y sitios útiles</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                <tr>
                                    <th style="vertical-align:bottom">Razón social/ Nombre</th>
                                    <th style="vertical-align:bottom">Categoría</th>
                                    <th style="vertical-align:bottom">Teléfono</th>
                                    <th style="vertical-align:bottom"><i class="fa fa-phone" style="color: red;"></i> Emergencia</th>
                                    <th style="vertical-align:bottom">Sitio web</th>
                                    <th width="30"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($phonesites as $phonesite)
                                    @if($phonesite->activa == 1)
                                    <tr>
                                        <td>{{$phonesite->razon_social}}</td>
                                        <td>{{$phonesite->categoria}}</td>
                                        <td>{{$phonesite->telefono}}</td>
                                        <td>{{$phonesite->telefono_emergencia}}</td>
                                        <td><a href="{{$phonesite->sitio_web}}" target="_blank">{{$phonesite->sitio_web}}</a></td>

                                        <td style="vertical-align:middle; text-align:right;">
                                            <div class="btn-group">
                                                <a href="{{ route('config.phonesite.show', $phonesite->id) }}" class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Ver detalle">
                                                    <i class="fa fa-eye"></i>
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
                "columnDefs": [ { "orderable": false, "targets": 2 }, { "orderable": false, "targets": 3 }, { "orderable": false, "targets": 4 }, { "orderable": false, "targets": 5 } ]
            });
        } );
    </script>
@endsection