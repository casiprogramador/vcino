@extends('layouts.admin')

@section('admin-content')
   <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Propiedades</h2>
        <ol class="breadcrumb">
            <li>
                <a href="#/">Inicio</a>
            </li>
            <li>
                Propiedades
            </li>
            <li>
                <a href="#">Lista de propiedades</a>
            </li>
            <li class="active">
                <strong>Nueva propiedad</strong>
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
                            <li class="active"><a data-toggle="tab" href="#tab-1">Información general</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-2">Servicios</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-3">Características</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                                <div class="panel-body">

                                    <div class="form-group"><label class="col-sm-3 control-label">Número</label>
                                        <div class="col-sm-2"><input type="text" class="form-control input-sm"></div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-3 control-label">Tipo</label>
                                        <div class="col-sm-4">
                                            <select class="form-control input-sm" name="account">
                                                <option>option 1</option>
                                                <option>option 2</option>
                                                <option>option 3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-3 control-label">Situación habitacional</label>
                                        <div class="col-sm-4">
                                            <select class="form-control input-sm" name="account">
                                                <option>option 1</option>
                                                <option>option 2</option>
                                                <option>option 3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
 
                                    <div class="form-group"><label class="col-sm-3 control-label">Nro. Intercomunicador</label>
                                        <div class="col-sm-2"><input type="text" class="form-control input-sm"></div>
                                    </div>

                                    <div class="hr-line-dashed"></div>

                                    <div class="form-group"><label class="col-sm-3 control-label">Etiquetas</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control input-sm">
                                            <span class="help-block m-b-none">Permite agrupar o clasificar las propiedades por otros criterios.</span>
                                        </div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-3 control-label">Campo 1</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control input-sm">
                                            <span class="help-block m-b-none">Campo personalizado para almacenar valores o referencias adicionales.</span>
                                        </div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-3 control-label">Campo 2</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control input-sm">
                                            <span class="help-block m-b-none">Campo personalizado para almacenar valores o referencias adicionales.</span>
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>

                                    <div class="form-group"><label class="col-sm-3 control-label">Notas</label>
                                        <div class="col-sm-8">
                                            <textarea rows="6" class="form-control input-sm"></textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div id="tab-2" class="tab-pane">
                                <div class="panel-body">
                                    <div class="form-group"><label class="col-sm-3 control-label">Código energía eléctrica</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control input-sm" value="278981">
                                        </div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-3 control-label">Código agua potable</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control input-sm">
                                        </div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-3 control-label">Código gas domiciliario</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control input-sm">
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group"><label class="col-sm-3 control-label">Servicio TV Cable</label>
                                        <div class="col-sm-4">
                                            <select class="form-control input-sm" name="account">
                                                <option>Cotas cable</option>
                                                <option>option 2</option>
                                                <option>option 3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-3 control-label">Servicio Internet</label>
                                        <div class="col-sm-4">
                                            <select class="form-control input-sm" name="account">
                                                <option>Entel</option>
                                                <option>option 2</option>
                                                <option>option 3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-3 control-label">Servicio teléfono</label>
                                        <div class="col-sm-4">
                                            <select class="form-control input-sm" name="account">
                                                <option>Cotas</option>
                                                <option>option 2</option>
                                                <option>option 3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-3 control-label">Servicio agua potable</label>
                                        <div class="col-sm-4">
                                            <select class="form-control input-sm" name="account">
                                                <option>Saguapac</option>
                                                <option>option 2</option>
                                                <option>option 3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-3 control-label">Servicio energía eléctrica</label>
                                        <div class="col-sm-4">
                                            <select class="form-control input-sm" name="account">
                                                <option>C.R.E.</option>
                                                <option>option 2</option>
                                                <option>option 3</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-3" class="tab-pane">
                                <div class="panel-body">
                                    <div class="form-group"><label class="col-sm-3 control-label">Superficie</label>
                                        <div class="col-sm-2"><input type="text" class="form-control input-sm"></div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-3 control-label">S.C.C.</label>
                                        <div class="col-sm-2"><input type="text" class="form-control input-sm"></div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-3 control-label">F.I.T.</label>
                                        <div class="col-sm-2"><input type="text" class="form-control input-sm"></div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-3 control-label">Nro. Dormitorios</label>
                                        <div class="col-sm-2"><input type="text" class="form-control input-sm"></div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-3 control-label">Nro. Baños</label>
                                        <div class="col-sm-2"><input type="text" class="form-control input-sm"></div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group"><label class="col-sm-3 control-label">Plano de distribución</label>
                                        <div class="col-sm-8"><input type="text" class="form-control input-sm"></div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-3 control-label">Características</label>
                                        <div class="col-sm-8">
                                            <textarea rows="4" disable="" class="form-control input-sm"></textarea>
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

    <!-- iCheck -->
    <script src="js/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>


@endsection
@section('javascript')
    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });

        });
    </script>
@endsection
