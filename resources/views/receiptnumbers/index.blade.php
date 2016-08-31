@extends('layouts.admin')

@section('admin-content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Números de comprobantes</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="#/">Inicio</a>
                </li>
                <li>
                    Configuración
                </li>
                <li class="active">
                    <strong>Números de comprobantes</strong>
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
                                    <th class="text-center">Gestión</th>
                                    <th class="text-center">C. Ingreso</th>
                                    <th class="text-center">C. Egreso</th>
                                    <th class="text-center">C. Traspaso</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($receiptnumbers as $receiptnumber)
                                        <tr>
                                            <td class="text-center">{{$receiptnumber->gestion}}</td>
                                            <td class="text-center">{{$receiptnumber->ingreso}}</td>
                                            <td class="text-center">{{$receiptnumber->egreso}}</td>
                                            <td class="text-center">{{$receiptnumber->traspaso}}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        Opciones
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                        <li><a href="{{ route('config.receiptnumber.edit', $receiptnumber->id) }}">Editar Comprobante</a></li>
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
                        <a class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="bottom" title="Nuevo" data-original-title="Nuevo" style="margin-right: 10px;" href="{{ route('config.receiptnumber.create') }}"> Nuevo </a>
                        <button type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Imprimir..." data-original-title="Imprimir..." style="margin-right: 10px;"> <i class="fa fa-print fa-lg"></i> </button>
                    </div>
                    <div class="ibox-content">
                        <h5>
                            Números de comprobantes
                        </h5>
                        <p>
                            Son los números únicos y correlativos para cada gestión utilizados en cada transacción realizada. Transacciones para registrar ingresos, egresos y operaciones de traspasos. Para cada gestión.
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