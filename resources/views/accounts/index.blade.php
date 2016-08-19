@extends('layouts.admin')

@section('admin-content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Cuentas</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('admin.home') }}">Inicio</a>
                </li>
                <li class="active">
                    <strong><a href="{{ route('config.account.index') }}">Cuentas</a></strong>
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
                            @foreach ($accounts as $account)
                                @if($account->activa == 1)
                                <tr>
                                    <td>{{ $account->nombre }}</td>
                                    <td>{{ $account->nro_cuenta }}</td>
                                    <td>{{ $account->tipo_cuenta }}</td>
                                    <td>
                                            <p><span class="text-success">Activa</span></p>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Opciones
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                <li><a href="{{ route('config.account.show', $account->id) }}">Ver Cuenta</a></li>
                                                <li><a href="{{ route('config.account.edit', $account->id) }}">Editar Cuenta</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @else
                                    <tr>
                                        <td><span class="text-muted">{{ $account->nombre }}</span></td>
                                        <td><span class="text-muted">{{ $account->nro_cuenta }}</span></td>
                                        <td><span class="text-muted">{{ $account->tipo_cuenta }}</span></td>
                                        <td>
                                                <p><span class="text-danger">Inactiva</span></p>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    Opciones
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                    <li><a href="{{ route('config.account.show', $account->id) }}">Ver Cuenta</a></li>
                                                    <li><a href="{{ route('config.account.edit', $account->id) }}">Editar Cuenta</a></li>
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
                    <div class="ibox-title text-center">
                        <a href="{{ route('config.account.create') }}" class="btn btn-sm btn-success" > Nueva </a>
                        <button type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Imprimir lista de Cuentas..." data-original-title="Imprimir lista de Cuentas..." style="margin-right: 10px;"> <i class="fa fa-print fa-lg"></i> </button>
                        <button type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Exportar Cuentas" data-original-title="Exportar Cuentas"> <i class="fa fa-file-excel-o fa-lg"></i> </button>
                    </div>
                    <div class="ibox-content">
                        <h5>
                            Cuentas
                        </h5>
                        <p>
                            Usted puede ver los detalles completos de cualquiera de sus cuentas
                        </p>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection