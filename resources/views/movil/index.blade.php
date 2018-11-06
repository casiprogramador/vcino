@extends('layouts.admin')

@section('admin-content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Usuarios móviles</h2>
        <ol class="breadcrumb">
            <li>
                <a href="#/">Inicio</a>
            </li>
            <li>
                Propiedades
            </li>
            <li class="active">
                <strong>Lista de usuarios móviles</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5 style="padding-top: 7px;">Lista de usuarios móviles</h5>
                    <div class="ibox-tools" style="padding-bottom: 7px;">
                        <button type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Nuevo comunicado" data-original-title="Nuevo cuota por cobrar" style="margin-right: 5px;"> Nuevo usuario </button>

                    </div>
                </div>
                <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th style="vertical-align:bottom">Propiedad</th>
                                <th style="vertical-align:bottom">Nombre completo</th>
                                <th style="vertical-align:bottom"></th>
                                <th style="vertical-align:bottom">No. Móvil</th>
                                <th style="vertical-align:bottom">E-mail (usuario)</th>
                                <th style="vertical-align:bottom">Estado</th>
                                <th style="vertical-align:bottom" width="70"></th>
                            </tr>
                        </thead>
                        <tbody>
							@foreach ($users as $user)
                            <tr>
                                <td>{{ $user->property->nro }}</td>
                                <td>{{ $user->nombre }} {{ $user->apellido }}</td>
                                <td>
									@if($user->sistema == 'android')
									<i class="fa fa-android"></i>
									@elseif($user->sistema == 'ios')
									<i class="fa fa-apple"></i>
									@endif
								</td>
                                <td>{{ $user->nro_movil }} </td>
                                <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                                <td>
									@if($user->estado == 1)
									<span class="label label-primary" style="font-size: 10px; background-color: #5CBD7E">&nbsp;&nbsp;&nbsp;&nbsp;ACTIVO&nbsp;&nbsp;&nbsp;&nbsp;</span>
									@elseif($user->estado == 0 )
									<span class="label label-warning" style="font-size: 10px; background-color: #F7B77B;">&nbsp;&nbsp;INACTIVO&nbsp;&nbsp;</span>
									@elseif($user->estado == 2 )
									<span class="label label-danger" style="font-size: 10px;">ELIMINADO</span>
									@endif
                                    
                                </td>
                                <td style="vertical-align:middle; text-align:right;">
                                    <div class="btn-group">
                                        <a href="{{ route('movil.show', $user->id) }}" class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Ver usuario móvil">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('movil.edit', $user->id) }}" class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Editar usuario">
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


