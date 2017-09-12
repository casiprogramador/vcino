@extends('layouts.admin')

@section('admin-content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Registro de mantenimiento</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.home') }}">Inicio</a>
            </li>
            <li>
                Equipamiento
            </li>
            <li class="active">
                <strong>Registro de mantenimiento</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">

            <div class="ibox">
                <div class="ibox-title">
                    <h5 style="padding-top: 7px;">Registro de mantenimiento</h5>
                    <div class="ibox-tools" style="padding-bottom: 7px; padding-right: 5px;">
                        <div class="btn-group">
							<a href="{{ route('equipment.maintenancerecord.create') }}" type="button" class="btn btn-sm btn-default">Nuevo</a>
                        </div>
                    </div>
                </div>
                <div class="ibox-content">

                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th style="vertical-align:bottom">Fecha</th>
                                <th style="vertical-align:bottom">Equipo/ Maquinaria</th>
                                <th style="vertical-align:bottom">Tipo</th>
                                <th style="vertical-align:bottom">Costo</th>
                                <th style="vertical-align:bottom" width="200"></th>
                            </tr>
                        </thead>
                        <tbody>
							@foreach ($maintenancerecords as $maintenancerecord)
                            <tr>
                                <td style="vertical-align: middle;">{{ date_format(date_create($maintenancerecord->fecha_realizacion),'d/m/Y') }}</td>
                                <td style="vertical-align: middle;">{{$maintenancerecord->equipment->equipo}}</td>
                                <td style="vertical-align: middle;">{{$maintenancerecord->tipo}}</td>
                                <td style="vertical-align: middle;">{{$maintenancerecord->costo}}</td>
                                <td style="vertical-align:middle; text-align:right;">
                                    <div class="btn-group">
                                        <a href="" class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Ver registro de mantenimiento">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="" class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Editar registro de mantenimiento">
                                            <i class="fa fa-pencil"></i>
                                        </a>
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

    </div>

</div>



@endsection


