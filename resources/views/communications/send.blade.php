@extends('layouts.admin')

@section('admin-content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Comunicados</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="#/">Inicio</a>
                </li>
                <li>
                    Comunicación & Información
                </li>
                <li>
                    <a href="#">Lista de comunicados</a>
                </li>
                <li class="active">
                    <strong>Enviar comunicado</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">

                <div class="ibox float-e-margins">

                    <div class="ibox-title">
                        <h5 style="padding-top: 2px;">Enviar comunicado</h5>
                    </div>

                    <div class="ibox-content">

                        <form method="get" class="form-horizontal">

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Comunicado</label>
                                <div class="col-sm-9">
                                    <select class="form-control input-sm" name="comunicado">
                                        <option>29/04/2016 - Asunto del comunicado 4</option>
                                        <option>20/04/2016 - Asunto del comunicado 3</option>
                                        <option>10/04/2016 - Asunto del comunicado 2</option>
                                        <option>21/03/2016 - Asunto del comunicado 1</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Remitente</label>
                                <div class="col-sm-5">
                                    <select class="form-control input-sm" name="comunicado">
                                        <option value="todos">Administración</option>
                                        <option value="copropietarios">Directorio</option>
                                        <option value="inquilinos">Sin remitente</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Dirigido a</label>
                                <div class="col-sm-5">
                                    <select class="form-control input-sm" name="comunicado">
                                        <option value="todos">Todos los contactos</option>
                                        <option value="copropietarios">Copropietarios</option>
                                        <option value="inquilinos">Inquilinos</option>
                                        <option value="directorio">Directorio</option>
                                        <option value="propiedad">Seleccionar propiedad</option>
                                        <option value="contacto">Seleccionar contacto(s)</option>
                                        <option value="correo">Dirección de E-mail</option>
                                        <option value="prueba">Prueba de envío</option>
                                    </select>
                                </div>
                            </div>


                            <!--    ESTE SELECT PARA: Seleccionar propiedad             -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Propiedad</label>
                                <div class="col-sm-5">
                                    <select class="form-control input-sm" name="propiedad">
                                        <option value="codigo1">Numero propiedad 1</option>
                                        <option value="codigo2">Numero propiedad 2</option>
                                        <option value="codigo2">Numero propiedad 3</option>
                                        <option value="codigo2">Numero propiedad 4</option>
                                        <option value="codigo2">Numero propiedad 5</option>
                                        <option value="codigo2">Numero propiedad 6</option>
                                    </select>
                                </div>
                            </div>


                            <!--    ESTE SELECT PARA: Seleccionar contacto(s)             -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Destinatario</label>
                                <div class="col-sm-8">
                                    <select data-placeholder="Seleccione destinatario" class="chosen-select" multiple style="width: 550px;" tabindex="5">
                                        <option value="codigo1">Numero propiedad - Nombre apellido</option>
                                        <option value="codigo2">Numero propiedad - Nombre apellido</option>
                                        <option value="codigo3">Numero propiedad - Nombre apellido</option>
                                        <option value="codigo4">Numero propiedad - Nombre apellido</option>
                                        <option value="codigo5">Numero propiedad - Nombre apellido</option>
                                        <option value="codigo6">Numero propiedad - Nombre apellido</option>
                                        <option value="codigo7">Numero propiedad - Nombre apellido</option>
                                    </select>
                                </div>
                            </div>


                            <!--    ESTE SELECT PARA: Dirección de correo                -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Dirección de correo</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control input-sm">
                                </div>
                            </div>


                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Proceso de envío</label>
                                <div class="col-sm-9" style="margin-top: 5px">
                                    <div class="progress">
                                        <div style="width: 65%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="65" role="progressbar" class="progress-bar progress-bar-success">
                                            <span>65% Completado</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--    PANEL REGISTRO DE ENVIO DE COMUNICADOS              -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label"></label>
                                <div class="col-sm-9">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            Registro de envío
                                        </div>
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Fecha envío</label>
                                                <div class="col-sm-3">
                                                    <p class="form-control-static">07/04/2016</p>
                                                </div>
                                                <label class="col-sm-2 control-label">Hora envío</label>
                                                <div class="col-sm-3">
                                                    <p class="form-control-static">14:34</p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Destinatarios</label>
                                                <div class="col-sm-8">
                                                    <p class="form-control-static">Directorio; joseluisbr@gmail.com</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>
                            <!--    FIN - PANEL REGISTRO DE ENVIO DE COMUNICADOS            -->


                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button class="btn btn-success" type="submit">Enviar</button>
                                    <button class="btn btn-white" type="submit">Cancelar</button>
                                </div>
                            </div>

                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection