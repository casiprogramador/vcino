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
                <a href="#">Lista de gastos</a>
            </li>
            <li class="active">
                <strong>Ver detalle gasto</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5 style="padding-top: 7px;">Ver detalle gasto</h5>
                    <div class="ibox-tools">

                        <div class="btn-group" style="margin-right: 10px;">
                            <button type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Copiar comunicado" data-original-title="Copiar comunicado">
                                <i class="fa fa-files-o"></i>&nbsp;&nbsp;Copiar
                            </button>

                            <button type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Editar comunicado" data-original-title="Editar comunicado">
                                <i class="fa fa-pencil"></i>&nbsp;&nbsp;Editar
                            </button>
                        </div>

                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Imprimir..." data-original-title="Imprimir...">
                                <i class="fa fa-print"></i>&nbsp;&nbsp;Imprimir...
                            </button>
                            <button type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Exportar comprobante a PDF" data-original-title="Imprimir...">
                                <i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;Exportar...
                            </button>
                        </div>

                    </div>
                </div>
                <div class="ibox-content">
                    <form method="get" class="form-horizontal">

                                <div class="panel-body">
                                    <div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-sm-3 control-label">Nro. Documento</label>
                                            <div class="col-sm-2 input-group date" style="padding-left:15px;">
                                            <p class="form-control-static">00553</p>
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-sm-3 control-label">Fecha</label>
                                            <div class="col-sm-2 input-group date" style="padding-left:15px;">
                                            <p class="form-control-static">12/10/2016</p>
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-sm-3 control-label">Proveedor</label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static">OTIS</p>
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-sm-3 control-label">Categoría</label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static">Mantenimiento ascensor</p>
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-sm-3 control-label">Concepto</label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static">Pago servicio mes de octubre 2016</p>
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-sm-3 control-label">Cuenta</label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static">Bco. 010222-223-32</p>
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-sm-3 control-label">Forma de pago</label>
                                        <div class="col-sm-3">
                                            <p class="form-control-static">Cheque</p>
                                        </div>
                                        <label class="col-sm-3 control-label">Nro. Cheque</label>
                                        <div class="col-sm-3">
                                            <p class="form-control-static">67</p>
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-sm-3 control-label">Importe</label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static">1.600,00</p>
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>

                                    <div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-sm-3 control-label">Nota</label>
                                        <div class="col-sm-9">
                                            <div class="ibox-content p-xs form-control-static">
                                                    <p>dkfj aldsfj lkadsjf lkasdjf lkadsjf lkasdjf l;kjf alsdkfj lkdsafj lakdsfj lksadfj lkdasfj alkdsfj alkdsfj lkasjdf lk</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>

                                    <div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-sm-3 control-label">Adjunto</label>
                                        <div class="col-sm-9">
                                            <div class="attachment">
                                                <div class="file-box">
                                                    <div class="file">
                                                        <a href="#">
                                                            <span class="corner"></span>
                                                            <div class="icon">
                                                                <i class="fa fa-file-pdf-o"></i>
                                                            </div>
                                                            <div class="file-name">
                                                                Documento_adjunto1.pdf
                                                            </div>
                                                        </a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-success" type="submit">Volver</button>
                            </div>
                        </div>

                  </form>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection


