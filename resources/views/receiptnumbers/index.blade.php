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
                                <tr>
                                    <td class="text-center">2016</td>
                                    <td class="text-center">42</td>
                                    <td class="text-center">16</td>
                                    <td class="text-center">4</td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn-white btn btn-xs">Editar</button>
                                        </div>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title text-left" style="padding-left: 20px;">
                        <button type="button" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="bottom" title="Nuevo" data-original-title="Nuevo" style="margin-right: 10px;"> Nuevo </button>
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