@extends('layouts.admin')

@section('admin-content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Instalaciones comunes</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="#/">Inicio</a>
                </li>
                <li>
                    Configuración
                </li>
                <li class="active">
                    <strong>Lista de instalaciones comunes</strong>
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
                                    <th>Instalación</th>
                                    <th>Costo</th>
                                    <th>Requiere <br>reserva</th>
                                    <th>Estado</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><img src="img/Salon-Eventos.jpg" class="img-responsive" width="100"></td>
                                    <td>Salón de eventos principal, piso 5</td>
                                    <td>350,00</td>
                                    <td>Si</td>
                                    <td><span class="text-success">Activo</span></td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn-white btn btn-xs">Ver</button>
                                            <button class="btn-white btn btn-xs">Editar</button>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td><img src="img/Gimnasio.jpg" class="img-responsive" width="100"></td>
                                    <td>Gimnasio, piso 5</td>
                                    <td>0,00</td>
                                    <td>No</td>
                                    <td><span class="text-success">Activo</span></td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn-white btn btn-xs">Ver</button>
                                            <button class="btn-white btn btn-xs">Editar</button>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td><img src="img/Piscina.jpg" class="img-responsive" width="100"></td>
                                    <td>Piscina</td>
                                    <td>0,00</td>
                                    <td>No</td>
                                    <td><span class="text-success">Activo</span></td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn-white btn btn-xs">Ver</button>
                                            <button class="btn-white btn btn-xs">Editar</button>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td><img src="img/demo.png" class="img-responsive" width="100"></td>
                                    <td>Salón de reuniones piso 1</td>
                                    <td>0,00</td>
                                    <td>No</td>
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
                        <a href="{{ route('config.installation.create') }}" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="bottom" title="Nueva Instalacion comun" data-original-title="Nueva instalacion comun" style="margin-right: 10px;"> Nueva </a>
                        <button type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Imprimir..." data-original-title="Imprimir..." style="margin-right: 10px;"> <i class="fa fa-print fa-lg"></i> </button>
                        <button type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Exportar" data-original-title="Exportar"> <i class="fa fa-file-excel-o fa-lg"></i> </button>
                    </div>
                    <div class="ibox-content">
                        <h5>
                            Instalaciones comunes
                        </h5>
                        <p>
                            Las instalaciones comunes son todas aquellas áreas con la que se cuenta.... Las instalaciones comunes son todas aquellas áreas con la que se cuenta.... Las instalaciones comunes son todas aquellas áreas con la que se cuenta.... Las instalaciones comunes son todas aquellas áreas con la que se cuenta.... Las instalaciones comunes son todas aquellas áreas con la que se cuenta.
                        </p>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection