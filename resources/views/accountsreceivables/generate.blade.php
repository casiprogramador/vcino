@extends('layouts.admin')

@section('admin-content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Transacciones</h2>
        <ol class="breadcrumb">
            <li>
                <a href="#/">Inicio</a>
            </li>
            <li>
                Transacciones
            </li>
            <li class="active">
                <strong>Generar cuotas por cobrar</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <h5 style="padding-top: 2px;">Generar cuotas por cobrar</h5>
                </div>

                <div class="ibox-content">
                    <form method="get" class="form-horizontal">

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Gestión</label>
                            <div class="col-sm-2">
                                <select class="form-control input-sm" name="tipo-cuenta">
                                    <option>2016</option>
                                    <option>2017</option>
                                    <option>2018</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Periodo</label>
                            <div class="col-sm-3">
                                <select class="form-control input-sm" name="tipo-cuenta">
                                    <option value="1">Enero</option>
                                    <option value="2">Febrero</option>
                                    <option value="3">Marzo</option>
                                    <option value="4">Abril</option>
                                    <option value="5">Mayo</option>
                                    <option value="6">Junio</option>
                                    <option value="7">Julio</option>
                                    <option value="8">Agosto</option>
                                    <option value="9">Septiembre</option>
                                    <option value="10">Octubre</option>
                                    <option value="11">Noviembre</option>
                                    <option value="12">Diciembre</option>
                                </select>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-success" type="submit">Generar cuotas por cobrar</button>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="row">
                            <div class="col-sm-1">
                            </div>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="text-align: left;">Gestión: <span style="font-weight: normal;">2016</span></label>
                                    <label class="col-sm-3 control-label" style="text-align: left;">Periodo: <span style="font-weight: normal;">Octubre</span></label>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="vertical-align:bottom">Propiedad</th>
                                                <th style="vertical-align:bottom">Cuota</th>
                                                <th style="vertical-align:bottom">Vencimiento</th>
                                                <th style="vertical-align:bottom; text-align: right;">Importe por cobrar</th>
                                                <th style="vertical-align:bottom">Cancelada</th>
                                                <th style="vertical-align:bottom" width="50"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>3 AB</td>
                                                <td>Expensas: Dobles</td>
                                                <td>15/11/2016</td>
                                                <td class="text-success" style="cursor: pointer; text-align: right;">1.100,00</td>
                                                <td>

<div class="icheckbox_square-green" style="position: relative;">
    <input type="checkbox" class="i-checks" name="input[]" style="position: absolute; opacity: 0;">
        <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 90%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">
        </ins>
</div>

                                                </td>
                                                <td style="text-align:right;">
                                                    <div class="btn-group">
                                                        <a class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Eliminar" style="margin-bottom: 0px;">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </div>
                                               </td>
                                            </tr>
                                            <tr>
                                                <td>4 B</td>
                                                <td>Expensas: Simples</td>
                                                <td>15/11/2016</td>
                                                <td class="text-success" style="cursor: pointer; text-align: right;">900,00</td>
                                                <td>

<div class="icheckbox_square-green" style="position: relative;">
    <input type="checkbox" class="i-checks" name="input[]" style="position: absolute; opacity: 0;">
        <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">
        </ins>
</div>
                                                </td>
                                                <td style="text-align:right;">
                                                    <div class="btn-group">
                                                        <a class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Eliminar" style="margin-bottom: 0px;">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </div>
                                               </td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-sm-1">
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-success" type="submit">Guardar</button>
                                <button class="btn btn-white" type="submit">Cancelar</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

