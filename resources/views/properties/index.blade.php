@extends('layouts.admin')

@section('admin-content')
    
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Propiedades</h2>
        <ol class="breadcrumb">
            <li>
                <a href="#/">Inicio</a>
            </li>
            <li>
                Propiedades
            </li>
            <li class="active">
                <strong>Lista de propiedades</strong>
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
                                <th style="vertical-align:bottom">Número</th>
                                <th style="vertical-align:bottom">Tipo propiedad</th>
                                <th style="vertical-align:bottom">Etiquetas</th>
                                <th style="vertical-align:bottom">Situación <br>habitacional</th>
                                <th style="vertical-align:bottom">Propietario</th>
                                <th style="vertical-align:bottom" width="110"></th>
                                <th style="vertical-align:bottom" width="70"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>3 AB</td>
                                <td>Depto. Doble</td>
                                <td>Duple</td>
                                <td>Habitado</td>
                                <td>Juan Perez Fernandez</td>
                                <td style="text-align:center;">
                                    <a href="#">Contactos (1)</a>
                                </td>
                                <td style="vertical-align:middle; text-align:right;">
                                    <div class="btn-group">
                                        <a class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Ver registro">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Editar registro">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                    </div>
                               </td>
                            </tr>
                            <tr>
                                <td>4 B</td>
                                <td>Depto. Simple</td>
                                <td>Simple</td>
                                <td>Alquilado</td>
                                <td>Maria Fernanda Jimenez</td>
                                <td style="text-align:center;">
                                    <a href="#">Contactos (3)</a>
                                </td>
                                <td style="vertical-align:middle; text-align:right;">
                                    <div class="btn-group">
                                        <a class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Ver registro">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Editar registro">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>19 PH</td>
                                <td>Penthouse</td>
                                <td>Doble</td>
                                <td>Habitado</td>
                                <td>Roberto Aguilera Jimenez</td>
                                <td style="text-align:center;">
                                    <a href="#">Contactos (2)</a>
                                </td>
                                <td style="vertical-align:middle; text-align:right;">
                                    <div class="btn-group">
                                        <a class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Ver registro">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Editar registro">
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
                "info":     false
            });
        } );
    </script>
@endsection