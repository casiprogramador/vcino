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
                <strong>Avisos de cobranza</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <h5 style="padding-top: 2px;">Enviar aviso de cobranza</h5>
					<div class="ibox-tools" style="padding-bottom: 7px;">
                            <a href="{{ route('communication.communication.create') }}" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Nuevo comunicado" data-original-title="generar Avisos" style="margin-right: 10px;"> Generar aviso de pago </a>

                            <a href="{{ route('communication.register.send') }}" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Ver registro de envíos de comunicados" data-original-title="Ver registro de envíos de comunicados"> Registro de avisos enviados </a>
                    </div>
                </div>

                <div class="ibox-content">


                    <!--        LISTA DE DISTRIBUCIÓN QUE SE GENERA CON TODAS LAS PROPIEDADES EN MORA       -->
                    <div class="row">

						<div class="col-sm-12">
							 <div class="form-group">
                                <label class="col-sm-3 control-label" style="text-align: left;">Propiedad: <span style="font-weight: normal;">Todas</span></label>
                                <label class="col-sm-3 control-label" style="text-align: left;">Vencimiento: <span style="font-weight: normal;">Octubre</span></label>
                            </div>
						</div>
					</div>
					<div class="row">

						<div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="vertical-align:bottom; text-align: center;" width="50">
                                                <input type="checkbox" checked="">
                                            </th>
                                            <th style="vertical-align:bottom">Propiedad</th>
                                            <th style="vertical-align:bottom">Periodo(s)</th>
                                            <th style="vertical-align:bottom; text-align: right;">Importe total</th>
                                            <th style="vertical-align:bottom" width="50"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="text-align: center;">
<!--    TODAS MARCADAS AL INICIO    -->
<div class="icheckbox_square-green" style="position: relative;">
<input type="checkbox" class="i-checks" name="input[]" style="position: absolute; opacity: 0;">
    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 90%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">
    </ins>
</div>
                                            </td>
                                            <td>3 AB</td>
                                            <td>Agosto Septiembre</td>
                                            <td style="text-align: right;">2.200,00</td>
                                            <td style="text-align:right;">
                                                <div class="btn-group">
                                                    <a class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Ver aviso" style="margin-bottom: 0px;">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                </div>
                                           </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center;">
<!--    TODAS MARCADAS AL INICIO    -->
<div class="icheckbox_square-green" style="position: relative;">
<input type="checkbox" class="i-checks" name="input[]" style="position: absolute; opacity: 0;">
    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">
    </ins>
</div>
                                            </td>
                                            <td>4 B</td>
                                            <td>Septiembre</td>
                                            <td style="text-align: right;">900,00</td>
                                            <td style="text-align:right;">
                                                <div class="btn-group">
                                                    <a class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Ver aviso" style="margin-bottom: 0px;">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                </div>
                                           </td>

                                        </tr>
                                        <tr>
                                            <td style="text-align: center;">
<!--    TODAS MARCADAS AL INICIO    -->
<div class="icheckbox_square-green" style="position: relative;">
<input type="checkbox" class="i-checks" name="input[]" style="position: absolute; opacity: 0;">
    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">
    </ins>
</div>
                                            </td>
                                            <td>6 A</td>
                                            <td>Septiembre</td>
                                            <td style="text-align: right;">900,00</td>
                                            <td style="text-align:right;">
                                                <div class="btn-group">
                                                    <a class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Ver aviso" style="margin-bottom: 0px;">
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
                    

                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-success" type="submit"><i class="fa fa-envelope-o"></i>&nbsp;&nbsp;Enviar</button>
                            <button class="btn btn-success" type="submit"><i class="fa fa-print"></i>&nbsp;&nbsp;Imprimir</button>
                            <button class="btn btn-white" type="submit">Cancelar</button>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-1 control-label"></label>
                        <label class="col-sm-2 control-label" style="text-align: left;">Proceso de envío</label>
                        <div class="col-sm-8" style="margin-top: 5px">
                            <div class="progress">
                                <div style="width: 27%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="27" role="progressbar" class="progress-bar progress-bar-success">
                                    <span>27% Completado</span>
                                </div>
                            </div>
                        </div>
                        <label class="col-sm-1 control-label"></label>
                    </div>

                    <div class="hr-line-dashed"></div>

                    <!--    INFORME DE ENVIO        -->
                    <div class="row">
                        <div class="col-sm-1">
                        </div>
                        <div class="col-sm-10">
                            <h4 style="padding-bottom: 10px;">Informe de envío</h4>
                            <h5 style="padding-bottom: 10px;">Fecha de envío: 11/10/2016
                                <span style="margin-left: 40px;">Hora de inicio: 18:21</span>
                                <span style="margin-left: 40px;">Hora de finalización: 18:29</span></h5>
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th style="vertical-align:bottom">Propiedad</th>
                                            <th style="vertical-align:bottom">Destinatario</th>
                                            <th style="vertical-align:bottom">E-mail</th>
                                            <th style="vertical-align:bottom">Periodo(s)</th>
                                            <th style="vertical-align:bottom">Estado</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>3 AB</td>
                                            <td>Juan Perez Fernandez</td>
                                            <td>fragatatower@gmail.com</td>
                                            <td>Agosto Septiembre</td>
                                            <td class="text-danger">
                                                <i class="fa fa-lg fa-times-circle"></i>&nbsp;&nbsp;Error de envío
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4 A</td>
                                            <td>Mario Fernandez</td>
                                            <td>mariofernandez@gmail.com</td>
                                            <td>Septiembre</td>
                                            <td class="text-success">
                                                <i class="fa fa-lg fa-check-circle"></i>&nbsp;&nbsp;Envío exitoso
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
                            <button class="btn btn-success" type="submit"><i class="fa fa-print"></i>&nbsp;&nbsp;Imprimir</button>
                            <button class="btn btn-white" type="submit">Cancelar</button>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>



@endsection