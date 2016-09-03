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
                                <tr>
                                    <td><img src="img/equipo1.jpg" class="img-responsive" width="100"></td>
                                    <td>Bomba impulsora tanque sisterna</td>
                                    <td>Equipo</td>
                                    <td>Si (2 meses)</td>
                                    <td><span class="text-success">Activo</span></td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn-white btn btn-xs">Ver</button>
                                            <button class="btn-white btn btn-xs">Editar</button>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td><img src="img/instalacion1.jpg" class="img-responsive" width="100"></td>
                                    <td>Tanque elevado cisterna</td>
                                    <td>Instalaciones</td>
                                    <td>No aplica</td>
                                    <td><span class="text-success">Activo</span></td>
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