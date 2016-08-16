@extends('layouts.admin')

@section('admin-content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Categorías</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="#/">Inicio</a>
                </li>
                <li>
                    Configuración
                </li>
                <li class="active">
                    <strong>Lista de categorias</strong>
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
                                <th colspan="2">Categoría</th>
                                <th>Tipo</th>
                                <th>Ordinaria/ Extraordinaria</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td style="vertical-align:middle"><img src="files/icon/icon-cat-cuota-mensual.png" width="30"></td>
                                <td style="vertical-align:middle">Cuota mensual</td>
                                <td style="vertical-align:middle">Ingreso</td>
                                <td style="vertical-align:middle">Ordinaria</td>
                                <td style="vertical-align:middle"><span class="text-success">Activa</span></td>
                                <td style="vertical-align:middle">
                                    <div class="btn-group">
                                        <button class="btn-white btn btn-xs">Ver</button>
                                        <button class="btn-white btn btn-xs">Editar</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align:middle"><img src="files/icon/icon-cat-administracion.png" width="30"></td>
                                <td style="vertical-align:middle">Administración</td>
                                <td style="vertical-align:middle">Egreso</td>
                                <td style="vertical-align:middle">Ordinaria</td>
                                <td style="vertical-align:middle"><span class="text-success">Activa</span></td>
                                <td style="vertical-align:middle">
                                    <div class="btn-group">
                                        <button class="btn-white btn btn-xs">Ver</button>
                                        <button class="btn-white btn btn-xs">Editar</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align:middle"><img src="files/icon/icon-cat-gastos-bancarios.png" width="30"></td>
                                <td style="vertical-align:middle">Gastos bancarios</td>
                                <td style="vertical-align:middle">Egreso</td>
                                <td style="vertical-align:middle">Ordinaria</td>
                                <td style="vertical-align:middle"><span class="text-success">Activa</span></td>
                                <td style="vertical-align:middle">
                                    <div class="btn-group">
                                        <button class="btn-white btn btn-xs">Ver</button>
                                        <button class="btn-white btn btn-xs">Editar</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align:middle"><img src="files/icon/icon-cat-material-escritorio.png" width="28"></td>
                                <td style="vertical-align:middle">Material de escritorio</td>
                                <td style="vertical-align:middle">Egreso</td>
                                <td style="vertical-align:middle">Ordinaria</td>
                                <td style="vertical-align:middle"><span class="text-success">Activa</span></td>
                                <td style="vertical-align:middle">
                                    <div class="btn-group">
                                        <button class="btn-white btn btn-xs">Ver</button>
                                        <button class="btn-white btn btn-xs">Editar</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align:middle"><img src="files/icon/icon-cat-productos-limpieza.png" width="28"></td>
                                <td style="vertical-align:middle">Materiales e insumos limpieza</td>
                                <td style="vertical-align:middle">Egreso</td>
                                <td style="vertical-align:middle">Ordinaria</td>
                                <td style="vertical-align:middle"><span class="text-success">Activa</span></td>
                                <td style="vertical-align:middle">
                                    <div class="btn-group">
                                        <button class="btn-white btn btn-xs">Ver</button>
                                        <button class="btn-white btn btn-xs">Editar</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align:middle"><img src="files/icon/icon-cat-mantenimiento-piscina.png" width="28"></td>
                                <td style="vertical-align:middle"><span class="text-muted">Mantenimiento piscina</span></td>
                                <td style="vertical-align:middle"><span class="text-muted">Egreso</span></td>
                                <td style="vertical-align:middle"><span class="text-muted">Ordinaria</span></td>
                                <td style="vertical-align:middle"><span class="text-danger">Inactiva</span></td>
                                <td style="vertical-align:middle">
                                    <div class="btn-group">
                                        <button class="btn-white btn btn-xs">Ver</button>
                                        <button class="btn-white btn btn-xs">Editar</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align:middle"><img src="files/icon/icon-cat-acceso-internet.png" width="28"></td>
                                <td style="vertical-align:middle">Servicio de acceso a Internet</td>
                                <td style="vertical-align:middle">Egreso</td>
                                <td style="vertical-align:middle">Ordinaria</td>
                                <td style="vertical-align:middle"><span class="text-success">Activa</span></td>
                                <td style="vertical-align:middle">
                                    <div class="btn-group">
                                        <button class="btn-white btn btn-xs">Ver</button>
                                        <button class="btn-white btn btn-xs">Editar</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align:middle"><img src="files/icon/icon-cat-obras-reparaciones.png" width="28"></td>
                                <td style="vertical-align:middle">Obras y reparaciones</td>
                                <td style="vertical-align:middle">Egreso</td>
                                <td style="vertical-align:middle">Extraordinaria</td>
                                <td style="vertical-align:middle"><span class="text-success">Activa</span></td>
                                <td style="vertical-align:middle">
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
                    <div class="ibox-title text-left" style="padding-left: 20px;">
                        <button type="button" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="bottom" title="Nueva Cuenta" data-original-title="Nueva Cuenta" style="margin-right: 10px;"> Nueva </button>
                        <button type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Imprimir lista de Cuentas..." data-original-title="Imprimir lista de Cuentas..." style="margin-right: 10px;"> <i class="fa fa-print fa-lg"></i> </button>
                        <button type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Exportar Cuentas" data-original-title="Exportar Cuentas"> <i class="fa fa-file-excel-o fa-lg"></i> </button>
                    </div>
                    <div class="ibox-content">
                        <h5>
                            Categorías
                        </h5>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitat.
                        </p>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitat.
                        </p>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection