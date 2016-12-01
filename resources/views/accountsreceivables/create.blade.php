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
            <li>
                <a href="#">Lista de cuotas por cobrar</a>
            </li>
            <li class="active">
                <strong>Nueva cuota por cobrar</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <h5 style="padding-top: 2px;">Nueva cuota por cobrar</h5>
                </div>

                <div class="ibox-content">
                    <form method="get" class="form-horizontal">

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Propiedad</label>
                            <div class="col-sm-3">
                                <select class="form-control input-sm" name="tipo-cuenta">
                                    <!-- Lista de las propiedades ordenada por campo ORDEN y despliega campo número  -->
                                    <option>Propiedad 1</option>
                                    <option>Propiedad 2</option>
                                    <option>Propiedad 3</option>
                                    <option>Propiedad 4</option>
                                    <option>Propiedad 5</option>
                                </select>
                            </div>
                        </div>

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
                            <div class="col-sm-2">
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
                            <label class="col-sm-3 control-label">Cuota</label>
                            <div class="col-sm-5">
                                <select class="form-control input-sm" name="tipo-cuenta">
                                    <!-- Lista de las propiedades ordenada por campo ORDEN y despliega campo número  -->
                                    <option>Expensa tipo 1</option>
                                    <option>Alquiler de áreas comunes</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group" id="fecha">
                            <label class="col-sm-3 control-label">Fecha de vencimiento</label>
                                <div class="col-sm-3 input-group date" style="padding-left:15px;">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" class="form-control input-sm" value="30/04/2016">
                                </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Importe por cobrar</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control input-sm">
                            </div>
                            <label class="col-sm-3 control-label">Importe abonado</label>
                            <div class="col-sm-2">
                                <input type="text" value="0" class="form-control input-sm">
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Cancelada</label>
                            <div class="col-sm-1">
                                <select class="form-control input-sm" name="tipo-cuenta">
                                    <option>Si</option>
                                    <option selected="">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-danger" type="submit">
                                    <i class="fa fa-trash"></i>&nbsp;&nbsp;Eliminar...</button>
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


