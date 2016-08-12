@extends('layouts.admin')

@section('admin-content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Cuentas</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="#/">Inicio</a>
                </li>
                <li>
                    Configuración
                </li>
                <li class="active">
                    <strong>Nueva cuenta</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">

                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <form method="get" class="form-horizontal">

                            <div class="tabs-container">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#tab-1">Nueva cuenta</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="tab-1" class="tab-pane active">
                                        <div class="panel-body">

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Cuenta</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control input-sm">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Tipo de cuenta</label>
                                                <div class="col-sm-4">
                                                    <select class="form-control input-sm" name="tipo-cuenta">
                                                        <option>Caja de Ahorro</option>
                                                        <option>Cuenta Corriente</option>
                                                        <option>Efectivo</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Banco</label>
                                                <div class="col-sm-4">
                                                    <select class="form-control input-sm" name="account">
                                                        <option>Banco BISA</option>
                                                        <option>Banco de Crédito BCP</option>
                                                        <option>Banco Económico</option>
                                                        <option>Banco Ganadero</option>
                                                        <option>Banco Mercantil Santa Cruz</option>
                                                        <option>Banco Nacional de Bolivia</option>
                                                        <option>Banco Unión</option>
                                                        <option>Mi banco no aparece en la lista</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Número cuenta</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control input-sm">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Nombre cuentahabiente</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control input-sm">
                                                </div>
                                            </div>

                                            <div class="hr-line-dashed"></div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Notas</label>
                                                <div class="col-sm-8">
                                                    <textarea rows="4" class="form-control input-sm"></textarea>
                                                </div>
                                            </div>

                                            <div class="hr-line-dashed"></div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Activa</label>
                                                <div class="col-sm-4">

                                                    <label><input type="checkbox" class="i-checks"></label>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-success" type="submit">Guardar</button>
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