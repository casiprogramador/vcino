@extends('layouts.admin')

@section('admin-content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Contactos</h2>
        <ol class="breadcrumb">
            <li>
                <a href="#/">Inicio</a>
            </li>
            <li>
                Propiedades
            </li>
            <li>
                Lista de contactos
            </li>
            <li class="active">
                <strong>Nuevo contacto</strong>
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
                            <li class="active"><a data-toggle="tab" href="#tab-1">Nuevo contacto</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                                <div class="panel-body">

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

                                    <div class="hr-line-dashed"></div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Tipo</label>
                                        <div class="col-sm-3">
                                            <select class="form-control input-sm" name="tipo-cuenta">
                                                <option>Propietario</option>
                                                <option>Inquilino</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Relación</label>
                                        <div class="col-sm-3">
                                            <select class="form-control input-sm" name="tipo-cuenta">
                                                <!--    Lista desde JSON        -->
                                                <option>Titular</option>
                                                <option>Esposa/ Esposo</option>
                                                <option>Hija/ Hijo</option>
                                                <option>Familiar</option>
                                                <option>Personal de servicio</option>
                                                <option>Contacto administrativo</option>
                                                <option>Contacto de emergencia</option>
                                                <option>Otro</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Nombre</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control input-sm">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Apellido</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control input-sm">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Teléfonos</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-sm-4"><input type="text" placeholder="Móvil" class="form-control input-sm"></div>
                                                <div class="col-sm-4"><input type="text" placeholder="Domicilio" class="form-control input-sm"></div>
                                                <div class="col-sm-4"><input type="text" placeholder="Oficina" class="form-control input-sm">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">E-mail</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-sm-6"><input type="text" placeholder="E-mail" class="form-control input-sm"></div>
                                                <div class="col-sm-6"><input type="text" placeholder="E-mail alterno" class="form-control input-sm"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Dirección</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control input-sm">
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Fotografía</label>
                                        <div class="col-sm-8">
                                            <label title="Upload image file" for="inputImage" class="btn btn-white">
                                                <input type="file" name="file" id="inputImage" class="hide">
                                                Seleccionar archivo
                                            </label>
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Profesión</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control input-sm">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Nacionalidad</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control input-sm">
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Correspondencia</label>
                                        <div class="col-sm-3">
                                            <label class="checkbox-inline">
                                                <input type="checkbox" class="i-checks">Comunicados</label>
                                        </div>
                                        <div class="col-sm-3">
                                            <label class="checkbox-inline">
                                                <input type="checkbox" class="i-checks">Cobranzas</label>
                                        </div>
                                        <div class="col-sm-3">
                                            <label class="checkbox-inline">
                                                <input type="checkbox" class="i-checks">Directorio</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Medio preferido</label>
                                        <div class="col-sm-3">
                                            <select class="form-control input-sm" name="tipo-cuenta">
                                                <!--    Lista desde JSON        -->
                                                <option>E-mail</option>
                                                <option>Teléfono</option>
                                                <option>Texting</option>
                                                <option>Personal</option>
                                                <option>Otro</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Miembro Directorio</label>
                                        <div class="col-sm-4">
                                            <label><input type="checkbox" class="i-checks"></label>
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Mostrar mis datos</label>
                                        <div class="col-sm-1">
                                            <label><input type="checkbox" class="i-checks"></label>
                                        </div>
                                        <div class="col-md-6">
                                            <p style="font-size: 11px; color: #B0B0B0;">Se refiere a que los datos de contacto son visibles para otros miembros.</p>
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Notas</label>
                                        <div class="col-sm-9">
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

                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>

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