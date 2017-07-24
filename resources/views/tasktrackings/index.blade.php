@extends('layouts.admin')

@section('admin-content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Tareas</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.home') }}">Inicio</a
                Ceo
                  >
            </li>
            <li>
                Tareas & Solicitudes
            </li>
            <li class="active">
                <strong>Lista de seguimiento a tareas</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">

            <div class="ibox">
                <div class="ibox-title">
                    <h5 style="padding-top: 2px;">Lista de seguimiento a tareas</h5>
                </div>
                <div class="ibox-content">

                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th style="vertical-align:bottom">Fecha Seg.</th>
                                <th style="vertical-align:bottom">Tarea</th>
                                <th style="vertical-align:bottom">Tipo</th>
                                <th style="vertical-align:bottom">Creado por</th>
                                <th style="vertical-align:bottom" width="150"></th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>15/05/2017</td>
                                <td>Cotizar pintado de área social piso 5 (30/04/2017)</td>
                                <td>Solicitudes recibidas</td>
                                <td>101 - Mario Fernandez</td>
                                <td style="vertical-align:middle; text-align:right;">
                                    <div class="btn-group">
                                        <a href="" class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Ver seguimiento tarea">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </div>
                               </td>
                            </tr>

                            <tr>
                                <td>10/05/2017</td>
                                <td>Mantenimiento a porton de ingreso (02/05/2017)</td>
                                <td>Mis tareas</td>
                                <td>Administración</td>
                                <td style="vertical-align:middle; text-align:right;">
                                    <div class="btn-group">
                                        <a href="" class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Ver seguimiento tarea">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </div>
                               </td>
                            </tr>

                            <tr>
                                <td>29/04/2017</td>
                                <td>Filtración en baño depto 101 (28/04/2017)</td>
                                <td>Reclamo</td>
                                <td>Caoba 04 - Juan Perez</td>
                                <td style="vertical-align:middle; text-align:right;">
                                    <div class="btn-group">
                                        <a href="" class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Ver seguimiento tarea">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </div>
                               </td>
                            </tr>

                            <tr>
                                <td>21/04/2017</td>
                                <td>Exceso de velocidad de algunas visitas en horas de la noche (21/04/2017)</td>
                                <td>Reclamo</td>
                                <td>Administración</td>
                                <td style="vertical-align:middle; text-align:right;">
                                    <div class="btn-group">
                                        <a href="" class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Ver seguimiento tarea">
                                            <i class="fa fa-eye"></i>
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