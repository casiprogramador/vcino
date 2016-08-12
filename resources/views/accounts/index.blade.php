@extends('layouts.admin')

@section('admin-content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Cuentas</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="#/">Inicio</a>
                </li>
                <li>
                    Configuración
                </li>
                <li class="active">
                    <strong>Lista de cuentas</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-9">
                <div class="ibox">
                    <div class="ibox-content">
                        <table class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th>Nombre cuenta</th>
                                <th>Número</th>
                                <th>Tipo de cuenta</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Caja general</td>
                                <td></td>
                                <td>Efectivo</td>
                                <td><span class="text-success">Activa</span></td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn-white btn btn-xs">Ver</button>
                                        <button class="btn-white btn btn-xs">Editar</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>C.C. Ganadero No. 1310146136</td>
                                <td>1310-146136</td>
                                <td>Cuenta corriente</td>
                                <td><span class="text-success">Activa</span></td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn-white btn btn-xs">Ver</button>
                                        <button class="btn-white btn btn-xs">Editar</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="text-muted">C.C. BISA No. 301-2203</span></td>
                                <td><span class="text-muted">301-2203</span></td>
                                <td><span class="text-muted">Cuenta corriente</span></td>
                                <td><span class="text-danger">Inactiva</span></td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn-white btn btn-xs">Ver</button>
                                        <button class="btn-white btn btn-xs">Editar</button>
                                    </div>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title text-center">
                        <button type="button" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="bottom" title="Nueva Cuenta" data-original-title="Nueva Cuenta" style="margin-right: 10px;"> Nueva </button>
                        <button type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Imprimir lista de Cuentas..." data-original-title="Imprimir lista de Cuentas..." style="margin-right: 10px;"> <i class="fa fa-print fa-lg"></i> </button>
                        <button type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Exportar Cuentas" data-original-title="Exportar Cuentas"> <i class="fa fa-file-excel-o fa-lg"></i> </button>
                    </div>
                    <div class="ibox-content">
                        <h5>
                            Cuentas
                        </h5>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitat.
                        </p>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection