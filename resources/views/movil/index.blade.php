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
                            <tr>
                                <td>3 AB</td>
                                <td>Juan Perez Rivera</td>
                                <td><i class="fa fa-android"></i></td>
                                <td>767-09878</td>
                                <td><a href="mailto:juanperez@gmail.com">juanperez@gmail.com</a></td>
                                <td>
                                    <span class="label label-primary" style="font-size: 10px; background-color: #5CBD7E">&nbsp;&nbsp;&nbsp;&nbsp;ACTIVO&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                </td>
                                <td style="vertical-align:middle; text-align:right;">
                                    <div class="btn-group">
                                        <a class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Ver usuario móvil">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Editar usuario">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                    </div>
                               </td>
                            </tr>
                            <tr>
                                <td>3 AB</td>
                                <td>Maria Fernandez de Perez</td>
                                <td><i class="fa fa-apple"></i></td>
                                <td>773-98987</td>
                                <td><a href="mailto:mariaperez@gmail.com">mariaperez@gmail.com</a></td>
                                <td>
                                    <span class="label label-warning" style="font-size: 10px; background-color: #F7B77B;">&nbsp;&nbsp;INACTIVO&nbsp;&nbsp;</span>
                                </td>
                                <td style="vertical-align:middle; text-align:right;">
                                    <div class="btn-group">
                                        <a class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Ver registro">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Editar registro">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                    </div>
                               </td>
                            </tr>
                            <tr>
                                <td>4 B</td>
                                <td>Mario Jimenez Rueda</td>
                                <td></td>
                                <td>722-81223</td>
                                <td><a href="mailto:mariojimenez@hotmail.com">mariojimenez@hotmail.com</a></td>
                                <td>
                                    <span class="label label-danger" style="font-size: 10px;">ELIMINADO</span>
                                </td>
                                <td style="vertical-align:middle; text-align:right;">
                                    <div class="btn-group">
                                        <a class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Ver registro">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Editar registro">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                    </div>
                               </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection


