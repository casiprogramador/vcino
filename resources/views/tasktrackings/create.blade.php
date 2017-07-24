@extends('layouts.admin')

@section('admin-content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Tareas</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.home') }}">Inicio</a>
            </li>
            <li>
                Tareas & Solicitudes
            </li>
            <li>
                <a href="#">Tareas</a>
            </li>
            <li class="active">
                <strong>Seguimiento</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content" style="background-color: #f9f9f9;">                
                    <form method="get" class="form-horizontal">
                        <div class="form-group" style="margin-bottom: 0px;">
                            <label class="col-sm-2 control-label">Fecha:</label>
                            <div class="col-sm-4">
                                <p class="form-control-static">12/05/2017</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="form-control-static pull-right">
                                    <span class="label label-success" style="background-color: #5D96CC">&nbsp;EN PROCESO&nbsp;</span>
                                </p>
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom: 0px;">
                            <label class="col-sm-2 control-label">Tipo:</label>
                            <div class="col-sm-4">
                                <p class="form-control-static">Solicitudes recibidas</p>
                            </div>
                            <label class="col-sm-2 control-label">Solicitada por:</label>
                            <div class="col-sm-4">
                                <p class="form-control-static">Caoba 01 - Jaime Perez</p>
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom: 0px;">
                            <label class="col-sm-2 control-label">Tarea:</label>
                            <div class="col-sm-10">
                                <p class="form-control-static"><strong>Nombre de la tarea nombre de la tarea</strong></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5 style="padding-top: 2px;">Nuevo seguimiento</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">    
                    <div class="col-sm-12">
                        <form role="form">

                            <div class="form-group">
                                <label class="font-normal">Fecha</label>
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="03/05/2017">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="font-normal">Descripción</label>
                                <div style="border:1px solid #E1E2E4;">
                                    <summernote config="summerNoteOptions" height="300"></summernote>
                                    <div class="summernote" style="padding: 5px 10px;">
                                        <p>Este cuerpo con Summernote</p>
                                        <ul>
                                            <li>Remaining essentially unchanged</li>
                                            <li>Make a type specimen book</li>
                                            <li>Unknown printer</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="font-normal">Adjunto</label>
                                <div class="fileinput input-group fileinput-new" data-provides="fileinput">
                                    <div class="form-control" data-trigger="fileinput">
                                        <i class="glyphicon glyphicon-file fileinput-exists"></i> 
                                        <span class="fileinput-filename"></span>
                                    </div>
                                    <span class="input-group-addon btn btn-default btn-file">
                                        <span class="fileinput-new">Seleccionar archivo...</span>
                                        <span class="fileinput-exists">Cambiar</span>
                                        <input type="hidden" value=""><input type="file" name="adjunto[]">
                                    </span>
                                    <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Eliminar</a>
                                </div>
                            </div>

                            <div class="form-group" style="margin-top: 20px;">
                                <label class="font-normal">Creado por:&nbsp;&nbsp;</label>
                                    <span style="font-weight: normal;">Nombre Apellido</span>
                                </label>
                            </div>

                            <div class="form-group" style="margin-top: 20px;">
                                <label class="font-normal">
                                <div class="icheckbox_square-green" style="position: relative;">
                                    <input type="checkbox" class="i-checks" name="activa" value="1" style="position: absolute; opacity: 0;" checked>
                                </div>&nbsp;&nbsp;&nbsp;Notificar respuesta</label>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <button class="btn btn-success" type="submit" style="margin-right: 10px;">Crear seguimiento</button>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="row">

                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5 style="padding-top: 2px;">
                            <span style="font-weight: normal">Creado por:</span> Administrador
                            </h5>
                            <h5 class="pull-right" style="margin-right: 10px;">12/05/2017</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="row">    
                            <div class="col-sm-12">
                                <form role="form">
                                    <div class="form-group">
                                        <label class="font-normal">Descripción</label>
                                        <div style="background-color: #f9f9f9;">
                                            <div style="padding: 5px 10px;">
                                                <p>Este cuerpo con Summernote</p>
                                                <ul>
                                                    <li>Remaining essentially unchanged</li>
                                                    <li>Make a type specimen book</li>
                                                    <li>Unknown printer</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="file-box">
                                                <div class="file">
                                                    <a href="#">
                                                        <div class="image">
                                                            <img alt="image" class="img-responsive" src="http://webapplayers.com/inspinia_admin-v2.7/img/p1.jpg">
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>

                                    <div class="form-group" style="margin-top: 20px;">
                                        <label class="font-normal">
                                        <div class="icheckbox_square-green" style="position: relative;">
                                            <input type="checkbox" class="i-checks" name="activa" value="1" style="position: absolute; opacity: 0;" checked disabled="disabled">
                                        </div>&nbsp;&nbsp;&nbsp;Notificar respuesta</label>
                                    </div>
                                    
                                    <div class="hr-line-dashed"></div>

                                    <div class="form-group">
                                        <button class="btn btn-default" type="submit" style="margin-right: 10px;">Editar</button>
                                    </div>
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5 style="padding-top: 2px;">
                            <span style="font-weight: normal">Creado por:</span> Caoba 01 - Jaime Perez
                            </h5>
                            <h5 class="pull-right" style="margin-right: 10px;">07/05/2017</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="row">    
                            <div class="col-sm-12">
                                <form role="form">
                                    <div class="form-group">
                                        <label class="font-normal">Descripción</label>
                                        <div style="background-color: #f9f9f9;">
                                            <div style="padding: 5px 10px;">
                                                <p>Esd alksdjf alksdfj laksdfj laksdjf lkddsjf asdjf  
                                                asdfj alsdkfj lkadsj flaksdjf lakdjf lakjd flakdsj flkjsd
                                                 as dfdjkas flkadsj flkasjdflkasj dflkasjd</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>

                                    <div class="form-group" style="margin-top: 20px;">
                                        <label class="font-normal">
                                        <div class="icheckbox_square-green" style="position: relative;">
                                            <input type="checkbox" class="i-checks" name="activa" value="1" style="position: absolute; opacity: 0;" checked disabled="disabled">
                                        </div>&nbsp;&nbsp;&nbsp;Notificar respuesta</label>
                                    </div>
                                    
                                    <div class="hr-line-dashed"></div>

                                    <div class="form-group">
                                        <button class="btn btn-default" type="submit" style="margin-right: 10px;">Editar</button>
                                    </div>
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5 style="padding-top: 2px;">
                            <span style="font-weight: normal">Creado por:</span> Administrador
                            </h5>
                            <h5 class="pull-right" style="margin-right: 10px;">21/04/2017</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="row">    
                            <div class="col-sm-12">
                                <form role="form">
                                    <div class="form-group">
                                        <label class="font-normal">Descripción</label>
                                        <div style="background-color: #f9f9f9;">
                                            <div style="padding: 5px 10px;">
                                                <p>daf dsf adsf dsfdf adsf adf adsf adsf adsds.</p>
                                                <p>dfg fg fg sfgsdf gsfdg fdaf dsf adsf dsfdf adsf adf adsf adsf adsds.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>

                                    <div class="form-group" style="margin-top: 20px;">
                                        <label class="font-normal">
                                        <div class="icheckbox_square-green" style="position: relative;">
                                            <input type="checkbox" class="i-checks" name="activa" value="1" style="position: absolute; opacity: 0;" checked disabled="disabled">
                                        </div>&nbsp;&nbsp;&nbsp;Notificar respuesta</label>
                                    </div>
                                    
                                    <div class="hr-line-dashed"></div>

                                    <div class="form-group">
                                        <button class="btn btn-default" type="submit" style="margin-right: 10px;">Editar</button>
                                    </div>
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>

    </div>
</div>

@endsection

