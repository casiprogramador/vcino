@extends('layouts.admin')

@section('admin-content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Categorías</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('admin.home') }}">Inicio</a>
                </li>
                <li class="active">
                    <strong><a href="{{ route('config.category.index') }}">Categorias</a></strong>
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
                            @foreach ($categories as $category)
                                @if($category->activa == 1)
                                    <tr>
                                        <td style="vertical-align:middle"><img src="{{ $category->icono }}" width="30"></td>
                                        <td style="vertical-align:middle">{{ $category->nombre }}</td>
                                        <td style="vertical-align:middle">{{ $category->tipo_categoria }}</td>
                                        <td style="vertical-align:middle">{{ $category->clase }}</td>
                                        <td style="vertical-align:middle"><span class="text-success">Activa</span></td>
                                        <td style="vertical-align:middle">
                                            <div class="dropdown">
                                                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    Opciones
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                    <li><a href="{{ route('config.category.show', $category->id) }}">Ver Categoria</a></li>
                                                    <li><a href="{{ route('config.category.edit', $category->id) }}">Editar Categoria</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td style="vertical-align:middle"><img src="{{ $category->icono }}" width="28"></td>
                                        <td style="vertical-align:middle"><span class="text-muted">{{ $category->nombre }}</span></td>
                                        <td style="vertical-align:middle"><span class="text-muted">Egreso</span></td>
                                        <td style="vertical-align:middle"><span class="text-muted">Ordinaria</span></td>
                                        <td style="vertical-align:middle"><span class="text-danger">Inactiva</span></td>
                                        <td style="vertical-align:middle">
                                            <div class="dropdown">
                                                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    Opciones
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                    <li><a href="{{ route('config.category.show', $category->id) }}">Ver Categoria</a></li>
                                                    <li><a href="{{ route('config.category.edit', $category->id) }}">Editar Categoria</a></li>
                                                </ul>
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

            <div class="col-md-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title text-left" style="padding-left: 20px;">
                        <a href="{{ route('config.category.create') }}" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="bottom" title="Nueva Cuenta" data-original-title="Nueva Cuenta" style="margin-right: 10px;"> Nueva </a>
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